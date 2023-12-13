<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $data['post'] = $user->posts;
        $data['pending_post'] =$data['post']->where('is_approved','pending')->count();

        $data['popular_post'] = $user->posts()
                              ->withCount('comments')
                              ->withCount('favorite_to_users')
                              ->orderBy('comments_count','desc')
                              ->orderBy('favorite_to_users_count','desc')
                              ->take(5)
                              ->get();
        return view('author.dashboard.index',$data);
    }
}
