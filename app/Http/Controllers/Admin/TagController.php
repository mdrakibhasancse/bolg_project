<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags']=Tag::latest()->get();
        return view('admin.tag.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);
        $tag= new Tag();
        $tag->user_id=Auth::id();
        $tag->name=$request->name;
        $tag->slug=strtolower(str_replace(' ', '-', $request->name));
        $tag->status=$request->status;
        $tag->save();
        flash('Tag Create Success')->success();
        return redirect('/admin/tags');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag=Tag::find($id);
        if(!$tag){
            flash('Data Not Fount')->error();
            return redirect('/admin/tags');
        }
        $data['tag'] =  $tag;
        return view('admin.tag.edit',$data);

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
            'name'=>'required',
            'status'=>'required'
        ]);

        $tag=Tag::find($id);
        if(!$tag){
            flash('Data Not Fount')->error();
            return redirect('/admin/tags');
        }

        $tag->name=$request->name;
        $tag->status=$request->status;
        $tag->slug=strtolower(str_replace(' ', '-', $request->name));
        $tag->save();
        flash('Tag Update Success')->success();
        return redirect('/admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag=Tag::find($id);
        if(!$tag){
            flash('Data Not Fount')->error();
            return redirect('/admin/categories');
        }
        $tag->delete();
        flash('Data delete Success')->success();
        return redirect('/admin/tags');
    }

    public function inactive($id){
        $tag=Tag::find($id);
        $tag->status='inactive';
        $tag->save();
        return redirect('/admin/tags');
    }

    public function active($id){
        $tag=Tag::find($id);
        $tag->status='active';
        $tag->save();
        return redirect('/admin/tags');
    }
}
