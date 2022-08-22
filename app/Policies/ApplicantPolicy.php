<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the applicant can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list applicants');
    }

    /**
     * Determine whether the applicant can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Applicant  $model
     * @return mixed
     */
    public function view(User $user, Applicant $model)
    {
        return $user->hasPermissionTo('view applicants');
    }

    /**
     * Determine whether the applicant can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create applicants');
    }

    /**
     * Determine whether the applicant can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Applicant  $model
     * @return mixed
     */
    public function update(User $user, Applicant $model)
    {
        return $user->hasPermissionTo('update applicants');
    }

    /**
     * Determine whether the applicant can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Applicant  $model
     * @return mixed
     */
    public function delete(User $user, Applicant $model)
    {
        return $user->hasPermissionTo('delete applicants');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Applicant  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete applicants');
    }

    /**
     * Determine whether the applicant can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Applicant  $model
     * @return mixed
     */
    public function restore(User $user, Applicant $model)
    {
        return false;
    }

    /**
     * Determine whether the applicant can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Applicant  $model
     * @return mixed
     */
    public function forceDelete(User $user, Applicant $model)
    {
        return false;
    }
}
