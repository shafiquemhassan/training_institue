{{-- Top Header --}}
<div class="top-header">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="social-icons d-flex">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="contact-info d-flex justify-content-md-end">
          <span><i class="fas fa-phone"></i> +1 234 567 8900</span>
          <span><i class="fas fa-envelope"></i> info@edulearn.com</span>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Main Header / Navbar --}}
<header class="main-header">
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">EduLearn</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('courses*') ? 'active' : '' }}" href="{{ route('courses') }}">Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary-custom ms-lg-3 mt-2 mt-lg-0" href="#">Enroll Now</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>