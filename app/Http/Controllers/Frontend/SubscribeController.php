<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SubscribeController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'email'=>'required|email|unique:subscribes'
        ]);
        $subscribe= new Subscribe();
        $subscribe->email=$request->email;
        $subscribe->save();
        Toastr::success('Added Subscribe', 'success');
        return redirect()->back();
    }
}
