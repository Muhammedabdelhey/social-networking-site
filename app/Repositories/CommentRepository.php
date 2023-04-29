<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function __construct(private Comment $comment)
    {
        
    }
    public function addComment(array $data){
        return $this->comment->create($data);
    }
    public function updateComment($commentid,array $data){
        return $this->comment->whereId($commentid)->update($data);
    }
    public function deleteComment($commentid){
        return $this->comment->destroy($commentid);

    }
}
