<?php

namespace App\UseCase;

use App\Entity\Comment;
use App\Repository\CommentRepositoryInterface;

class CommentUseCase
{
    function __construct(protected CommentRepositoryInterface $commentRepository)
    {
    }

    public function saveComment(Comment $comment): void
    {
        $this->commentRepository->saveComment($comment);
    }



}