<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke()
    {
        $posts = Post::whereIn('user_id', auth()->user()->following->pluck('id')->merge(auth()->id()))->latest()->with(['user', 'likes'])->paginate(10);

        return view('home.index', [
            'posts' => $posts
        ]);
    }
}
