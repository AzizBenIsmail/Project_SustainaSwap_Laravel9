<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Template component/index');
});
Route::get('/about', function () {
    return view('Template component/about');
});
Route::get('/contact', function () {
    return view('Template component/contact');
});
Route::get('/faq', function () {
    return view('Template component/faq');
});
Route::get('/product-detail', function () {
    return view('Template component/product-detail');
});
Route::get('/sign-in', function () {
    return view('Sign/sign-in');
});
Route::get('/sign-up', function () {
    return view('Sign/sign-up');
});

//Route::resource('/products',Controllers\ItemController::class);
Route::resource('/items', Controllers\ItemController::class);
Route::resource('Comment', Controllers\CommentController::class);
Route::resource('Complaint', Controllers\ComplaintController::class);
Route::resource('Conversation', Controllers\ConversationController::class);
Route::resource('Message', Controllers\MessageController::class);
Route::resource('Trade', Controllers\TradeController::class);


Route::resource('posts', \App\Http\Controllers\PostController::class)->names([
    'index' => 'posts.index',
]);
//Route::get('/posts/create', [Controllers\PostController::class, 'create'])->name('posts.create');
//Route::post('/posts', [Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/post/{post}', [Controllers\PostController::class, 'show'])->name('posts.show');

Route::resource('/comments', \App\Http\Controllers\CommentController::class)->names([
    'index' => 'comments.index',
]);
// Show the comment creation form
Route::get('/comments/create', [Controllers\CommentController::class, 'create'])->name('comments.create');

Route::resource('comments', Controllers\CommentController::class);
Route::post('/comments', [Controllers\CommentController::class, 'store'])->name('comments.store');
Route::post('/commentPost', [Controllers\CommentController::class, 'storePost'])->name('comments.storePost');


Route::resource('/trades', Controllers\TradeController::class);
Route::resource('Post', Controllers\PostController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
