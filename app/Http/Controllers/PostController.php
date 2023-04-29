<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Traits\ManageFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ManageFileTrait;
    public function __construct(private PostRepositoryInterface $postRepository)
    {
    }
    public function index()
    {
        $posts = $this->postRepository->getAllPosts();
        return view('posts.home', compact(['posts']));
    }
    public function addPost()
    {
        return view('posts.add');
    }
    public function storePost(Request $request)
    {
        $photo = $this->uploadFile($request, 'photo', 'posts');
        $data = [
            'content' => $request->content,
            'user_id' => Auth::id(),
            'photo' => $photo
        ];
        $this->postRepository->addPost($data);
        return redirect('posts/list');
    }
    public function showPost($post_id, $notify_id)
    {
        $notification = auth()->user()->Notifications->where('id', $notify_id)->first();
        $notification->markAsRead();
        $post = $this->postRepository->getPost($post_id);
        return view('posts.show', compact('post'));
    }

    public function deletePost($id)
    {
        $this->postRepository->deletePost($id);
        return redirect('/posts/list');
    }
    public function editPost($id)
    {
        $post = $this->postRepository->getPost($id);
        return view('posts.update', compact('post'));
    }

    public function updatePost($id, Request $request)
    {
        $data = [
            'content' => $request->content
        ];
        $photo = $this->uploadFile($request, 'photo', 'posts');
        if ($photo !== null) {
            $data['photo'] = $photo;
        }
        $this->postRepository->updatePost($id, $data);
        return redirect('/posts/list');
    }
    public function Like($post_id)
    {
        $this->postRepository->getPost($post_id)->increment('likes');
        return back();
    }
    public function disLike($post_id)
    {
        $this->postRepository->getPost($post_id)->decrement('likes');
        return back();
    }
}
