<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function userComment() : Collection;
    public function storeComment(array $data);
    public function updateComment(int $commentId, array $data);
    public function deleteComment(int $commentId);
}
