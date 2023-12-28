<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    /**
     * Premission Page show
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @created 16-07-23
     * 
     * @modifier Shahidul Islam <contact.shahidul@gmail.com>
     * @last_modified 03-10-2023
     */
    public function index(int $id)
    {
        if (hasPermission('role_create')) {

            $data['role_id'] = $id;

            // $role = \App\Models\Role::find($role_id);

            // return $role->permissions->whereIn("name", ["show", "edit"]);
            // return authUser();
            // $data['teachers'] = Teacher::where('school_id', authUser()->id)->get();

            return view('frontend.school.role.permission', $data);
        } else {
            return back();
        }
    }
    /**
     * Premission Create Show
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @created 17-07-23
     */
    public function premissionCreate()
    {
        if (hasPermission('role_create')) {


            $data['roles']          = Role::where('school_id', authUser()->id)->get();
            $data['teachers']       = Teacher::where('school_id', authUser()->id)->get();

            return view('frontend.school.role.permission_create', $data);
        } else {
            return back();
        }
    }

    /**
     * Premission Create Show
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param int $id
     * @created 17-07-23
     */
    public function premissionDelete(int $id)
    {
        if (hasPermission('role_delete')) {

            Permission::findOrFail($id)->delete();

            toast("Permission Delete Successfuly", 'success');
            return redirect()->back();
        } else {
            return back();
        }
    }
    /**
     * Premission Save
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request
     * @param $request
     * @param $role_id
     * @created 16-07-23
     * 
     * @modifier Shahidul Islam <contact.shahidul@gmail.com>
     * @last_modified 03-10-2023 
     */
    public function store(Request $request,$role_id)
    {
 
    // $request->validate([
    //     'role_id' => 'required|exists:roles,id',
    //     'permission' => 'array',
    //     'permission.*' => 'exists:permissions,id',
    // ]);

      $role = Role::find($role_id);
    $permissions = $request->input('permission');

    $role->permissions()->sync($permissions);

    return back()->with("success" ,"Permission save Succeess");

    // return response()->json(['message' => 'Permissions saved successfully']);
}

    /**
     * Premission Edit
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param int $id
     * @created 17-07-23
     */
    public function premissionEdit($id)
    {
        if (hasPermission('role_edit')) {

            $data['permission']     = Permission::where(['school_id' => authUser()->id, 'id' => $id])->first();
            $data['roles']          = Role::where('school_id', authUser()->id)->get();
            $data['teachers']       = Teacher::where('school_id', authUser()->id)->get();

            return view('frontend.school.role.permission_edit', $data);
        } else {
            return back();
        }
    }
    /**
     * Premission Edit
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request
     * @param $request
     * @param int $id
     * @created 17-07-23
     */
    public function premissionUpdate(Request $request, $id)
    {
        if (hasPermission('role_update')) {

            $request->validate([
                'role_name'        => 'required',
                'teacher_name'   => 'required',
                'permission.*'     => 'required',
            ]);

            try {
                $teacher = $request->teacher_name;
                Permission::findOrFail($id)->update([
                    'teacher_id'    => $teacher,
                    'role_id'     => $request->role_name,
                    'permission'    => $request->permission,
                ]);

                toast('Permission Update Successfuly', 'success');
                return redirect()->route('permission.index');
            } catch (\Exception $e) {
                Alert::error('Server Problem', $e->getMessage());
                return redirect()->back();
            }
        } else {
            return back();
        }
    }

    /**
     * Delete All
     * 
     * @author CodeCell <support@codecell.com.bd>
     * @contributor Sajjad <sajjad.develpr@gmail.com>
     * @param Request
     * @param $request
     * @created 17-07-23
     */
    public function deleteAll(Request $request)
    {
        if (hasPermission('role_delete')) {

            Permission::whereIn('id', $request->permissions)->delete();

            Alert::success(' Selected Permission Are Deleted', 'Success Message');
            return response()->json(['status' => 'success']);
        } else {
            return back();
        }
    }
}
