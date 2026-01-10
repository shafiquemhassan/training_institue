<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool  { return $user->can('course_viewAny') || $user->can('course_view'); }
    public function view(User $user, Course $m): bool { return $user->can('course_view'); }
    public function create(User $user): bool   { return $user->can('course_create'); }
    public function update(User $user, Course $m): bool { return $user->can('course_update'); }
    public function delete(User $user, Course $m): bool { return $user->can('course_delete'); }
    public function restore(User $user, Course $m): bool { return $user->can('course_restore'); }
    public function forceDelete(User $user, Course $m): bool { return $user->can('course_forceDelete'); }
}