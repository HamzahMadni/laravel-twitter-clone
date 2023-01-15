<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ExploreController extends Controller
{
    public function index()
    {
        $users = collect();
        $posts = Post::with(['user', 'likes'])->latest()->paginate(10);

        if ($searchTerm = request()->query('username')) {
            $users = User::query()
                ->where('username', 'like', str("%{$searchTerm}%")->lower())
                ->orderBy('username')
                ->limit(5)
                ->get();
        }

        return view('explore.index', ['posts' => $posts, 'users' => $users, 'username' => $searchTerm]);
    }
}
