<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SuperAdmin, Role, Admin, EndUser, Blogger};
use DataTables;
use Illuminate\Support\Collection;


use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {

        if (super_admin()) {
            $role_dropdown = collect(['Super-Admin', 'Admin', 'User', 'Blogger']);
        } elseif (admin_user()) {
            $role_dropdown = collect(['Blogger']);
        } else {
            return back();
        }

        return view('user', compact('role_dropdown'));
    }
    public function insertUser(Request $request)
    {
        try {

            if ($request->role == "Super-Admin") {

                $validatedata = $this->validate($request, SuperAdmin::VALIDATION_RULES);
                $validatedata['password'] = Hash::make($request->password);
                $user = SuperAdmin::create($validatedata);
            }

            if ($request->role == "Admin") {

                $validatedata = $this->validate($request, Admin::VALIDATION_RULES);
                $validatedata['password'] = Hash::make($request->password);
                $user = Admin::create($validatedata);
            }
            if ($request->role == "User") {

                $validatedata = $this->validate($request, EndUser::VALIDATION_RULES);
                $validatedata['password'] = Hash::make($request->password);
                $user = EndUser::create($validatedata);
            }
            if ($request->role == "Blogger") {

                $validatedata = $this->validate($request, Blogger::VALIDATION_RULES);
                $validatedata['password'] = Hash::make($request->password);
                $user = Blogger::create($validatedata);
            }

            $role = new Role;
            $role->role = $request->role;
            $role->users_id = $user->id;
            $role->save();
            return response(json_encode(true), 200);
        } catch (exception $e) {
            return response(json_encode(false), 200);
        }
        // return back();
    }

    public function viewUser()
    {
        if (admin_user()) {
            $query = Role::select('id', 'role', 'users_id')->where('role', 'Blogger')->latest()->with('superadmin', 'admin', 'user', 'blogger')->get();
        } elseif (super_admin()) {
            $query = Role::select('id', 'role', 'users_id')->latest()->with('superadmin', 'admin', 'user', 'blogger')->get();
        }

        $result = DataTables::of($query)->addColumn('name', function ($row) {
            if ($row->role == "Super-Admin") {
                return  empty($row->superadmin->name) ? 'Not Set' : $row->superadmin->name;
            } else if ($row->role == "Admin") {
                return  empty($row->admin->name) ? 'Not Set' : $row->admin->name;
            } else if ($row->role == "User") {
                return  empty($row->user->name) ? 'Not Set' : $row->user->name;
            } else if ($row->role == "Blogger") {
                return  empty($row->blogger->name) ? 'Not Set' : $row->blogger->name;
            } else {
                return "Not Set";
            }
        })->addColumn('email', function ($row) {
            if ($row->role == "Super-Admin") {
                return  empty($row->superadmin->email) ? 'Not Set' : $row->superadmin->email;
            } else if ($row->role == "Admin") {
                return  empty($row->admin->email) ? 'Not Set' : $row->admin->email;
            } else if ($row->role == "User") {
                return  empty($row->user->email) ? 'Not Set' : $row->user->email;
            } else if ($row->role == "Blogger") {
                return  empty($row->blogger->email) ? 'Not Set' : $row->blogger->email;
            } else {
                return "Not Set";
            }
        })->addColumn('status', function ($row) {
            if ($row->role == "Super-Admin") {
                return  empty($row->superadmin->status) ? 'Not Set' : $row->superadmin->status;
            } else if ($row->role == "Admin") {
                return  empty($row->admin->status) ? 'Not Set' : $row->admin->status;
            } else if ($row->role == "User") {
                return  empty($row->user->status) ? 'Not Set' : $row->user->status;
            } else if ($row->role == "Blogger") {
                return  empty($row->blogger->status) ? 'Not Set' : $row->blogger->status;
            } else {
                return "Not Set";
            }
        })->addColumn('action', function ($row) {

            return '<td><a href="javascript:void(0)" onclick="edit_user(' . $row->id . ')"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="delete_user(' . $row->id . ')"><i class="fas fa-archive"></i></a> </td>';
        })->rawColumns(['action'])->addIndexColumn()->make(true);
        return $result;

        //  return response(json_encode($result),200);
    }

    public function editUser($id)
    {
        $data = Role::where('id', $id)->first();
        if ($data->role == "Super-Admin") {
            $data = [
                'id' => $data->id,
                'name' => $data->superadmin->name,
                'email' => $data->superadmin->email,
                'role' => $data->role,
                'status' => $data->superadmin->status,
            ];
        } elseif ($data->role == "Admin") {
            $data = [
                'id' => $data->id,
                'name' => $data->admin->name,
                'email' => $data->admin->email,
                'role' => $data->role,
                'status' => $data->admin->status,
            ];
        } elseif ($data->role == "User") {
            $data = [
                'id' => $data->id,
                'name' => $data->user->name,
                'email' => $data->user->email,
                'role' => $data->role,
                'status' => $data->user->status,
            ];
        } elseif ($data->role == "Blogger") {
            $data = [
                'id' => $data->id,
                'name' => $data->blogger->name,
                'email' => $data->blogger->email,
                'role' => $data->role,
                'status' => $data->blogger->status,
            ];
        }
        return response()->json($data);
    }
    public function deleteUser($id)
    {
        try {
            $data = Role::find($id);

            if ($data->role == "Blogger") {

                Blogger::where('id', $data->users_id)->delete();
            }
            if ($data->role == "Admin") {
                Admin::where('id', $data->users_id)->delete();
            }
            if ($data->role == "User") {

                EndUser::where('id', $data->users_id)->delete();
            }
            if ($data->role == "Super-Admin") {
                SuperAdmin::where('id', $data->users_id)->delete();
            }
            $data->delete();

            return response()->json(true);
        } catch (exception $e) {
            return response()->json(false);
        }
    }

    public function updateUser(Request $request)
    {
        try {


            $data = Role::find($request->id);

            if ($data->role == "Blogger") {
                $del = Blogger::find($data->users_id);
                $password = $del->password;
                $del->delete();
            }
            if ($data->role == "Admin") {

                $del = Admin::find($data->users_id);
                $password = $del->password;
                $del->delete();
            }
            if ($data->role == "User") {


                $del = EndUser::find($data->users_id);
                $password = $del->password;
                $del->delete();
            }
            if ($data->role == "Super-Admin") {

                $del = SuperAdmin::find($data->users_id);
                $password = $del->password;
                $del->delete();
            }
            if ($request->role == "Super-Admin") {

                $validatedata = $this->validate($request, SuperAdmin::VALIDATION_RULES);
                $validatedata['password'] = ($request->password) ? Hash::make($request->password) : $password;
                $user = SuperAdmin::create($validatedata);
            }

            if ($request->role == "Admin") {

                $validatedata = $this->validate($request, Admin::VALIDATION_RULES);
                $validatedata['password'] = ($request->password) ? Hash::make($request->password) : $password;
                $user = Admin::create($validatedata);
            }
            if ($request->role == "User") {

                $validatedata = $this->validate($request, EndUser::VALIDATION_RULES);
                $validatedata['password'] = ($request->password) ? Hash::make($request->password) : $password;

                $user = EndUser::create($validatedata);
            }
            if ($request->role == "Blogger") {

                $validatedata = $this->validate($request, Blogger::VALIDATION_RULES);
                $validatedata['password'] = ($request->password) ? Hash::make($request->password) : $password;

                $user = Blogger::create($validatedata);
            }
            $data->role = $request->role;
            $data->users_id = $user->id;
            $data->save();
            return response(json_encode(true), 200);
        } catch (exception $e) {
            return response(json_encode(false), 200);
        }
    }
}
