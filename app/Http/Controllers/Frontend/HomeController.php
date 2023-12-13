<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
        $data['posts'] = Post::with('categories','user')->latest()->approved()->published()->paginate(5);
        $data['slider_posts']= Post::with('categories','user')->latest()->approved()->published()->take(3)->get();
        return view('frontend.home.index',$data);
    }

    public function single_post($slug){
        $post=Post::with('categories','user')->where('slug',$slug)->approved()->published()->first();
        if(!$post){
            return redirect('/');
        }
        $data['post']= $post;
        return view('frontend.home.single_post',$data);
    }


    public function Category($slug){
        $data['category']= Category::where('slug',$slug)->first();
        $data['posts']= $data['category']->posts()->latest()->approved()->published()->get();
        return view('frontend.home.category',$data);
    }


    public function tag($slug){
        $data['tag']= Tag::where('slug',$slug)->first();
        $data['posts']= $data['tag']->posts()->latest()->approved()->published()->get();
        return view('frontend.home.tag',$data);
    }

    public function search(Request $request){
       $request->validate([
          'search'=>'required'
       ]);
       $data['search'] = $request->search;
       $data['posts'] = Post::where('title','like','%'.$data['search'].'%')->approved()->published()->get();
       return view('frontend.home.search_post',$data);
    }

}
