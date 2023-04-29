<?php

namespace App\Http\Controllers;

use App\Models\FriendShip;
use App\Models\User;
use App\Repositories\Interfaces\FriendShipRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendShipController extends Controller
{

    public function frindsRequests()
    {
        // $requests=$this->frindShipRepo->getFriendRequests(Auth::id());
        $user = User::find(Auth::id());
        $requests = $user->recievedRequests()->wherePivot('accepted', false)->get();
        return view('frindRequests', compact('requests'));
    }
    public function acceptRequest($id)
    {
        $request = FriendShip::where('user_id', $id)->where('friend_id', Auth::id())->first();
        $request->update(
            [
                'accepted' => true
            ]
        );
        return redirect()->back();
    }
    public function deleteRequest($id)
    {
        $request = FriendShip::where('user_id', $id)->where('friend_id', Auth::id())->first();
        $request->delete();
        return redirect()->back();
    }
    public function friends($user_id)
    {
        $user = User::find($user_id);
        $recievedFrinds = $user->recievedRequests()->wherePivot('accepted', true)->get();
        $sentFrinds = $user->sentRequests()->wherePivot('accepted', true)->get();
        $friends = $recievedFrinds->merge($sentFrinds);
        $friends->transform(function ($item) {
           return $item->only(['id', 'name', 'email']);
        });
    }
}
