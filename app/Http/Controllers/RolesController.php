<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\Claim;
use App\Claimgroups;
use Gate;

class RolesController extends Controller
{

    public function index()
    {

    	abort_unless(Gate::allows('view', Role::class), 403);

    	$roles = Role::all();

    	return view('Roles.index', compact('roles'));
    }




    public function show($id)
    {
        
        $claimgroups = claimgroups::all();

        $role = Role::findOrFail($id);

        $hasRole = $role->claims->contains($role->id == $id);

        return view('Roles.edit', compact('claimgroups', 'role', 'hasRole'));



    }

    public function create()
    {
    	return view('Roles.add');
    }

    public function store(Request $request)
    {


        $validateData = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:100'
        ]);

        Role::create($validateData);

        return redirect()->route('roles')
                        ->with('success','Role created successfully.');
    }

    public function update(Request $request, $id)
    {
        

       
    	//$validateData = $request->validate([
          //  'claim' => ''
        //]);


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
