<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store(User $user)
    {
        Follow::create([
            "follower_user_id" => auth()->id(),
            "followed_user_id" => $user->id,
        ]); 

        return back();
    }

    public function destroy(User $user, Follow $follow)
    {
        $follow->delete();

        return back();
    }
}
