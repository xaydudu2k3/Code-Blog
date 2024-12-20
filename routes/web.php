<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\MyPosts;

Route::get('/', [UserController::class, 'loadHomePage']);

Route::get('/registration/form', [AuthController::class, 'loadRegisterForm']);
Route::post('/register/user', [AuthController::class, 'registerUser'])->name('registerUser');

Route::get('/login/form', [AuthController::class, 'loadLoginPage']);

Route::post('/login/user', [AuthController::class, 'LoginUser'])->name('LoginUser');

Route::get('/logout', [AuthController::class, 'LogoutUser']);

Route::get('/forgot/password', [AuthController::class, 'forgotPassword']);

Route::post('/forgot', [AuthController::class, 'forgot'])->name('forgot');

Route::get('/reset/password', [AuthController::class, 'loadResetPassword']);

Route::post('/reset/user/password', [AuthController::class, 'ResetPassword'])->name('ResetPassword');

Route::get('/404', [AuthController::class, 'load404']);
// create controllers for each user
Route::get('user/home', [UserController::class, 'loadHomePage']);
Route::get('my/posts', [UserController::class, 'loadMyPosts'])->middleware('user');
Route::get('create/post', [UserController::class, 'loadCreatePost'])->middleware('user');
Route::get('/edit/post/{post_id}', [UserController::class, 'loadEditPost'])->middleware('user');
Route::get('/view/post/{id}', [UserController::class, 'loadPostPage']);
Route::get('/home/tag/{tag_id}', [UserController::class, 'loadHomePagewithTag']);
Route::get('/profile', [UserController::class, 'loadProfile'])->middleware('user')->name('profile.user');
Route::get('/trending', [UserController::class, 'loadTrending']);
Route::get('/trending/{tag_id}', [UserController::class, 'loadTrending']);
Route::get('/view/profile/{user_id}', [UserController::class, 'loadGuestProfile']);
Route::get('my/comments/{id}', [UserController::class, 'loadMyComments'])->middleware('user');
Route::get('my/following/{id}', [UserController::class, 'loadMyFollowing'])->middleware('user');
Route::get('my/like/{id}', [UserController::class, 'loadMyLike'])->middleware('user');
Route::get('/view/guestpost/{user_id}', [UserController::class, 'loadGuestPosts']);

Route::get('/admin/home', [AdminController::class, 'loadHomePage'])->middleware('admin');
Route::get('/admin/profile', [AdminController::class, 'loadProfile'])->middleware('admin')->name('profile.admin');
Route::get('/admin/view/profile/{user_id}', [AdminController::class, 'loadGuestProfile'])->middleware('admin');
Route::get('/admin/posts', [AdminController::class, 'loadAllPosts'])->middleware('admin');
Route::get('/admin/view/post/{user_id}', [AdminController::class, 'loadPostPage'])->middleware('admin');
Route::get('/admin/view/comment/{user_id}', [AdminController::class, 'loadUserComment'])->middleware('admin');

// Route::get('/admin/profile/change-password', [AdminController::class, 'changePassword'])->middleware('admin');
Route::get('/admin/tag', [AdminController::class, 'loadTagPage'])->middleware('admin');
Route::get('create/tag', [AdminController::class, 'loadCreateTag'])->middleware('admin');
Route::get('/edit/tag/{tag_id}', [AdminController::class, 'loadEditTag'])->middleware('admin');
Route::get('/admin/view/like/{user_id}', [AdminController::class, 'loadUserLikePosts'])->middleware('admin');
Route::get('/admin/view/guestpost/{user_id}', [AdminController::class, 'loadGuestPosts'])->middleware('admin');
Route::get('/admin/create/post', [AdminController::class, 'loadCreatePost'])->middleware('admin');

Route::get('/admin/comment', [AdminController::class, 'loadCommentPage'])->middleware('admin');
Route::get('/admin/view/following/{user_id}', [AdminController::class, 'loadUserFollowing'])->middleware('admin');



Route::get('/notifications/mark-all-as-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back()->with('status', 'Tất cả thông báo đã được đánh dấu là đã đọc.');
})->name('notifications.markAllAsRead');
