<?php

namespace App\Http\Controllers;

use App\Models\AllUser;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Role Show, Create, Update, Delete
 * 
 * @author CodeCell <support@codecell.com.bd>
 * @contributor Sajjad <sajjad.develpr@gmail.com>
 * @created 16/07/23
 */
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::where(['school_id' => authUser()->id])->get();

        return view('frontend.school.role.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (hasPermission('role_create')) {
            $school_id = authUser()->id;
            $request->validate([
                'role_name' => "required|unique:roles,name,NULL,id,school_id,$school_id",
            ],
            [
                toast('Can not create role with same name.', 'error')

            ]);

            Role::create([
                'name' => $request->role_name,
                'school_id' => authUser()->id,
            ]);

            toast('Role Create Successfuly', 'success');
            return redirect()->route('roles.index');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (hasPermission('role_edit')) {

            $request->validate(
                [
                    'role_name' => 'required|max:100',
                ],
                ['role_name.required' => 'Role Name Required']
            );
            $thisRole = Role::findOrFail($id);
            $roleNameExist = Role::where('school_id', authUser()->id)->where('role_name', '!=', $thisRole->role_name)->where('role_name', $request->role_name)->exists();
            if ($roleNameExist) {
                toast('Role Name Exist', 'error');
                return redirect()->route('roles.index');
            }

            Role::findOrFail($id)->update([
                'role_name' => $request->role_name,
                'type'      => str_replace(' ', '_', $request->role_name),
            ]);

            toast('Role Updated Successfuly', 'success');
            return redirect()->route('roles.index');
        } else {
            return back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (hasPermission('role_delete')) {

            Role::findOrFail($id)->delete();

            toast('Role Delete Successfuly', 'success');
            return redirect()->route('roles.index');
        } else {
            return back();
        }
    }
    // public function roleUpdate(Request $request, $id)
    // {
    //     $role = AllUser::where('guard', 'teacher')->where('guard_id', $id)->first();

    //     $role->update([
    //         'role_id' => $request->id,
    //     ]);
    //     return response();
    // }
    public function roleUpdate(Request $request)

    {
        if (hasPermission('role_edit')) {

            $teacherId = $request->input('teacher_id');
            $role = AllUser::where('guard', 'teacher')->where('guard_id', $teacherId)->first();
            $roleId = $request->input('role_id');

            $role->update(
                ['role_id' => $roleId]
            );

            return response()->json(['message' => 'Permission updated successfully']);
        } else {
            return back();
        }
    }
}
