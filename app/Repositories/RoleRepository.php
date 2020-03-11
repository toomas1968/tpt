<?php 

namespace App\Repositories;


use App\Role;
use App\Claimgroups;

class RoleRepository implements RoleRepositoryInterface
{


	public function all()
	{
		return Role::all();
	}	




	public function get($role_id)
	{

    	$claimgroups = claimgroups::all();

    	$role = Role::find($role_id);

        $hasRole = $role->claims->contains($role->id == $role_id);


        $collection = [$claimgroups, $role, $hasRole];

		return $collection;
	}	




	public function store(array $role_data)
	{
		return Role::create($role_data);
	}	




	public function update($role_id, array $role_data)
	{
		return Role::find($role_id)->update($role_data);
	}	




	public function delete($role_id)
	{
		return Role::destroy($role_id);
	}	


}



 ?>