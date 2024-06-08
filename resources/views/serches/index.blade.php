<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>ThreadCreate</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>アーティスト検索画面</h1>
        <h2>検索</h2>
        <form action="/serch/artist" method="GET">
            <!-- 任意の<input>要素＝入力欄などを用意する -->
            <input type="text" name="search_name">
            <!-- 送信ボタンを用意する -->
            <input type="submit" name="submit" value="名前を検索する">
        </form>
        @foreach($threads as $thread)
            <div class="threads">
                @if($thread->live && $thread->live->artist)
                    <h2 class='artist'>{{ $thread->live->artist->name }}</h2>
                    <p class='live'>{{ $thread->live->livename }} | {{$thread->live->date}}</p>
                    <p class='thread'>
                        <p>{{ $thread->threadname }}
                        @if(Auth::check())
                            <form id="form_{{$thread->id}}" action="/serch" method="POST">
                                @csrf
                                <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                <button type="button" onclick="storeLike({{$thread->id}})">+</button>
                            </form>
                        @endif
                    </p>
                @endif
            </div>
        @endforeach
        <script>
            function storeLike(id) {
                'use strict'
        
                if (confirm('スレッドを追加しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>