<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{

    public function userComment(): Collection
    {
        return auth()->user()->comments;
    }

    public function updateComment(int $commentId, array $data)
    {
        Comment::whereId($commentId)->update($data);
    }

    public function deleteComment(int $commentId)
    {
        Comment::destroy($commentId);
    }

    public function storeComment(array $data)
    {
        Comment::firstOrCreate($data);
    }
}
