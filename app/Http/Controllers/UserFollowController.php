<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store(User $user)
    {
        if (auth()->id() === $user->id) {
            return response('You cannot follow yourself...', 422);
        }

        Follow::create([
            "follower_user_id" => auth()->id(),
            "followed_user_id" => $user->id,
        ]); 

        return back();
    }

    public function destroy(User $user, Follow $follow)
    {
        $this->authorize('delete', $follow);
        $follow->delete();

        return back();
    }
}
