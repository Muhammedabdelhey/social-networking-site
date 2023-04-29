<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(private Post $post)
    {
    }
    public function getAllPosts()
    {
        return $this->post->with(['comments.user','user',])->orderBy('created_at', 'desc')->get();
    }
    // public function getAllUserPosts($userid)
    // {
    //     return $this->post->with(['comments.user','user'])->where('user_id',$userid)->orderBy('created_at', 'desc')->get();
    // }
    public function getPost($post_id)
    {
        return $this->post->with(['comments.user','user',])->find($post_id);
    }
    public function addPost(array $data)
    {
        return $this->post->create($data);
    }
    public function updatePost($post_id, array $data)
    {
        return $this->post->whereId($post_id)->update($data);
    }
    public function deletePost($post_id)
    {
        return $this->post->whereId($post_id)->delete();
    }
}
