<?php

namespace App\Policies;

use App\Models\Ieraksti;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IerakstiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ieraksti $ieraksti): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'user' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ieraksti $ieraksti): bool
    {
        return $user->id === $ieraksti->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ieraksti $ieraksti): bool
    {
        return $user->id === $ieraksti->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ieraksti $ieraksti): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ieraksti $ieraksti): bool
    {
        return false;
    }
}
