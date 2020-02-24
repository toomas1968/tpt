<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    

	protected $fillable = [
        'name', 'description'
    ];


	/**
	 * 
	 	Many to Many relation with Users table
	 */

	public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }



    /**
	 * 
	 	Many to Many relation with Users table
	 */

	public function claims()
    {
        return $this->belongsToMany(Claim::class, 'role_claims');
    }



    public function hasClaim($claim)
	 {
	    // Assuming your claim model has a 'name' field on it
	    if (is_string($claim)) {
	        return $this->claims->contains('name', $claim);
	    }
	    
	    // If you pass a claim id in, check by id
	    if (is_numeric($claim)) {

	        return $this->claims->contains('id', $claim);
	    }
	    
	    // If you pass a CLaim object in, compare each of your role's id to this one's
	    foreach ($this->claims as $user_role) {
	        if ($user_role->id == $claims->id) {
	            return true;
	        }
	    }
	    
	    // If nothing matched, return false
	    return false;
	 }

}
