<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Course;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
       public function boot(): void
    {
          View::composer('*', function ($view) {
            $footerCourses = Course::query()
                ->where('status', true)
                ->latest('published_at')
                ->limit(5)
                ->get(['id', 'slug', 'title']);
            $view->with('footerCourses', $footerCourses);
        });
    }

}
