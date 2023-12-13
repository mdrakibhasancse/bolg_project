<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        $data['posts']= Auth::user()->posts;
        return view('author.comment.index',$data);
    }

    public function destroy($id){
        $comment = Comment::find($id);
        if(!$comment){
            flash('Data Not Fount')->error();
            return redirect('/author/comment');
        }
        if($comment->post->user->id == Auth::id()){
            $comment->delete();
            flash('Data delete Success')->success();
            return redirect('/author/comment');
        }else{
            flash('are you not authorized to delete this post')->error();
            return redirect('/author/comment');
        }

    }
}
