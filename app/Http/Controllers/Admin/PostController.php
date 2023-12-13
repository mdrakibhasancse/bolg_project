<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\Tag;
use App\Notifications\AdminPost;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotifySubscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts']=Post::orderBy('created_at','desc')->get();
        return view('admin.post.index',$data);
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
        return view('admin.post.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

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
            $post->slug=Str::slug($request->title, '-');
            $post->status=$request->status;
            $post->is_approved='approved';
            $post->description=$request->description;
            $post->published_at=Carbon::now();
            $post->image= $image_path;
            $post->save();
            $post->categories()->attach($request->categories);
            $post->tags()->attach($request->tags);

            $subscribes= Subscribe::get();
            foreach($subscribes as $subscribe){
                Notification::route('mail', $subscribe->email)
                ->notify(new NewPostNotifySubscribe($post));
            }

            flash('Post Create Success')->success();
            return redirect('/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/admin/posts');
        }
        $data['post'] =  $post;
        return view('admin.post.details',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/admin/posts');
        }
        $data['post'] =  $post;
        $data['categories']=Category::get();
        $data['tags']=Tag::get();
        return view('admin.post.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'tags'=>'required',
            'image'=>'image',
            'categories'=>'required',
            'description'=>'required'
        ]);
        $post=Post::find($id);
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/admin/posts');
        }

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

        $post->title=$request->title;
        $post->slug=Str::slug($request->title, '-');
        $post->status=$request->status;
        $post->description=$request->description;
        $post->is_approved='approved';
        $post->image= $image_path;
        $post->save();
        $post->categories()->detach($post->categories);
        $post->tags()->detach($post->tags);
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        flash('Post Update Success')->success();
        return redirect('/admin/posts');
    }


    public function pendingPost(){
        $data['posts']=Post::where('is_approved','pending')->get();
        return view('admin.post.pending_post',$data);
    }

    public function is_approval($id){
        $post = Post::find($id);
        if($post->is_approved=='pending'){
            $post->is_approved = 'approved';
            $post->save();
            $post->user->notify(new AuthorPostApproved($post));
            $subscribes= Subscribe::get();
            foreach($subscribes as $subscribe){
                Notification::route('mail', $subscribe->email)
                ->notify(new NewPostNotifySubscribe($post));
            }
            flash('Post approved Success')->success();
        }else{
              flash('Post already approved')->success();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
     {
        $post=Post::find($id);
        if(!$post){
            flash('Data Not Fount')->error();
            return redirect('/admin/posts');
        }
        if ($post->image) {
          Storage::delete('public/post_images/' . $post->image);
        }
        $post->delete();
        flash('Data Delete Success')->success();
        return redirect('/admin/posts');
    }

    public function inactive($id){
        $tag=Post::find($id);
        $tag->status='inactive';
        $tag->save();
        return redirect('/admin/posts');
    }

    public function active($id){
        $tag=Post::find($id);
        $tag->status='active';
        $tag->save();
        return redirect('/admin/posts');
    }



}
