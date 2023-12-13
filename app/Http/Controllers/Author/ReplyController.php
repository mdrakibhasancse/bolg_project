<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function index(){
        $data['posts']= Auth::user()->posts;
        return view('author.comment_reply.index',$data);
    }

    public function destroy($id){
        $comment_reply = Reply::find($id);
        if(!$comment_reply){
            flash('Data Not Fount')->error();
            return redirect('/author/comment_reply');
        }
        if($comment_reply->comment->post->user->id == Auth::id()){
            $comment_reply->delete();
            flash('Data delete Success')->success();
            return redirect('/author/comment_reply');
        }else{
            flash('are you not authorized to delete this post')->error();
            return redirect('/author/comment_reply');
        }

    }
}
