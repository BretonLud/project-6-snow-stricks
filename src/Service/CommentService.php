<?php

namespace App\Service;

use App\Entity\Comment;
use App\Repository\CommentRepository;

readonly class CommentService
{
    public function __construct(private CommentRepository $commentRepository)
    {}
    
    public function save(Comment $comment): void
    {
        $this->commentRepository->save($comment, true);
    }
    
    public function remove(Comment $comment): void
    {
        $this->commentRepository->remove($comment, true);
    }
}