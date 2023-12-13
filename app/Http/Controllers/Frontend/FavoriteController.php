<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class FavoriteController extends Controller
{
    public function add($post){
        $user=Auth::user();
        $isFavoritePost = $user->favorite_to_posts()->where('post_id',$post)->count();
        if($isFavoritePost == 0){
            $user->favorite_to_posts()->attach($post);
            Toastr::success('Post added favorite list', 'success');
            return redirect()->back();
        }else{
            $user->favorite_to_posts()->detach($post);
            Toastr::success('Post remove favorite list', 'success');
            return redirect()->back();
        }
    }
}
