<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pedidos;
use Illuminate\Auth\Access\HandlesAuthorization;

class PedidosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pedidos can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allpedidos');
    }

    /**
     * Determine whether the pedidos can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pedidos  $model
     * @return mixed
     */
    public function view(User $user, Pedidos $model)
    {
        return $user->hasPermissionTo('view allpedidos');
    }

    /**
     * Determine whether the pedidos can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allpedidos');
    }

    /**
     * Determine whether the pedidos can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pedidos  $model
     * @return mixed
     */
    public function update(User $user, Pedidos $model)
    {
        return $user->hasPermissionTo('update allpedidos');
    }

    /**
     * Determine whether the pedidos can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pedidos  $model
     * @return mixed
     */
    public function delete(User $user, Pedidos $model)
    {
        return $user->hasPermissionTo('delete allpedidos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pedidos  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allpedidos');
    }

    /**
     * Determine whether the pedidos can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pedidos  $model
     * @return mixed
     */
    public function restore(User $user, Pedidos $model)
    {
        return false;
    }

    /**
     * Determine whether the pedidos can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pedidos  $model
     * @return mixed
     */
    public function forceDelete(User $user, Pedidos $model)
    {
        return false;
    }
}
