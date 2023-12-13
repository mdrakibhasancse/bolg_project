<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $data['comments']= Comment::latest()->get();
        return view('admin.comment.index',$data);
    }

    public function destroy($id){
         $comment = Comment::find($id);
         if(!$comment){
            flash('Data Not Fount')->error();
            return redirect('/admin/comment');
        }
        $comment->delete();
        flash('Data delete Success')->success();
        return redirect('/admin/comment');
    }
}
