<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FavoriteController as AdminFavoriteController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileSettingController;
use App\Http\Controllers\Admin\ReplyController as AdminReplyController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscribeController as AdminSubscribeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Author\CommentController as AuthorCommentController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;
use App\Http\Controllers\Author\FavoriteController as AuthorFavoriteController;
use App\Http\Controllers\Author\PostController as AuthorPostController;
use App\Http\Controllers\Author\ProfileSettingController as AuthorProfileSettingController;
use App\Http\Controllers\Author\ReplyController as AuthorReplyController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ReplyController;
use App\Http\Controllers\Frontend\SubscribeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'index']);

Route::get('/category/{slug}',[HomeController::class,'category']);
Route::get('/tag/{slug}',[HomeController::class,'tag']);
Route::get('/single_post/{slug}',[HomeController::class,'single_post']);
Route::get('/search',[HomeController::class,'search']);

Route::post('/subscribe',[SubscribeController::class,'store']);

Route::get('/contact',[ContactController::class,'contact']);
Route::post('/contact',[ContactController::class,'addContact']);


Route::group(['middleware' => ['auth']],function () {
      Route::post('/favorite/add/{post}',[FavoriteController::class,'add']);
      Route::post('/comment/{post}',[CommentController::class,'store']);
      Route::post('/comment_reply/{comment}',[ReplyController::class,'store']);
});


Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => ['auth','isAdmin']], function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::resource('/categories',CategoryController::class);
    Route::get('/categories/inactive/{id}',[CategoryController::class,'inactive']);
    Route::get('/categories/active/{id}',[CategoryController::class,'active']);
    Route::resource('/tags',TagController::class);
    Route::get('/tags/inactive/{id}',[TagController::class,'inactive']);
    Route::get('/tags/active/{id}',[TagController::class,'active']);
    Route::resource('/posts',PostController::class);
    Route::get('/posts/inactive/{id}',[PostController::class,'inactive']);
    Route::get('/posts/active/{id}',[PostController::class,'active']);
    Route::get('/pending',[PostController::class,'pendingPost']);
    Route::post('/approve/post/{id}',[PostController::class,'is_approval']);
    Route::get('/favorite/post',[AdminFavoriteController::class,'index']);

    Route::get('/comment',[AdminCommentController::class,'index']);
    Route::delete('/comment/{id}',[AdminCommentController::class,'destroy']);

    Route::get('/reply',[AdminReplyController::class,'index']);
    Route::delete('/reply/{id}',[AdminReplyController::class,'destroy']);

    Route::resource('/subscribes',AdminSubscribeController::class);

    Route::resource('/users',UserController::class);

    Route::get('/profiles',[ProfileSettingController::class,'index']);
    Route::post('/profiles/update',[ProfileSettingController::class,'profileUpdate']);
    Route::post('/update/password',[ProfileSettingController::class,'updatePassword']);


    Route::get('/setting',[SettingController::class,'edit']);
    Route::post('/setting',[SettingController::class,'update']);

    Route::get('/contact',[AdminContactController::class,'index']);
    Route::delete('/contact/{id}',[AdminContactController::class,'destroy']);

});


Route::group(['prefix'=>'author','as'=>'author.','middleware' => ['auth','isAuthor']], function(){
    Route::get('/dashboard',[AuthorDashboardController::class,'index']);
    Route::resource('posts',AuthorPostController::class);
    Route::get('/posts/inactive/{id}',[AuthorPostController::class,'inactive']);
    Route::get('/posts/active/{id}',[AuthorPostController::class,'active']);

    Route::get('/favorite/post',[AuthorFavoriteController::class,'index']);

    Route::get('/comment',[AuthorCommentController::class,'index']);
    Route::delete('/comment/{id}',[AuthorCommentController::class,'destroy']);


    Route::get('/reply',[AuthorReplyController::class,'index']);
    Route::delete('/reply/{id}',[AuthorReplyController::class,'destroy']);

    Route::get('/profiles',[AuthorProfileSettingController::class,'index']);
    Route::post('/profiles/update',[AuthorProfileSettingController::class,'profileUpdate']);
    Route::post('/update/password',[AuthorProfileSettingController::class,'updatePassword']);

});

require __DIR__.'/auth.php';


// Route::get('/test',function(){
//    $posts=Post::all();
//    $id= 1074;
//   foreach($posts as $post) {
//        $post->image="https://i.picsum.photos/id/".$id."/200/300.jpg";
//        $post->save();
//        $id++;
//   }
//    return $posts;
// });
