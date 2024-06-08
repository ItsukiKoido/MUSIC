<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>threadComment</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Comment投稿</h1>
        <div class='post'>
            <p class='body'>{{$post->body}}</p>
        </div>
        <div class='comment'>
            @foreach($post->comments as $comment)
            <p class="body">{{$comment->comment}}</p>
            <form id="form_{{$comment->id}}" action="/{{$post->id}}/comments/{{$comment->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
            </form>
            @endforeach
        </div>
        <form action="/{{$post->id}}/comment" method="POST">
            @csrf
            <!-- 任意の<input>要素＝入力欄などを用意する -->
            <textarea name="comment"></textarea>
            <!-- 送信ボタンを用意する -->
            <input type="submit" name="submit" value="投稿">
        </form>
        <script>
            function deleteComment(id) {
                'use strict';
                
                if (confirm('コメントを削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>