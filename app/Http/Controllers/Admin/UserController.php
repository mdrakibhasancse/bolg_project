<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $data['users']= User::where('role_id',2)->get();
        return view('admin.user.index',$data);
    }

    public function edit($id){
        $user= User::find($id);
        if(!$user){
            flash('Data not found')->error();
            return redirect('/admin/users');
        }
        $data['user']  = $user;
        $data['roles'] = Role::get();
        return view('admin.user.edit',$data);
    }


    public function update(Request $request,$id){
        $user = User::find($id);
        if (Auth::user()->id == $id) {
            flash('Admin can not be changed Role')->warning();
            return redirect('/admin/users');
        }
        $user->role_id = $request->role;
        $user->save();
        flash('Role changed Successfully')->success();
        return redirect('/admin/users');
    }


    public function show($id){
        $user= User::find($id);
        if(!$user){
            flash('Data not found')->error();
            return redirect('/admin/users');
        }

        $data['user']  = $user;
        $data['roles'] = Role::get();
        return view('admin.user.details',$data);
    }
    public function destroy($id){
        $user = User::find($id);
        if (Auth::user()->id == $id) {
            flash('Admin can not be delete')->warning();
            return redirect('/admin/users');
        }
        if ($user->image) {
            Storage::delete('public/user_images/' . $user->image);
        }
        $user->delete();
        flash('User Delete Success')->error();
        return redirect('/admin/users');
    }
}
