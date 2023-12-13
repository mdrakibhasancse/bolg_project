<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index(){
        $data['subscribes']=Subscribe::get();
        return view('admin.subscribe.index',$data);
    }

    public function destroy($id){
        $subscribe=Subscribe::find($id);
        if(!$subscribe){
            flash('Data Not Fount')->error();
            return redirect('/admin/subscribes');
        }
        $subscribe->delete();
        flash('Data Delete Success')->success();
        return redirect('/admin/subscribes');
    }
}
