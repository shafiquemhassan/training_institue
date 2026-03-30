# Training Institute Website (Laravel + Filament Admin)

## Overview

This is a **role-based training institute web application** built with **Laravel 12** and **Filament v4**.  

The project implements:

- **Admin panel** with **Role-Based Authentication** using **Spatie Roles & Permissions**
- Management of **Users, Roles, and Permissions**
- CRUD operations for **Categories** and **Blogs**
- Relationship between **Blogs and Categories**
- Responsive and elegant **frontend** using **Bootstrap 5** with frosted-glass UI design
- Multi-role dashboards (Admin, Editor, Employee) with permission-controlled access

---

## Purpose

This project was created primarily for **learning and experimentation**. The goals were:

1. Practice **Laravel deployment** and **full-stack development**
2. Explore **role-based authentication** and **permission management**
3. Learn **Filament v4 resource management** for CRUD operations
4. Experiment with **different generative AI tools** (e.g., ChatGPT, Gemini, Claude) to assist in development
5. Understand how to structure a **real-world training institute web application**

> ⚠️ This project is **not intended for production use**. It is a learning exercise for personal development.

---

## Features

### Admin Panel
- Create, view, edit, and delete **Users, Roles, and Permissions**
- Assign permissions to roles and roles to users
- Admin dashboard to manage all entities
- Editor and Employee dashboards with limited access based on assigned permissions

### Category Management
- CRUD operations for categories
- Automatic slug generation
- Rich description and image upload
- Role & permission-based access using policies

### Blog Management
- CRUD operations for blogs
- Many-to-many relationship with categories
- Rich text editor for content with file attachments
- Featured image and thumbnail upload
- Role & permission-based access using policies

### Frontend (Bootstrap 5)
- Fully responsive and mobile-friendly
- Frosted-glass UI with transparency and blurred backgrounds
- Sections: Home, About, Courses, Course Details, Blog, Blog Details
- Interactive sliders for courses and banners
- Sidebar for latest blogs, categories, and courses
- Easy-to-update sample content

---

You can now log in to the respective panels using these accounts:

Admin: admin@example.com / admin@123
Editor: editor@example.com / editor@123
Employee: employee@example.com / employee@123
