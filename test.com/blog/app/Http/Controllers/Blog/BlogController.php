<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        $likedPosts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take(4);
        return view('blog.index', compact('posts', 'randomPosts', 'likedPosts'));
    }

    public function show(Post $post)
    {
        $date = Carbon::parse($post->created_at);
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take(3);
        return view('blog.show', compact('post', 'date', 'relatedPosts'));
    }

    public function storeComment(Post $post, StoreRequest $request)
    {
        $data = $request->only('message');
        $data['post_id'] = $post->id;
        $data['user_id'] = auth()->user()->id;

        Comment::create($data);

        return redirect()->route('blog.show', $post->id);
    }

    public function storeLike(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return redirect()->back();
    }
}
