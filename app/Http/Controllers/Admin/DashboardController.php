<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['posts'] = Post::get();
        $data['popular_posts'] = Post::withCount('comments')
                            ->withCount('favorite_to_users')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_to_users_count','desc')
                            ->take(5)->get();
        $data['pending_post'] = Post::where('is_approved','pending')->count();
        $data['user_count'] = User::where('role_id',2)->count();

        return view('admin.dashboard.index',$data);
    }
}
