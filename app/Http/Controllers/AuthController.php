<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SuperAdmin, Role, Admin, EndUser, Blogger};
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }
    public function validateCredentials(Request $request)
    {


    //    $a= Hash::make('admin');
    //    dd($a);
        $this->validate($request, [
            'admin_username' => 'required',
            'admin_password' => 'required',
            'admin_role' => 'required',
        ]);
        $email = $request->admin_username;
        $password = $request->admin_password;
        $role = $request->admin_role;
        if ($request->admin_role == "Super-Admin") {
            $isExist = SuperAdmin::where('email', $email)->where('status', 'Active')->first();
        }
        if ($request->admin_role == "Admin") {
            $isExist = Admin::where('email', $email)->where('status', 'Active')->first();
        }
        if ($request->admin_role == "User") {
            $isExist = EndUser::where('email', $email)->where('status', 'Active')->first();
        }
        if ($request->admin_role == "Blogger") {
            $isExist = Blogger::where('email', $email)->where('status', 'Active')->first();
        }
    

        if ($isExist) {
            if (Hash::check($password, $isExist->password)) {
               
                $session_data['admin_id'] = $isExist->id;
                $session_data['admin_name'] = $isExist->name;
                $session_data['admin_role'] = $request->admin_role;
                $session_data['admin_email'] = $isExist->email;
                $session_data['status'] = $isExist->status;
                session()->put('AdminData', $session_data);

                return redirect()->route('home.dashboard');
            } else {
                session()->flash('message', '<strong>Oh Snap!</strong> Wrong Password!');
                session()->flash('message_class', 'danger');
                return redirect('/');
            }
        } else {
            session()->flash('message', 'Wrong <strong>Email Address</strong> or your account is not <strong>Active</strong>!');
            session()->flash('message_class', 'danger');
            return redirect('/');
        }
    }
}
