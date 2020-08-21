<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserList(){
        $userData = User::all();
        return view('admin.user_list', \compact('userData'));
    }
    public function UserAdd(){
        // $userData = User::all();
        return view('admin.user_add');
    }

    public function UserStore(Request $request)
    {

        $request->validate([
            'name'      => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'is_admin' => 'required|numeric',
            'password' => 'required|min:8',
        ]);

        $userInsert = User::insert([
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'is_admin'      => $request->is_admin,
            'password'      => $request->password,
            'created_at'    => Carbon::now(),
        ]);


        return redirect('admin/user/list')->with('status','User successfully added');
    }

    public function UserDelete($id){

        User::findOrFail($id)->delete();
        return back()->with('status','User Deleted successfully');

    }

}
