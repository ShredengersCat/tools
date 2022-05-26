<?php

namespace App\Service;

use App\Interfaces\CommentRepositoryInterface;

class CommentService
{
    protected CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        return $this->commentRepository->userComment();
    }

    public function update(int $commentId, array $data)
    {
        $this->commentRepository->userComment($commentId, $data);
    }

    public function delete(int $commentId)
    {
        $this->commentRepository->deleteComment($commentId);
    }
}
