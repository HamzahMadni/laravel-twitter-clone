<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(User $user)
    {
        $followers = $user->followers()->paginate(10);
        $following = $user->following()->paginate(10);
        $posts = $user->posts()->with(['user', 'likes'])->paginate(20);

        return view('users.profile.index', [
            'user' => $user,
            'posts' => $posts,
            'followers' => $followers,
            'following' => $following,
        ]);
    }
}
