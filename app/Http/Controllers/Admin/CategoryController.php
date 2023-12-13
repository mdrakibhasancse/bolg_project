<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories']=Category::latest()->get();
        return view('admin.category.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category= new Category();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $slug=str::slug($request->name);
            $image_path= $slug.'_'.date('his').'.'.$image->getClientOriginalExtension();
            $image->storeAs('category_images',$image_path,'public');
            }else{
                $image_path=null;
        }
        $category->user_id=Auth::id();
        $category->name=$request->name;
        $category->slug=strtolower(str_replace(' ', '-', $request->name));
        $category->status=$request->status;
        $category->image=$image_path;
        $category->save();
        flash('Category Create Success')->success();
        return redirect('/admin/categories');
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
        $category=Category::find($id);
        if(!$category){
            flash('Data Not Fount')->error();
            return redirect('/admin/categories');
        }
        $data['category'] =  $category;
        return view('admin.category.edit',$data);

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
            'name'=>'required|unique:categories,id,'.$id,
            'status'=>'required',
            'image'=>'image',
        ]);


        $category=Category::find($id);
        if(!$category){
            flash('Data Not Fount')->error();
            return redirect('/admin/categories');
        }

        if($request->hasFile('image')){
            if ($category->image) {
                Storage::delete('public/category_images/' . $category->image);
            }
            $image = $request->file('image');
            $slug=str::slug($request->name);
            $image_path= $slug.'_'.date('his').'.'.$image->getClientOriginalExtension();
            $image->storeAs('category_images',$image_path,'public');
        }else {
             $image_path = $category->image;
        }
        $category->name=$request->name;
        $category->status=$request->status;
        $category->slug=strtolower(str_replace(' ', '-', $request->name));
        $category->image= $image_path;
        $category->save();
        flash('Category Update Success')->success();
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if(!$category){
            flash('Data Not Fount')->error();
            return redirect('/admin/categories');
        }
        $category->delete();
        flash('Data delete Success')->success();
        return redirect('/admin/categories');
    }

    public function inactive($id){
        $category=Category::find($id);
        $category->status='inactive';
        $category->save();
        return redirect('/admin/categories');
    }

    public function active($id){
        $category=Category::find($id);
        $category->status='active';
        $category->save();
        return redirect('/admin/categories');
    }
}
