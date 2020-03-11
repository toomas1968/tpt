<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use App\Repositories\UserRepository; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    public function index()
    {
        $users = $this->user->all();

    	return view('users.index', compact('users'));
    }


    public function removedUsers()
    {
        $deletedUsers = $this->user->getTrashedUsers();

        return view('users.removedUsers', compact('deletedUsers'));        
    }


    public function show($id)
    {

        $list = $this->user->get($id);

        $user = $list[1];
        $roles = $list[0];

    	return view('users.edit', compact(['user', 'roles']));

    }


    public function create()
    {
        $roles = $this->user->create();
    	return view ('users.add', compact('roles'));
    }


    public function store(Request $request)
    {
        $this->user->store($request);
        return redirect()->route('user');   
    }


    public function destroy($id)
    {
        if (Auth::user()->id == $id) 
        {
            return redirect()->route('user')->with('status', 'You can not delete yourself');
        } 
        else 
        {
             User::destroy($id);
             return redirect()->route('user')->with('status', 'User deleted');
        }

    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id);
        $user->restore();

        return redirect()->route('user')->with('status', 'User Restored');
    } 



    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->roles()->sync($data['role']);

        return redirect()->route('user');
    }

    
}
