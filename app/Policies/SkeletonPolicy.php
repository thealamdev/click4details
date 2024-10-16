<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Skeleton;
use App\Models\User;

class SkeletonPolicy
{
    /**
     * Determine whether the user can view any models
     * @param  User $user
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function viewAny(User $user): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can view the model
     * @param  User     $user
     * @param  Skeleton $skeleton
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function view(User $user, Skeleton $skeleton): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can create models
     * @param  User $user
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function create(User $user): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can update the model
     * @param  User     $user
     * @param  Skeleton $skeleton
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function update(User $user, Skeleton $skeleton): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can delete the model
     * @param  User     $user
     * @param  Skeleton $skeleton
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function delete(User $user, Skeleton $skeleton): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can restore the model
     * @param  User     $user
     * @param  Skeleton $skeleton
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function restore(User $user, Skeleton $skeleton): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can permanently delete the model
     * @param  User     $user
     * @param  Skeleton $skeleton
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function forceDelete(User $user, Skeleton $skeleton): bool
    {
        return $user->role === Role::ADMIN->toString();
    }
}
