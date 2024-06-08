<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>threadChat</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Post一覧</h1>
        <div class='likes'>
            <p>{{$like->thread->live->artist->name}} / {{$like->thread->live->livename}} / {{$like->thread->threadname}}</p>
            <div class="post">
                @foreach($like->thread->posts as $post)
                <p class="body">{{$post->body}}</p>
                <form id="form_{{$post->id}}" action="/{{$like->id}}/{{$post->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                </form>
                <form action="/{{$post->id}}/comment" method="GET">
                    @csrf
                    <a name="comment[comment]"></a>
                    <input type="submit" name="submit" value="コメント">
                </form>
                @endforeach
            </div>
        </div>
        <form action="/{{$like->id}}/post" method="POST">
            @csrf
            <!-- 任意の<input>要素＝入力欄などを用意する -->
            <textarea name="body"></textarea>
            <!-- 送信ボタンを用意する -->
            <input type="submit" name="submit" value="投稿">
        </form>
        <script>
            function deletePost(id) {
                'use strict';
                
                if (confirm('投稿を削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>