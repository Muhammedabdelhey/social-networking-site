@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="row py-5 px-4">
        <div class="col-md-12 mx-auto ">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3">
                            @if (isset(Auth::user()->photo))
                                <img src="{{ asset(Auth::user()->photo) }}" alt="..." width="130"
                                    class="rounded mb-2 img-thumbnail">
                            @else
                                <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" alt="..."
                                    width="130" class="rounded mb-2 img-thumbnail">
                            @endif

                            <a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a>
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0">{{ Auth::user()->name }}</h4>
                            <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p>
                        </div>
                    </div>
                </div>
                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">215</h5><small class="text-muted"> <i
                                    class="fa-sharp fa-solid fa-pen"></i> Posts</small>
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">745</h5><small class="text-muted"> <i
                                    class="fas fa-user mr-1"></i>Frinds</small>
                        </li>
                    </ul>
                </div>
                @if (isset($user->posts) && $user->posts->count() > 0)
                    @foreach ($user->posts as $post)
                        <div class="post-card w-50 mx-auto my-5" style="width: 18rem;">
                            <div class="post-card-body">
                                @if ($post->user_id == Auth::id())
                                    <div class="dropdown-more">
                                        <a class="dropdown-toggle" type="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class='fa-solid fa-ellipsis-vertical fa-lg' style="color: #4f8df8;"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/posts/{{ $post->id }}/edit"
                                                style="color: #4fd6f8;">Edit</a>
                                            <form action="/posts/{{ $post->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"
                                                    style="color: #ff0000;">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    @if (isset($user->photo))
                                        <img src="{{ asset($user->photo) }}" class="rounded-circle mr-2" width="40"
                                            height="40">
                                    @else
                                        <img src="https://img.freepik.com/free-icon/user_318-159711.jpg"
                                            class="rounded-circle mr-2" width="40" height="40">
                                    @endif
                                    <h5 class="post-card-title mb-0">{{ $user->name }}</h5>
                                </div>
                                <p class="post-card-text"><small
                                        class="post-text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                                <p class="post-card-text">{{ $post->content }}</p>
                                @if (isset($post->photo))
                                    <img class="post-card-img" src="{{ asset($post->photo) }}" />
                                @endif
                            </div>
                            <div class="post-card-footer">
                                <div class="w-100 d-flex justify-content-between">
                                    <div class="w-50">
                                        <a  onclick="toggleLike({{ $post->id }})" data-value="0"
                                            id="like-{{ $post->id }}" class="btn btn-primary w-100">
                                            <i class="fa fa-thumbs-up"></i> Like
                                        </a>
                                        <span id="likes-count-{{ $post->id }}" class="ml-2 mx-3">{{ $post->likes }}
                                        </span>
                                    </div>
                                    <div class="w-50">
                                        <a onclick="toggleComment({{ $post->id }})" class="btn btn-primary w-100"><i
                                                class="fa fa-comment"></i> Comment</a>
                                    </div>
                                </div>
                            </div>
                            <div id="comments-{{ $post->id }}" style="display: none;">
                                <h6 class='mx-3'>Comments</h6>
                                @if ($post->comments->count() > 0)
                                    @foreach ($post->comments as $comment)
                                        <div class="card mb-3 ">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $comment->user->name }}</h6>
                                                <form method="POST" action="/posts/comments/{{ $comment->id }}/update">
                                                    @csrf
                                                    <div class="form-group d-flex">
                                                        <textarea id="comment-{{ $comment->id }}" name="comment" class="form-control mr-2" disabled rows="2"
                                                            cols="20" style="width: 220px;">{{ $comment->comment }}</textarea>

                                                    </div>
                                                    <button type="submit" class="btn btn-info"
                                                        id="updatecomment-{{ $comment->id }}" hidden>update</button>
                                                </form>
                                                @if ($comment->user_id == Auth::id())
                                                    <div class="dropdown-more">
                                                        <a class="dropdown-toggle" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class='fa-solid fa-ellipsis-vertical fa-lg'
                                                                style="color: #4f8df8;"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item"
                                                                onclick="updateComment('{{ $comment->id }}')"
                                                                style="color: #4fd6f8;">Edit</a>
                                                            <form action="/posts/comments/{{ $comment->id }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"
                                                                    style="color: #ff0000;">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                                <p class="card-text mx-1"><small
                                                        class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="mx-3"> this Post Dosn't have comments</p>
                                @endforelse
                                <hr>
                                <div class="row mx-2">
                                    <form method="Post" action="{{ url('posts/comments/create') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $post->id }}" name="post_id">
                                            <textarea id="comment-{{ $post->id }}" name="comment" class="form-control mr-2" rows="2" cols="20"
                                                style="width: 220px;"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Commnet</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


                <div class="icon" style="position: fixed;
        bottom: 0;
        right: 0;
        margin: 30px">
                    <a class="navbar-brand" href="/posts/add">
                        <i class="fa-solid fa-plus fa-2xl fa-beat" style="color: #4f8df8; "></i> <b> Add Post</b>
                    </a>
                </div>
            </div>
        </div>
    @endsection
