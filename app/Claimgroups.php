<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claimgroups extends Model
{

	protected $table = 'claim_groups';

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
