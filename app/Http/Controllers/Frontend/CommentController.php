<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request,$post_id){
          $request->validate([
             'comment'=>'required',
          ]);

          $comment = new Comment();
          $comment->user_id = Auth::id();
          $comment->Post_id = $post_id;
          $comment->comment = $request->comment;
          $comment->save();
          Toastr::success('Post Comment Success', 'success');
          return redirect()->back();

    }
}
