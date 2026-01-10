<?php

namespace App\Policies;

use App\Models\Ccategory;
use App\Models\User;

class CcategoryPolicy
{
    public function viewAny(User $user): bool
    {
         return $user->can('ccategory_create')
            || $user->can('ccategory_view')
            || $user->can('ccategory_update')
            || $user->can('ccategory_delete');
    }

    public function view(User $user, Ccategory $model): bool
    {
        return $user->can('ccategory_view');
    }

    public function create(User $user): bool
    {
        return $user->can('ccategory_create');
    }

    public function update(User $user, Ccategory $model): bool
    {
        return $user->can('ccategory_update');
    }

    public function delete(User $user, Ccategory $model): bool
    {
        return $user->can('ccategory_delete');
    }

    public function restore(User $user, Ccategory $model): bool
    {
        return $user->can('ccategory_restore');
    }

    public function forceDelete(User $user, Ccategory $model): bool
    {
        return $user->can('ccategory_forceDelete');
    }
}