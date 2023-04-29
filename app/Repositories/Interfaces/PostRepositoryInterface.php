<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
public function getAllPosts();
// public function getAllUserPosts($userid);
public function getPost($post_id);
public function addPost(array $data);
public function updatePost($post_id,array $data);
public function deletePost($post_id);
}
