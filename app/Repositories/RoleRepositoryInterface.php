<?php 

namespace App\Repositories;


interface RoleRepositoryInterface
{




	/**
	 * 	Get all Roles
	 * @param mixed
	 */

	public function all();




	/**
	 *  Stores an Role
	 */

	public function store(array $role_data);




	/**
	 *  Gets specific role
	 * @param int
	 */

	public function get($role_id);




	/**
	 *  Updates role
	 * 
	 */

	public function update($role_id, array $role_data);




	/**
	 * Deletes role
	 */

	public function delete($role_id);

}



 ?>