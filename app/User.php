<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     *  Many to Many relation with Roles table
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }


    public function hasRole($role)
    {
        // Assuming your claim model has a 'name' field on it
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        
        // If you pass a claim id in, check by id
        if (is_numeric($role)) {

            return $this->roles->contains('id', $role);
        }
        
        // If you pass a CLaim object in, compare each of your role's id to this one's
        foreach ($this->role as $user_role) {
            if ($user_role->id == $role->id) {
                return true;
            }
        }
        
        // If nothing matched, return false
        return false;
    }
}
