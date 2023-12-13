<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(){
        $data['setting']= Setting::first();
        return view('admin.social_setting.edit',$data);
    }

    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'copyright'=>'required'
        ]);

       $setting = Setting::first();
       $setting->name=$request->name;
       $setting->facebook=$request->facebook;
       $setting->twitter=$request->twitter;
       $setting->instagram=$request->instagram;
       $setting->email=$request->email;
       $setting->linkedin=$request->linkedin;
       $setting->reddit=$request->reddit;
       $setting->copyright=$request->copyright;
       $setting->save();
       flash('setting update Success')->success();
       return redirect('/admin/setting');
    }
}
