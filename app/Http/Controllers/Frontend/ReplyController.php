<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class ReplyController extends Controller
{
    public function store(Request $request,$comment_id){
        $request->validate([
           'message'=>'required',
        ]);

        $commentReply = new Reply();
        $commentReply->user_id = Auth::id();
        $commentReply->comment_id = $comment_id;
        $commentReply->message = $request->message;
        $commentReply->save();
        Toastr::success('Reply comment Success', 'success');
        return redirect()->back();
    }
}
