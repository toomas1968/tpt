<?php

namespace App\Policies;

use App\User;
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
        return in_array($user->email, [
            'toomas.unt1968@gmail.com',
        ]);
    }


}
