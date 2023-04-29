@extends('layouts.master')
@section('title', 'Friend Requests')
@section('content')
    <div class="container text-center">
        <div class="w-50 mx-auto">
            <h2>Friend Requests</h2>
        </div>
        @if (isset($requests) && $requests->count() > 0)
            @foreach ($requests as $request)
                <ul class="list-group mx-auto my-3"style="width: 70%">
                    <li class="list-group-item">
                        <div class="media" >
                            @if (isset($request->photo))
                                <img src="{{ asset($request->photo) }}" class="rounded-circle mr-2" width="40"
                                    height="40">
                            @else
                                <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" class="rounded-circle mr-2"
                                    width="40" height="40">
                            @endif
                            <div class="media-body d-flex align-items-center">
                                <h5 class="mt-0 mr-3">{{ $request->name }}</h5>
                                <!-- Two Buttons -->
                                <div class="btn-group ml-auto" role="group" aria-label="User Actions">
                                    <a href="acceptrequest/{{ $request->id }}" class="btn btn-success mx-5"><i class="fas fa-check"></i> Accept</a>
                                    <a href="deleterequest/{{ $request->id }}" class="btn btn-danger"><i class="fas fa-times"></i> Refuse</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        @else
            <p>You have no friend requests.</p>
        @endif
    </div>

@endsection
