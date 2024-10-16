<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Condition;
use App\Models\User;

class ConditionPolicy
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
     * @param  User      $user
     * @param  Condition $condition
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function view(User $user, Condition $condition): bool
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
     * @param  User      $user
     * @param  Condition $condition
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function update(User $user, Condition $condition): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can delete the model
     * @param  User      $user
     * @param  Condition $condition
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function delete(User $user, Condition $condition): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can restore the model
     * @param  User      $user
     * @param  Condition $condition
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function restore(User $user, Condition $condition): bool
    {
        return $user->role === Role::ADMIN->toString();
    }

    /**
     * Determine whether the user can permanently delete the model
     * @param  User      $user
     * @param  Condition $condition
     * @return bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function forceDelete(User $user, Condition $condition): bool
    {
        return $user->role === Role::ADMIN->toString();
    }
}
