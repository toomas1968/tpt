<?php

namespace App\Policies;

use App\User;
use Auth;
use App\Claim;

use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */


    public function view(User $user)
    {

        $claimValue = Claim::where('value', 'roles_can_view')->first();
        
        return $claimValue->roles()->where('role_id', $user->roles->pluck('id'))->exists();

    }


    public function edit(User $user)
    {
        $claimValue = Claim::where('value', 'roles_can_edit')->first();

        return $claimValue->roles()->where('role_id', $user->roles->pluck('id'))->exists();
    }


    public function create(User $user)
    {
        $claimValue = Claim::where('value', 'roles_can_create')->first();

        return $claimValue->roles()->where('role_id', $user->roles->pluck('id'))->exists();
    }


}
