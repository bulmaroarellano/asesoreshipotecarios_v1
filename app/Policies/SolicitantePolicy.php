<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Solicitante;
use Illuminate\Auth\Access\HandlesAuthorization;

class SolicitantePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the solicitante can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list solicitantes');
    }

    /**
     * Determine whether the solicitante can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Solicitante  $model
     * @return mixed
     */
    public function view(User $user, Solicitante $model)
    {
        return $user->hasPermissionTo('view solicitantes');
    }

    /**
     * Determine whether the solicitante can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create solicitantes');
    }

    /**
     * Determine whether the solicitante can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Solicitante  $model
     * @return mixed
     */
    public function update(User $user, Solicitante $model)
    {
        return $user->hasPermissionTo('update solicitantes');
    }

    /**
     * Determine whether the solicitante can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Solicitante  $model
     * @return mixed
     */
    public function delete(User $user, Solicitante $model)
    {
        return $user->hasPermissionTo('delete solicitantes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Solicitante  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete solicitantes');
    }

    /**
     * Determine whether the solicitante can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Solicitante  $model
     * @return mixed
     */
    public function restore(User $user, Solicitante $model)
    {
        return false;
    }

    /**
     * Determine whether the solicitante can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Solicitante  $model
     * @return mixed
     */
    public function forceDelete(User $user, Solicitante $model)
    {
        return false;
    }
}
