<?php

namespace App\Http\Controllers\Peronal\Like;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->likedPosts;
        return view('personal.like.index', compact('posts'));
    }

    public function destroy(Post $post)
    {
        auth()->user()->LikedPosts()->detach($post->id);
        return redirect()->route('personal.like.index');
    }
}
