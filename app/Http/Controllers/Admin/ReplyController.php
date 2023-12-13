<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index(){
        $data['replies']= Reply::latest()->get();
        return view('admin.comment_reply.index',$data);
    }

    public function destroy(){

    }
}
