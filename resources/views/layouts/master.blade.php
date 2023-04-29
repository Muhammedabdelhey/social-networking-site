<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/css.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    <title>@yield('title')</title>

</head>

<body>
    @auth
        @include('layouts.navbar')

    @endauth

    @yield('content')
    <script>
        function toggleComment(postId) {
            const div = document.getElementById(`comments-${postId}`);
            if (div.style.display === 'none') {
                div.style.display = 'block';
            } else {
                div.style.display = 'none';
            }
        }

        function updateComment(commentid) {
            document.getElementById(`comment-${commentid}`).disabled = false;
            document.getElementById(`updatecomment-${commentid}`).hidden = false;

        }

        function toggleLike(postId) {
            const likeBtn = document.getElementById(`like-${postId}`);
            const likesCountElement = document.getElementById(`likes-count-${postId}`);
            let likesCount = parseInt(likesCountElement.textContent);
            if (likeBtn.getAttribute('data-value') === '0') {
                likeBtn.setAttribute('data-value', '1');
                $.ajax({
                    type: 'get',
                    url: `/posts/like/${postId}`,
                    success: function(data) {
                        likesCount++; // Increment the number of likes on success
                        likesCountElement.textContent =
                        `${likesCount} `; // Update the text content of the likes count element
                    },
                    error: function(reject) {
                        // Handle errors here
                    }
                });

            } else {
                likeBtn.setAttribute('data-value', '0');
                $.ajax({
                    type: 'get',
                    url: `/posts/dislike/${postId}`,
                    success: function(data) {
                        likesCount--; // Increment the number of likes on success
                        likesCountElement.textContent =
                        `${likesCount} `;
                    },
                    error: function(reject) {

                    }
                });
            }
        }
    </script>
</body>

</html>
