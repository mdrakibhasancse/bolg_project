<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(){
        $data['posts'] = Auth::user()->favorite_to_posts;
        return view('admin.favorite_post.index',$data);
    }
}
