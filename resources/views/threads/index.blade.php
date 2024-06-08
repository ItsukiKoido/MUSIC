<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>likeThread</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Thread一覧</h1>
        <div class='likes'>
            @foreach($likes as $like)
            <div class='like'>
                <a href="/{{$like->id}}/post">
                    {{$like->thread->live->artist->name}} / {{$like->thread->live->livename}} / {{$like->thread->threadname}}
                </a>
                <form id="form_{{$like->id}}" action="/{{$like->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deleteLike({{ $like->id }})">delete</button> 
                </form>
            </div>
            @endforeach
        </div>
        <script>
            function deleteLike(id) {
                'use strict';
                
                if (confirm('登録したスレッドを削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <div class='serch'>
            <a href="/serch">アーティスト検索</a>
        </div>
    </body>
</html>