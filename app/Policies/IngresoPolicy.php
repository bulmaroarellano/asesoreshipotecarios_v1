<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ingreso;
use Illuminate\Auth\Access\HandlesAuthorization;

class IngresoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the ingreso can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list ingresos');
    }

    /**
     * Determine whether the ingreso can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ingreso  $model
     * @return mixed
     */
    public function view(User $user, Ingreso $model)
    {
        return $user->hasPermissionTo('view ingresos');
    }

    /**
     * Determine whether the ingreso can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create ingresos');
    }

    /**
     * Determine whether the ingreso can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ingreso  $model
     * @return mixed
     */
    public function update(User $user, Ingreso $model)
    {
        return $user->hasPermissionTo('update ingresos');
    }

    /**
     * Determine whether the ingreso can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ingreso  $model
     * @return mixed
     */
    public function delete(User $user, Ingreso $model)
    {
        return $user->hasPermissionTo('delete ingresos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ingreso  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete ingresos');
    }

    /**
     * Determine whether the ingreso can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ingreso  $model
     * @return mixed
     */
    public function restore(User $user, Ingreso $model)
    {
        return false;
    }

    /**
     * Determine whether the ingreso can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Ingreso  $model
     * @return mixed
     */
    public function forceDelete(User $user, Ingreso $model)
    {
        return false;
    }
}
