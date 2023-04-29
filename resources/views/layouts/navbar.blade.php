    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/posts/list"><i class="fa-solid fa-house" style="color: #4f8df8;"></i>Home</a>
            </a>
            <a class="navbar-brand" href="/friendrequests"><i class="fa-sharp fa-solid fa-user-plus"
                    style="color: #4f8df8;"></i>Frinds Requsts</a>
            </a>
            <a class="navbar-brand" href="/profile/{{ Auth::id() }}">
                <i class="fa-solid fa-user" style="color: #4f8df8;"></i> Profile</a>

            <li class="dropdown dropdown-notification nav-item dropdown-notifications" id="dropdown-notification"
                style="list-style: none;">
                <a class="nav-link nav-link-label navbar-brand" href="#" data-toggle="dropdown">
                    <i class="fa fa-bell"style="color: #4f8df8;"></i> Notifications
                    <span id="count_id"
                        class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ Auth::user()->unreadNotifications->count() }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="width: 350px;">
                    <li class="dropdown-menu-header">
                        <h6 class="dropdown-header m-0 text-center">
                            <span class="grey darken-2 text-center">Notifications</span>
                        </h6>
                    </li>
                    <li class="scrollable-container ps-container ps-active-y media-list w-100">
                        @if (Auth::user()->unreadNotifications !== null)
                            @foreach (Auth::user()->unreadNotifications as $Notification)
                                <div
                                    style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">
                                    <a href=" /posts/ {{ $Notification->data['postId'] }}/{{ $Notification->id }}"
                                        style="text-decoration: none; color: #1c1e21;">
                                        <h6 style="font-weight: 700; margin-bottom: 0;">
                                            {{ $Notification->data['commentOwnerName'] }}
                                        </h6>
                                        <p style="margin-bottom: 0;">just commented on your post:</p>
                                        <p style="margin-bottom: 0;"> {{ $Notification->data['comment'] }} </p>
                                        <small style="direction: ltr;">
                                            <p class="media-meta text-muted text-right" style="direction: ltr;">
                                                {{ $Notification->data['date'] }} </p>
                                        </small>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </li>
                    <li class="dropdown-menu-footer">
                        <a class="dropdown-item text-muted text-center" href="#">All Notification</a>
                    </li>
                </ul>
            </li>

            <a class="navbar-brand" href="/logout">
                <i class="fa-solid fa-right-from-bracket" style="color: #4f8df8;"></i>Logout</a>
        </div>
    </nav>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('8888e3ba3cf860bec9ea', {
            cluster: 'mt1'
        });
        var channel = pusher.subscribe('post-channel');
        channel.bind('new-comment', function(data) {
            if (data.postOwnerId == {{ Auth::id() }}) {
                var count = parseInt(document.getElementById('count_id')
                    .innerHTML);
                document.getElementById("count_id").textContent = count + 1;
                $(".scrollable-container").append(
                    `<div style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">
                     <a href=" /posts/` + data.postId + `/`+data.notifyId+`" style="text-decoration: none; color: #1c1e21;">
                     <h6 style="font-weight: 700; margin-bottom: 0;">` + data.commentOwnerName + `</h6>
                     <p style="margin-bottom: 0;">just commented on your post:</p>
                     <p style="margin-bottom: 0;">` + data.comment + `</p>
                     <small style="direction: ltr;">
                     <p class="media-meta text-muted text-right" style="direction: ltr;">` + data.date + `</p>
                     </small>
                     </a>
                    </div>`);
            }
        });
    </script>
