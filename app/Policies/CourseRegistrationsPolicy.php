<?php

namespace App\Policies;

use App\Models\CourseRegistration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseRegistrationsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseRegistration  $courseRegistrations
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.course_registrations.index'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.course_registrations.create'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseRegistration  $courseRegistrations
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function edit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.course_registrations.edit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseRegistration  $courseRegistrations
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.course_registrations.destroy'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseRegistration  $courseRegistrations
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CourseRegistration $courseRegistrations)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CourseRegistration  $courseRegistrations
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CourseRegistration $courseRegistrations)
    {
        //
    }
}
