<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;
use App\Models\Post;

class AdminController extends Controller
{

    public function loadHomePage()
    {
        $logged_user = Auth::user();
        return view('admin.home-page', compact('logged_user'));
    }
    public function loadTagPage()
    {
        $logged_user = Auth::user();
        return view('admin.tags-page', compact('logged_user'));
    }
    public function loadCreateTag()
    {
        $logged_user = Auth::user();
        return view('admin.create-tag', compact('logged_user'));
    }
    public function loadEditTag($tag_id)
    {
        $logged_user = Auth::user();
        $tag_data = Tag::find($tag_id);
        return view('admin.edit-tag', compact('logged_user', 'tag_data'));

    public function loadProfile()
    {
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        return view('admin.user-profile', compact('logged_user', 'user_image'));
    }

    public function loadGuestProfile($id)
    {
        $logged_user = Auth::user();
        $guest_id = $id;
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        
        return view('admin.guest-profile', compact('logged_user', 'guest_id', 'user_image'));
    }
    public function loadAllPosts(){
        $logged_user = Auth::user();
        return view('admin.admin-post-component',compact('logged_user'));
    }
    public function loadPostPage($post_id)
    {
        $logged_user = Auth::user();
        $post_data = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.id', $post_id)
            ->first(['users.name', 'posts.*']);
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        return view('admin.view-post', compact('logged_user', 'post_data', 'user_image'));
    }
}
