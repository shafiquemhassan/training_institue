@extends('layouts.app')
@section('title', $activeCategory ? $activeCategory->title.' - Blog' : 'Blog')

@section('content')
  {{-- Title & Breadcrumb --}}
  <section class="page-title-section">
    <div class="container">
      <h1 class="page-title">
        {{ $activeCategory ? $activeCategory->title : 'Blog' }}
      </h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          @if($activeCategory)
            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $activeCategory->title }}</li>
          @else
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
          @endif
        </ol>
      </nav>
    </div>
  </section>

  <section class="section-padding">
    <div class="container">
      <div class="row g-4">
        {{-- Main list --}}
        <div class="col-lg-8">
          <div class="row g-4">
            @forelse ($blogs as $post)
              @php
                // Expecting $post->thumbnail like "image.jpg" or "blogs/image.jpg" or "storage/blogs/image.jpg"
                $thumb = $post->thumbnail;
                $thumb = $thumb ? ltrim(str_replace(['storage/','blogs/'], '', $thumb), '/') : null;
                $thumbUrl = $thumb ? asset('storage/blogs/'.$thumb) : asset('assets/images/blog.jpg');
              @endphp
              <div class="col-md-6">
                <article class="card blog-card h-100">
                  <a href="{{ route('blog.details', $post->slug) }}">
                    <img class="card-img-top" src="{{ $thumbUrl }}" alt="{{ $post->title }}">
                  </a>
                  <div class="card-body">
                    <div class="mb-2 small text-muted">
                      {{ $post->created_at?->format('M d, Y') }}
                      @if($post->categories->count())
                        ·
                        @foreach($post->categories as $c)
                          <a href="{{ route('blog.category', $c->slug) }}" class="text-decoration-none">{{ $c->title }}</a>@if(!$loop->last), @endif
                        @endforeach
                      @endif
                    </div>
                    <h5 class="card-title">
                      <a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }}</a>
                    </h5>
                    <p class="card-text">{{ Str::limit($post->excerpt ?? strip_tags($post->description), 110) }}</p>
                  </div>
                  <div class="card-footer bg-transparent">
                    <a class="btn btn-primary-custom" href="{{ route('blog.details', $post->slug) }}">Read More</a>
                  </div>
                </article>
              </div>
            @empty
              <div class="col-12">
                <div class="alert alert-info mb-0">No blog posts found.</div>
              </div>
            @endforelse
          </div>

          {{-- Pagination --}}
          <div class="mt-4">
            {{ $blogs->onEachSide(1)->links('pagination::bootstrap-5') }}
          </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
          {{-- Blog Categories with counts --}}
          <div class="card mb-4">
            <div class="card-header">
              <h5 class="mb-0">Blog Categories</h5>
            </div>
            <div class="list-group list-group-flush">
              <a href="{{ route('blog') }}"
                 class="list-group-item list-group-item-action {{ $activeCategory ? '' : 'active' }}">
                All <span class="badge bg-secondary float-end">{{ $categories->sum('blogs_count') }}</span>
              </a>
              @foreach($categories as $cat)
                <a href="{{ route('blog.category', $cat->slug) }}"
                   class="list-group-item list-group-item-action {{ $activeCategory && $activeCategory->id === $cat->id ? 'active' : '' }}">
                  {{ $cat->title }}
                  <span class="badge bg-secondary float-end">{{ $cat->blogs_count }}</span>
                </a>
              @endforeach
            </div>
          </div>

          {{-- (Optional) Other widgets --}}
        </div>
      </div>
    </div>
  </section>
@endsection