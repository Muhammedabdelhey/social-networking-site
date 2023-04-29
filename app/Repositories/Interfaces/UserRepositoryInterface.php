<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function addUser(array $data);
    public function getUserPosts($user_id);
}
