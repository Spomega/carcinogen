<?php

namespace App\Repository;

use App\Entity\Comment;

interface CommentRepositoryInterface
{
    public function saveComment(Comment $comment): void;

}