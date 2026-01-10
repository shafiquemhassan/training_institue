<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Ccategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    // Static pages you already have...
    
    public function about(): View        { return view('pages.about'); }
    
    public function home()
    {
        // Popular Courses: latest active courses (adjust limit as you like)
        $popularCourses = Course::query()
            ->with(['createdBy:id,name'])
            ->where('status', true)
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        // Latest 3 blogs (DB fallback; if you have Blog model, use it)
        $latestBlogs = DB::table('blogs')
            ->select('id', 'slug', 'title', 'created_at', 'thumbnail')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('pages.home', [
            'popularCourses' => $popularCourses,
            'latestBlogs'    => $latestBlogs,
        ]);
    }

    public function courses(Request $request)
    {
        // All categories with course counts (tabs)
        $categories = Ccategory::withCount('courses')
            ->orderBy('title')
            ->get();

        $categorySlug = $request->query('category');
        $selectedCategory = null;

        $coursesQuery = Course::query()
            ->with(['ccategories:id,slug,title', 'createdBy:id,name'])
            ->latest('published_at');

        if ($categorySlug) {
            $selectedCategory = Ccategory::where('slug', $categorySlug)->first();
            if ($selectedCategory) {
                $coursesQuery->whereHas('ccategories', fn ($q) => $q->where('ccategory.id', $selectedCategory->id));
            }
        }

        $courses = $coursesQuery->paginate(12)->withQueryString();

        // Dynamic meta
        $metaTitle = $selectedCategory
            ? ($selectedCategory->meta_title ?: ($selectedCategory->title . ' Courses'))
            : 'All Courses';
        $metaDescription = $selectedCategory
            ? ($selectedCategory->meta_description ?: ('Browse courses in ' . $selectedCategory->title))
            : 'Browse all available courses';

        return view('pages.courses', [
            'categories'       => $categories,
            'selectedCategory' => $selectedCategory,
            'categorySlug'     => $categorySlug,
            'courses'          => $courses,
            'metaTitle'        => $metaTitle,
            'metaDescription'  => $metaDescription,
        ]);
    }

    public function courseDetails(string $slug)
    {
        $course = Course::with(['ccategories:id,slug,title', 'createdBy:id,name'])
            ->where('slug', $slug)
            ->firstOrFail();

        $ccatIds = $course->ccategories->pluck('id')->all();

        // Related courses: share at least one category, exclude current
        $relatedCourses = Course::with(['ccategories:id,slug,title'])
            ->where('id', '<>', $course->id)
            ->when($ccatIds, fn ($q) => $q->whereHas('ccategories', fn ($qq) => $qq->whereIn('ccategory.id', $ccatIds)))
            ->latest('published_at')
            ->limit(6)
            ->get();

        // Sidebar: categories with counts
        $categories = Ccategory::withCount('courses')->orderBy('title')->get();

        // Recent 5 blogs (adjust model/table as per your app)
        $recentBlogs = DB::table('blogs')
            ->select('id', 'slug', 'title', 'created_at')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $youtubeKey = $this->extractYouTubeId((string) $course->video_url);

        $metaTitle = $course->meta_title ?: $course->title;
        $metaDescription = $course->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($course->excerpt), 160, '');

        return view('pages.course-details', [
            'course'          => $course,
            'youtubeKey'      => $youtubeKey,
            'relatedCourses'  => $relatedCourses,
            'categories'      => $categories,
            'recentBlogs'     => $recentBlogs,
            'metaTitle'       => $metaTitle,
            'metaDescription' => $metaDescription,
        ]);
    }

    /** Extract a YouTube video ID from common URL formats. */
    private function extractYouTubeId(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') return null;

        $patterns = [
            '/[?&]v=([a-zA-Z0-9_-]{11})/i',        // watch?v=
            '#youtu\.be/([a-zA-Z0-9_-]{11})#i',    // youtu.be/
            '#youtube\.com/embed/([a-zA-Z0-9_-]{11})#i', // /embed/
            '#youtube\.com/shorts/([a-zA-Z0-9_-]{11})#i', // /shorts/
        ];
        foreach ($patterns as $p) if (preg_match($p, $url, $m)) return $m[1];
        return null;
    }

    /** Blog listing: 12 latest with pagination */
    public function blogIndex(Request $request): View
    {
        $blogs = Blog::with('categories')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::withCount('blogs')
            ->orderBy('title')
            ->get();

        return view('pages.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
            'activeCategory' => null, // for breadcrumb / highlighting
        ]);
    }

    /** Blog listing filtered by category (with pagination) */
    public function blogByCategory(Request $request, Category $category): View
    {
        $blogs = $category->blogs()
            ->with('categories')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::withCount('blogs')
            ->orderBy('title')
            ->get();

        return view('pages.blog', [
            'blogs' => $blogs,
            'categories' => $categories,
            'activeCategory' => $category, // used for breadcrumb and active state
        ]);
    }

    /** Blog details + related posts (3) + categories with counts */
    public function blogShow(Blog $blog): View
    {
        $categoryIds = $blog->categories()->pluck('categories.id');

        $related = Blog::whereKeyNot($blog->getKey())
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categoryIds))
            ->latest('created_at')
            ->limit(3)
            ->get();

        $categories = Category::withCount('blogs')
            ->orderBy('title')
            ->get();

        return view('pages.blog-details', [
            'blog' => $blog->load('categories'),
            'related' => $related,
            'categories' => $categories,
        ]);
    }
}