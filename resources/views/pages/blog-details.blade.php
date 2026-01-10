@extends('layouts.app')
@section('title', $blog->meta_title ?? $blog->title)

@section('content')
  {{-- Breadcrumb --}}
  <section class="page-title-section">
    <div class="container">
      <h1 class="page-title">{{ $blog->title }}</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
          @if($blog->categories->count())
            @php $bc = $blog->categories->first(); @endphp
            <li class="breadcrumb-item"><a href="{{ route('blog.category', $bc->slug) }}">{{ $bc->title }}</a></li>
          @endif
          <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
        </ol>
      </nav>
    </div>
  </section>

  <section class="section-padding pt-0">
    <div class="container">
      <div class="row g-4">
        {{-- Main content --}}
        <div class="col-lg-8">
          @php
            // featured_image can be "image.jpg" or "blogs/image.jpg" or "storage/blogs/image.jpg"
            $fi = $blog->featured_image;
            $fi = $fi ? ltrim(str_replace(['storage/','blogs/'], '', $fi), '/') : null;
            $featuredUrl = $fi ? asset('storage/blogs/'.$fi) : asset('assets/images/banner2.jpg');
          @endphp
          <img class="img-fluid rounded mb-4" src="{{ $featuredUrl }}" alt="{{ $blog->title }}">

          <div class="mb-3 small text-muted">
            {{ $blog->created_at?->format('M d, Y') }}
            @if($blog->reading_time) · {{ $blog->reading_time }} min read @endif
            @if($blog->categories->count()) ·
              @foreach($blog->categories as $c)
                <a href="{{ route('blog.category', $c->slug) }}" class="text-decoration-none">{{ $c->title }}</a>@if(!$loop->last), @endif
              @endforeach
            @endif
          </div>

          <h2 class="mb-3">{{ $blog->title }}</h2>

          {{-- Body (HTML allowed) --}}
          <article class="blog-content">
            {!! $blog->description !!}
          </article>

          {{-- Share / Back --}}
          <div class="mt-4">
            <a class="btn btn-secondary-custom me-2" href="{{ url()->previous() === url()->current() ? route('blog') : url()->previous() }}">← Back</a>
            <a class="btn btn-primary-custom" href="#">Share</a>
          </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
          {{-- Related (3) --}}
          <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Related Articles</h5></div>
            <ul class="list-group list-group-flush">
              @forelse($related as $r)
                @php
                  $rt = $r->thumbnail ? ltrim(str_replace(['storage/','blogs/'], '', $r->thumbnail), '/') : null;
                  $rThumb = $rt ? asset('storage/blogs/'.$rt) : asset('assets/images/blog.jpg');
                @endphp
                <li class="list-group-item">
                  <div class="d-flex">
                    <a class="me-3" href="{{ route('blog.details', $r->slug) }}">
                      <img src="{{ $rThumb }}" alt="{{ $r->title }}" width="70" height="55" class="rounded object-fit-cover">
                    </a>
                    <div>
                      <a class="fw-semibold text-decoration-none" href="{{ route('blog.details', $r->slug) }}">{{ Str::limit($r->title, 60) }}</a>
                      <div class="small text-muted">{{ $r->created_at?->format('M d, Y') }}</div>
                    </div>
                  </div>
                </li>
              @empty
                <li class="list-group-item">No related articles.</li>
              @endforelse
            </ul>
          </div>

          {{-- Categories with counts --}}
          <div class="card">
            <div class="card-header"><h5 class="mb-0">Blog Categories</h5></div>
            <div class="list-group list-group-flush">
              <a href="{{ route('blog') }}" class="list-group-item list-group-item-action">
                All <span class="badge bg-secondary float-end">{{ $categories->sum('blogs_count') }}</span>
              </a>
              @foreach($categories as $cat)
                <a href="{{ route('blog.category', $cat->slug) }}" class="list-group-item list-group-item-action">
                  {{ $cat->title }}
                  <span class="badge bg-secondary float-end">{{ $cat->blogs_count }}</span>
                </a>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection