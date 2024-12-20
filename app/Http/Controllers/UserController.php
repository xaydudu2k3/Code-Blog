<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loadHomePage()
    {
        $logged_user = Auth::user();
        $tag_id = null;
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';
            return view('user.home-page', compact('logged_user', 'user_image', 'tag_id'));
        }
        return view('user.home-page', compact('tag_id'));
    }
    public function loadHomePagewithTag($tag_id)
    {
        $logged_user = Auth::user();
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';

            return view('user.home-page', compact('logged_user', 'user_image', 'tag_id'));
        }
        return view('user.home-page', compact('tag_id'));
    }

    public function loadMyPosts()
    {
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        return view('user.my-posts', compact('logged_user', 'user_image'));
    }

    public function loadCreatePost()
    {
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        return view('user.create-post', compact('logged_user', 'user_image'));
    }

    public function loadEditPost($post_id)
    {
        $logged_user = Auth::user();
        $post_data = Post::find($post_id);
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        return view('user.edit-post', compact('logged_user', 'post_data', 'user_image'));
    }

    public function loadPostPage($post_id)
    {
        $logged_user = Auth::user();
        $post_data = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.id', $post_id)
            ->first(['users.name', 'posts.*']);
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';
            return view('user.view-post', compact('logged_user', 'post_data', 'user_image'));
        }
        return view('user.view-post', compact('post_data'));
    }

    public function loadProfile()
    {
        $logged_user = Auth::user();
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';
            return view('user.user-profile', compact('logged_user', 'user_image'));
        }
        return view('user.user-profile');
    }
    public function loadTrending()
    {
        $logged_user = Auth::user();
        $tag_id = null;
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';
            return view('user.user-trending', compact('logged_user', 'user_image', 'tag_id'));
        }
        return view('user.user-trending', compact('tag_id'));
    }

    public function loadGuestProfile($id)
    {
        $logged_user = Auth::user();
        $guest_id = $id;
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';
            return view('user.guest-profile', compact('logged_user', 'guest_id', 'user_image'));
        }
        return view('user.guest-profile', compact('logged_user', 'guest_id'));
    }
    public function loadMyComments($user_Id)
    {
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        $userId = $user_Id;
        return view('user.my-comment', compact('logged_user', 'user_image', 'userId'));
    }
    public function loadMyFollowing($user_Id)
    {
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        $userId = $user_Id;
        return view('user.my-following', compact('logged_user', 'user_image', 'userId'));
    }
    public function loadMyLike($user_id)
    {
        $logged_user = Auth::user();
        $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
        $user_image = $user_profile_data->image ?? 'images_default.jpg';
        $userId = $user_id;
        return view('user.my-like', compact('logged_user', 'user_image', 'userId'));
    }
    public function loadGuestPosts($user_id)
    {
        $logged_user = Auth::user();
        $userId = $user_id;
        if ($logged_user) {
            $user_profile_data = UserProfile::where('user_id', $logged_user->id)->first();
            $user_image = $user_profile_data->image ?? 'images_default.jpg';
            return view('user.guest-posts', compact('logged_user', 'user_image', 'userId'));
        }
        return view('user.guest-posts', compact('userId'));
    }
}
