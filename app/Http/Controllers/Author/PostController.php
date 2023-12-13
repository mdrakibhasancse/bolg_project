<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\AuthorPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user()->id;
        $data['posts']=Post::where('user_id',$user)->get();
        return view('author.post.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories']=Category::where('status','active')->get();
        $data['tags']=Tag::where('status','active')->get();
        return view('author.post.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {

            $post= new Post();

            if($request->hasFile('image')){
                $image = $request->file('image');
                $slug=str::slug($request->title);
                $image_path= $slug.'_'.date('his').'.'.$image->getClientOriginalExtension();
                $image->storeAs('post_images',$image_path,'public');
            }else{
                $image_path=null;
            }
            $post->user_id=Auth::id();
            $post->title=$request->title;
            $post->slug=str::slug($request->title, '-');
            $post->status=$request->status;
            $post->is_approved='pending';
            $post->description=$request->description;
            $post->published_at=Carbon::now();
            $post->image= $image_path;
            $post->save();
            $post->categories()->attach($request->categories);
            $post->tags()->attach($request->tags);

            $users = User::where('role_id','1')->get();
            Notification::send($users, new AuthorPost($post));

            flash('Post Create Success')->success();
            return redirect('/author/posts');
        } catch (\Throwable $th) {
            flash('Something Wrong'. $th->getMessage())->error();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/author/posts');
        }

        if($post->created_by != Auth::id()){
            flash('Not authorized this post')->error();
            return redirect('/author/posts');
        }
        $data['post'] =  $post;
        return view('author.post.details',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/author/posts');
        }
        if($post->created_by != Auth::id()){
            flash('Not authorized this post')->error();
            return redirect('/author/posts');
        }
        $data['post']=$post;
        $data['categories']=Category::where('status','active')->get();
        $data['tags']=Tag::where('status','active')->get();
        return view('author.post.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title'=>'required',
            'tags'=>'required',
            'image'=>'image',
            'categories'=>'required',
            'description'=>'required'
        ]);

        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/author/posts');
        }

        if($post->created_by != Auth::id()){
            flash('Not authorized this post')->error();
            return redirect('/author/posts');
        }

        try {

            if($request->hasFile('image')){
                if ($post->image) {
                    Storage::delete('public/post_images/' . $post->image);
                }
                $image = $request->file('image');
                $slug=str::slug($request->title);
                $image_path= $slug.'_'.date('his').'.'.$image->getClientOriginalExtension();
                $image->storeAs('post_images',$image_path,'public');
            }else {
                $image_path = $post->image;
            }

            $post->user_id=Auth::id();
            $post->title=$request->title;
            $post->slug=str::slug($request->title, '-');
            $post->status=$request->status;
            $post->is_approved='pending';
            $post->description=$request->description;
            $post->image= $image_path;
            $post->save();
            $post->categories()->attach($request->categories);
            $post->tags()->attach($request->tags);
            flash('Post update Success')->success();
            return redirect('/author/posts');
        } catch (\Throwable $th) {
            flash('Something Wrong'. $th->getMessage())->error();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post,Request $request)
    {
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/author/posts');
        }

        if ($post->image) {
         Storage::delete('public/post_images/' . $post->image);
        }

        $post->delete();
        flash('Data Delete Success')->success();
        return redirect('/author/posts');
    }

    public function inactive($id){
        $tag=Post::find($id);
        $tag->status='inactive';
        $tag->save();
        return redirect('/author/posts');
    }

    public function active($id){
        $tag=Post::find($id);
        $tag->status='active';
        $tag->save();
        return redirect('/author/posts');
    }
}
