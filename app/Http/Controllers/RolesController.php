<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Claimgroups;
use Gate;
use App\Repositories\RoleRepository;



class RolesController extends Controller
{



    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }
    



    public function index()
    {

        abort_unless(Gate::allows('view', User::class), 403);

        $roles = $this->role->all();

    	return view('Roles.index', compact('roles'));

    }




    public function show($id)
    {
        
        abort_unless(Gate::allows('edit', User::class), 403);

        $role = $this->role->get($id);

        $roles = $role[1];
        $claimGroups = $role[0];
        $hasClaim = $role[2];

        return view('Roles.edit', compact(['roles','claimGroups', 'hasClaim' ]));

    }


    public function create()
    {
        abort_unless(Gate::allows('create', User::class), 403);
        
    	return view('Roles.add');
    }


    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:100'
        ]);

        $this->role->store($validateData);

        return redirect()->route('roles')->with('success','Role created successfully.');
    
    }


    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);

        $validateData[] = $request->input('claim');

        foreach($validateData as $data){

            $role->claims()->sync($data);

        }
        return redirect(route('editRoles', $id));

    }



    public function destroy($id)
    {

    	$role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles')
                        ->with('success','Role created deleted.');

    }





}
