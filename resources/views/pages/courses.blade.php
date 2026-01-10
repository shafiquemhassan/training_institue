{{-- Dynamic Meta --}}
@section('meta_title', $metaTitle ?? 'Courses')
@section('meta_description', $metaDescription ?? '')

@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- ================== Category Tabs ================== --}}
    <div class="text-center mb-4">
        <ul class="nav nav-pills justify-content-center gap-2 flex-wrap">
            @php $isAllActive = empty($categorySlug); @endphp
            <li class="nav-item">
                <a href="{{ route('courses') }}"
                   class="nav-link {{ $isAllActive ? 'active' : '' }}">
                    All Courses
                    <span class="badge bg-light text-dark ms-1">{{ $categories->sum('courses_count') }}</span>
                </a>
            </li>
            @foreach ($categories as $cat)
                <li class="nav-item">
                    <a href="{{ route('courses', ['category' => $cat->slug]) }}"
                       class="nav-link {{ ($selectedCategory?->id === $cat->id) ? 'active' : '' }}">
                        {{ $cat->title }}
                        <span class="badge bg-light text-dark ms-1">{{ $cat->courses_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- ================== Courses List ================== --}}
    <div class="row justify-content-center">
        @forelse ($courses as $course)
            <div class="col-12 col-md-10 col-lg-8 mb-4">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-3 text-center p-3">
                            @php
                                $thumb = $course->thumbnail ? asset('storage/' . ltrim($course->thumbnail, '/')) : null;
                            @endphp
                            @if ($thumb)
                                <a href="{{ route('courses.details', $course->slug) }}">
                                    <img src="{{ $thumb }}" alt="{{ $course->title }}" class="img-fluid rounded-3" style="max-height:120px; object-fit:contain;">
                                </a>
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height:120px;">
                                    <i class="bi bi-image fs-1 text-secondary"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title mb-2">
                                    <a href="{{ route('courses.details', $course->slug) }}" class="text-decoration-none text-primary fw-semibold">
                                        {{ $course->title }}
                                    </a>
                                </h5>
                                @if ($course->excerpt)
                                    <p class="card-text text-muted small mb-2">{!! Str::limit(strip_tags($course->excerpt), 160) !!}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center text-secondary small">
                                    <span>By: {{ $course->createdBy?->name ?? 'admin' }} ({{ $course->createdBy?->id ?? '-' }})</span>
                                    @if ($course->published_at)
                                        <span>{{ $course->published_at->format('M d, Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <h6 class="text-muted">No courses found under this category.</h6>
            </div>
        @endforelse
    </div>

    {{-- ================== Pagination ================== --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
.nav-pills .nav-link {
    border-radius: 30px;
    color: #0b57d0;
    font-weight: 500;
    transition: all .2s ease;
}
.nav-pills .nav-link:hover {
    background-color: #eaf1ff;
}
.nav-pills .nav-link.active {
    background-color: #0b57d0;
    color: #fff !important;
}
.card {
    transition: transform .15s ease, box-shadow .15s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.07);
}
</style>
@endpush