<?php

namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface
{
public function addComment(array $data);
public function updateComment($commentid,array $data);
public function deleteComment($commentid);


}
