<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Notifications\CommentsNotification;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function __construct(private CommentRepositoryInterface $commentRepository)
    {
    }
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required'
        ]);
        $comment = $this->commentRepository->addComment([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);
        if($comment){
            $this->sendNotification($request);
        }
        return back();
    }
    public function deleteComment($id)
    {
        $this->commentRepository->deleteComment($id);
        return back();
    }
    public function updateComment($id, Request $request)
    {
        $this->commentRepository->updateComment($id, [
            'comment' => $request->comment
        ]);
        return back();
    }
    public function sendNotification(Request $request)
    {
        $postOwner = Post::whereId($request->post_id)->pluck('user_id')->first();
        $date = date("Y M D", strtotime(Carbon::now())) . date("h:i:sa", strtotime(Carbon::now()));
        $data = [
            'comment' => $request->comment,
            'date' => $date,
            'postOwnerId' => $postOwner,
            'commentOwnerName' => Auth::user()->name,
            'postId' => $request->post_id
        ];
        $notification = new CommentsNotification($data);
        $notifiable = User::whereId($postOwner)->first();
        Notification::send($notifiable, $notification);
        $databaseNotification = $notifiable->notifications()->latest()->first();
        $notificationId = $databaseNotification->id;
        $data['notifyId'] = $notificationId;
        event(new NewComment($data));
    }
}
