<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $user)
    {
    }
    public function addUser(array $data)
    {
        return $this->user->create($data);
    }
    public function getUserPosts($user_id)
    {
        return $this->user->with(['posts.comments.user'])->find($user_id);
    }

}
