<?php 


namespace App\Repositories;

use App\User;
use App\Role;



class UserRepository
{


    public function all()
    {
        return User::all();
    }   



    public function get($user_id)
    {

        $roles = Role::all();

        $user = User::find($user_id); 

        return [$roles, $user];
    }   




    public function store(array $role_data)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        $user->roles()->attach($data['role']);

        return true;

    }   




    public function update($role_id, array $role_data)
    {
        return Role::find($role_id)->update($role_data);
    }   




    public function delete($role_id)
    {
        return Role::destroy($role_id);
    }   


    public function create()
    {
        return Role::all();
    }


    public function getRole()
    {
        return Role::all();
    }




    public function getTrashedUsers()
    {
        return User::onlyTrashed()->get();
    }


}



 ?>