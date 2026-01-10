@extends('layouts.app')
@section('title','About')

@section('content')
 <section class="page-title-section">
        <div class="container">
            <h1 class="page-title">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="{{ asset('assets/images/image-1.jpg') }}" alt="About Us" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <h2 class="about-title">Our Mission & Vision</h2>
                        <p>EduLearn was founded with a simple yet powerful mission: to make quality education accessible to everyone, everywhere. We believe that learning should be engaging, practical, and tailored to individual needs.</p>
                        <p>Our vision is to create a world where anyone, regardless of their background or location, can acquire the skills needed to thrive in the modern workforce.</p>
                        <p>With a team of experienced instructors and industry professionals, we've helped thousands of students transform their careers and achieve their professional goals.</p>
                        <a href="courses.html" class="btn btn-primary-custom mt-3">Explore Our Courses</a>
                    </div>
                </div>
            </div>
            
            <!-- Stats Section -->
            <div class="row mt-5 pt-5">
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="stat-item">
                        <h2 class="stat-number">5000+</h2>
                        <p class="stat-label">Students Trained</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="stat-item">
                        <h2 class="stat-number">50+</h2>
                        <p class="stat-label">Expert Instructors</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="stat-item">
                        <h2 class="stat-number">100+</h2>
                        <p class="stat-label">Courses Available</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="stat-item">
                        <h2 class="stat-number">95%</h2>
                        <p class="stat-label">Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Meet Our Team</h2>
            <p class="section-subtitle">Learn from industry experts with years of practical experience</p>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="team-card">
                        <img src="{{ asset('assets/images/06.png') }}" alt="Team Member" class="team-img rounded-circle mb-3">
                        <h4>John Smith</h4>
                        <p class="text-muted">Lead Instructor</p>
                        <p>10+ years experience in web development and software engineering.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="team-card">
                        <img src="{{ asset('assets/images/06.png') }}" alt="Team Member" class="team-img rounded-circle mb-3">
                        <h4>Sarah Johnson</h4>
                        <p class="text-muted">Data Science Expert</p>
                        <p>Former data scientist at TechCorp with 8 years of industry experience.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="team-card">
                        <img src="{{ asset('assets/images/06.png') }}" alt="Team Member" class="team-img rounded-circle mb-3">
                        <h4>Mike Davis</h4>
                        <p class="text-muted">Digital Marketing Specialist</p>
                        <p>Helped grow 50+ businesses through strategic digital marketing campaigns.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-4">
                    <div class="team-card">
                        <img src="{{ asset('assets/images/06.png') }}" alt="Team Member" class="team-img rounded-circle mb-3">
                        <h4>Emily Wilson</h4>
                        <p class="text-muted">UX/UI Design Instructor</p>
                        <p>Award-winning designer with expertise in user-centered design principles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection