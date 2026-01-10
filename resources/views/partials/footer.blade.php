<footer class="footer">
  <div class="container">
    <div class="row">
      {{-- Column 1 --}}
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5>About Us</h5>
        <p>EduLearn is a premier training institute dedicated to providing high-quality education and skill development programs to help individuals achieve their career goals.</p>
        <div class="social-icons d-flex mt-4">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      {{-- Column 2 --}}
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5>Quick Links</h5>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('courses') }}">Courses</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
        </ul>
      </div>

    {{-- Column 3 --}}
<div class="col-lg-3 col-md-6 mb-4 mb-md-0">
    <h5>Popular Courses</h5>
    <ul class="footer-links">
        @forelse($footerCourses as $course)
            <li>
                <a href="{{ route('courses.details', $course->slug) }}">
                    {{ $course->title }}
                </a>
            </li>
        @empty
            <li><span class="text-muted small">No courses found.</span></li>
        @endforelse
    </ul>
</div>

      {{-- Column 4 --}}
      <div class="col-lg-3 col-md-6">
        <h5>Contact Info</h5>
        <ul class="footer-contact">
          <li><i class="fas fa-map-marker-alt"></i><span>123 Education Street, Learning City, LC 12345</span></li>
          <li><i class="fas fa-phone"></i><span>+1 234 567 8900</span></li>
          <li><i class="fas fa-envelope"></i><span>info@edulearn.com</span></li>
          <li><i class="fas fa-clock"></i><span>Mon - Fri: 9:00 AM - 6:00 PM</span></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center text-md-start">
          <p>&copy; {{ date('Y') }} EduLearn. All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>