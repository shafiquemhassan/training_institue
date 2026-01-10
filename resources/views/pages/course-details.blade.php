

@extends('layouts.app')

@section('title', $course->meta_title ?: $course->title)
@section('meta_title', $course->meta_title ?: $course->title)
@section('meta_description', $course->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($course->excerpt), 160, ''))


@section('content')

<div class="container">
    <header class="cd-header py-5">
        <h1 class="cd-title">{{ $course->title }}</h1>
    </header>
</div>
<div class="container course-details">
    {{-- Title + meta --}}
   

    {{-- Grid: Main (8) + Sidebar (4) --}}
    <div class="row g-4 py-4">
        {{-- MAIN --}}
        <div class="col-12 col-lg-8">
            {{-- Video: responsive 16:9 --}}
            @if (!empty($youtubeKey))
                <div class="cd-video ratio ratio-16x9">
                    <iframe
                        src="https://www.youtube.com/embed/{{ $youtubeKey }}"
                        title="{{ $course->title }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen>
                    </iframe>
                </div>
            @endif

            {{-- Featured image (optional) --}}
            @php
                $featured = $course->featured_image ? asset('storage/' . ltrim($course->featured_image, '/')) : null;
            @endphp
            @if ($featured)
                <figure class="cd-featured">
                    <img class="img-fluid" src="{{ $featured }}" alt="{{ $course->title }}">
                </figure>
            @endif

            {{-- Description (rich text) --}}
            <article class="cd-body">
                {!! $course->description !!}
            </article>

            {{-- Categories --}}
            @if ($course->ccategories->isNotEmpty())
                <div class="cd-cats">
                    <span class="cd-cats-label">Categories:</span>
                    <div class="cd-cats-list">
                        @foreach ($course->ccategories as $cat)
                            <a class="cd-cat"
                               href="{{ route('courses', ['category' => $cat->slug]) }}">{{ $cat->title }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        {{-- SIDEBAR --}}
        <aside class="col-12 col-lg-4">
            {{-- Related Courses --}}
            <section class="cd-widget">
                <h3 class="cd-widget-title">Related Courses</h3>
                <ul class="cd-list">
                    @forelse ($relatedCourses as $rc)
                        <li class="cd-list-item">
                            <a href="{{ route('courses.details', $rc->slug) }}">{{ $rc->title }}</a>
                        </li>
                    @empty
                        <li class="cd-list-item cd-empty">No related courses found.</li>
                    @endforelse
                </ul>
            </section>

            {{-- Course Categories with counts --}}
            <section class="cd-widget">
                <h3 class="cd-widget-title">Course Categories</h3>
                <ul class="cd-list">
                    @foreach ($categories as $cat)
                        <li class="cd-list-item d-flex justify-content-between">
                            <a href="{{ route('courses', ['category' => $cat->slug]) }}">{{ $cat->title }}</a>
                            <span class="cd-count">({{ $cat->courses_count }})</span>
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- Recent 5 Blogs --}}
            <section class="cd-widget">
                <h3 class="cd-widget-title">Recent Blogs</h3>
                <ul class="cd-list">
                    @forelse ($recentBlogs as $blog)
                        <li class="cd-list-item">
                            <a href="{{ url('/blog/' . $blog->slug) }}">{{ $blog->title }}</a>
                        </li>
                    @empty
                        <li class="cd-list-item cd-empty">No recent blogs.</li>
                    @endforelse
                </ul>
            </section>
        </aside>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Scope styles to this page only */
.container.course-details { max-width: 1140px; }

.course-details .cd-header { margin: 1.25rem 0 1rem; }
.course-details .cd-title { font-size: clamp(1.5rem, 2vw + 1rem, 2rem); margin: 0 0 .25rem; line-height: 1.25; }
.course-details .cd-meta { font-size: .9rem; color: #6c757d; display: flex; gap: 1rem; flex-wrap: wrap; }

.course-details .cd-video { border-radius: 10px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
.course-details .cd-featured { margin: 1rem 0 1.5rem; }
.course-details .cd-featured img { border-radius: 10px; width: 100%; height: auto; display: block; }

.course-details .cd-body { font-size: 1rem; line-height: 1.8; color: #212529; }
.course-details .cd-body p { margin-bottom: 1rem; }
.course-details .cd-body img { max-width: 100%; height: auto; border-radius: 8px; }
.course-details .cd-body ul, .course-details .cd-body ol { padding-left: 1.2rem; margin-bottom: 1rem; }
.course-details .cd-body h2, .course-details .cd-body h3, .course-details .cd-body h4 { margin-top: 1.25rem; margin-bottom: .75rem; line-height: 1.3; }

.course-details .cd-cats { margin-top: 1.25rem; padding-top: 1rem; border-top: 1px solid #eee; }
.course-details .cd-cats-label { font-weight: 600; margin-right: .5rem; }
.course-details .cd-cats-list { display: inline-flex; gap: .5rem; flex-wrap: wrap; }
.course-details .cd-cat { display: inline-block; padding: .25rem .6rem; background: #f5f7fb; border: 1px solid #e6ebf5; border-radius: 999px; font-size: .875rem; text-decoration: none; color: #0b57d0; }
.course-details .cd-cat:hover { background: #eaf1ff; }

.course-details .cd-widget { padding: 1rem; border: 1px solid #eef1f6; border-radius: 12px; background: #fff; margin-bottom: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,.03); }
.course-details .cd-widget-title { font-size: 1.05rem; margin: 0 0 .75rem; border-bottom: 1px dashed #edf0f6; padding-bottom: .5rem; }
.course-details .cd-list { list-style: none; padding: 0; margin: 0; }
.course-details .cd-list-item { padding: .4rem 0; }
.course-details .cd-list-item + .cd-list-item { border-top: 1px dashed #f0f2f6; }
.course-details .cd-list-item a { text-decoration: none; color: #1a1f36; }
.course-details .cd-list-item a:hover { color: #0b57d0; }
.course-details .cd-empty { color: #98a2b3; }
.course-details .cd-count { color: #6c757d; }

@media (max-width: 991.98px) {
  .course-details .cd-header { margin-top: .75rem; }
}
</style>
@endpush