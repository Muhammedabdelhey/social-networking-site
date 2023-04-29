<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendShipController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['controller' => AuthController::class,], function () {
    Route::get('/', 'login')->name('login');
    Route::get('logout', 'logout');
    Route::post('loginRequest', 'loginRequest');
});
Route::group(['controller' => UserController::class,], function () {
    Route::get('register', 'register');
    Route::post('registerRequest', 'registerRequest');
    Route::get('profile/{id}', 'profile');
});

Route::group([
    'controller' => PostController::class,
    'prefix' => 'posts',
    'middleware' => 'auth'
], function () {
    Route::get('list', 'index');
    Route::get('/add', 'addPost');
    Route::post('/store', 'storePost');
    Route::get('/{postid}/edit', 'editPost');
    Route::get('/like/{id}', 'Like');
    Route::get('/dislike/{id}', 'disLike');
    Route::get('/{postid}/{notifyid}', 'showPost');
    Route::delete('/{id}', 'deletePost');
    Route::post('/update/{id}', 'updatePost');
});
Route::group([
    'controller' => CommentController::class,
    'prefix' => 'posts/comments'
], function () {
    Route::post('/create', 'addComment');
    Route::delete('/{id}', 'deleteComment');
    Route::post('{id}/update', 'updateComment');
});
Route::group(['controller' => FriendShipController::class,], function () {
    Route::get('friendrequests', 'frindsRequests');
    Route::get('acceptrequest/{id}', 'acceptRequest');
    Route::get('deleterequest/{id}', 'deleteRequest');
    Route::get('friends/{id}', 'friends');
});

// Route::get('test',function(){
//  return view('frindRequests');
// });