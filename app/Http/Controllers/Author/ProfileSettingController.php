<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileSettingController extends Controller
{
    public function index()
    {
        return view('author.profile_setting.index');
    }

    public function profileUpdate(Request $request){

        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name'=>'required',
            'email'=>"required",
            'image'=>'sometimes|nullable|image'
        ]);

        if($request->hasFile('image')){
            if ($user->image) {
                Storage::delete('public/user_images/' . $user->image);
            }
            $image = $request->file('image');
            $name=str::slug($request->name);
            $image_path= $name.'_'.date('his').'.'.$image->getClientOriginalExtension();
            $image->storeAs('user_images',$image_path,'public');
        }else {
             $image_path =$user->image;
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->description=$request->description;
        $user->image=$image_path;
        $user->save();
        flash('Profile Update Success')->success();
        return redirect('/author/profiles');
    }


    public function updatePassword(Request $request){
         $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed'
         ]);

         $oldPassword=Auth::user()->password;
         if(Hash::check($request->old_password,$oldPassword)){
            if(!Hash::check($request->password,$oldPassword)){
                $user = User::find(Auth::id());
                $user->password=Hash::make($request->password);
                $user->save();
                flash('Password Change Success')->success();
                Auth::logout();
                return redirect()->back();
            }else{
                flash('New password and old password are same')->error();
                return redirect()->back();
            }

         }else{
            flash('Current password is not match')->error();
            return redirect()->back();
         }
    }
}
