<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    



    /**
	 * 
	 	Many to Many relation with Roles table
	 */

	public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_claims');
    }
 
}
