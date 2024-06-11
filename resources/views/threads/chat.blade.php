<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>threadChat</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                background-color: #333;
                color: #fffafa;
                padding: 10px 20px;
                z-index: 1000; 
            }
            header .button {
            	position: absolute;
            	top: 0%;
            	right: 5rem;
            	transform: translateY(-60%);
            }
            .button {
            	display: inline-block;
            	width: 50px;
            	height: 50px;
            	font-size: 50px;
            	position: relative;
            	box-shadow: 0 0 0 1px rgba(0,0,0,.1);
            	cursor: pointer;
            }
            .button span {
            	position: absolute;
            	display: block;
            	top: 50%;
            	left: 50%;
            	width: 56%;
            	height: 56%;
            	border-radius: 50%;
            	margin: -.28em 0 0 -.28em;
            	border: .12em solid #fff;
            }
            .button span::after {
            	position: absolute;
            	display: block;
            	content: "";
            	top: 50%;
            	left: 50%;
            	width: 72%;
            	height: 36%;
            	background: #fff;
            	margin: .2em 0 0 .14em;
            	transform: rotate(45deg);
            }
            body {
                margin: 0;
                font-family: 'Nunito', sans-serif;
                display: flex;
            }
            #left-column {
                width: 30%;
                float: left;
                overflow-y: auto;
                background-color: #fffafa;
            }
            #left-column,
            main {
                padding-top: 80px; 
                position: sticky;
                overflow-y: auto;
                height: calc(100vh - 80px); 
                box-sizing: border-box;
            }
            main {
                width: 70%;
                padding-top: 80px;
                padding-left: 20px;
                overflow-y: auto;
                height: 100vh;
                overflow-y: auto;
                background-color: #f0f8ff;
            }
            .inside-line {
              width : 100% ;
              float: left;
              padding: 10px 0px;
              text-align: center;
              outline : 2px solid #2f4f4f; /* 線の太さ・線状・色 */
              outline-offset : -7px; /* どれだけ内側に線を表示したいかを負の値で指定 */
              background : #f08080; /* ボックスやボタンの背景色 */
              margin-top: 25px; 
              color: #f0f8ff;
            }
            .likes {
                padding: 20px;
            }
            .like {
                margin-bottom: 0px;
            }
            .like a {
                display: inline-block;
                width: 95%;
                padding: 10px;
                float: left;
                background-color: #d3d3d3;
                color: white;
                text-align: center;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color #d3d3d3;
                margin-top: 10px;
            }
            .delete {
            	display: inline-block;
            	width: 15px;
            	height: 15px;
            	position: relative;
            	border: 1px solid rgba(0,0,0,.1);
            	cursor: pointer;
            }
            .delete span::before,
            .delete span::after {
            	display: block;
            	content: "";
            	position: absolute;
            	top: 50%;
            	left: 50%;
            	width: 84%;
            	height: 16%;
            	margin: -8% 0 0 -42%;
            	background: #E91E63;
            }
            .delete span::before {
            	transform: rotate(-45deg);
            }
            .delete span::after {
            	transform: rotate(45deg);
            }
            .fixed-info {
                position: fixed;
                top: 107px; /* headerの下に配置 */
                left: 30%; /* left-columnの右に配置 */
                width: 70%;
                background-color: #fff;
                z-index: 1000;
                padding: 7px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .post-list {
                margin-top: 60px; /* 固定表示の要素分のスペースを確保 */
            }
            .fixed-form {
                position: fixed;
                bottom: 0;
                left: 30%;
                width: 70%;
                background-color: #333;
                color: #fff;
                padding: 10px;
                box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
                z-index: 1000;
            }
        
            .fixed-form textarea {
                width: 80%;
                height: 60px;
                margin-right: 10px;
            }
        
            .fixed-form input[type="submit"] {
                height: 60px;
            }
            .post{
                border: 1px solid #ccc; /* 枠線の設定 */
                background-color: #f9f9f9; /* 背景色の設定 */
                padding: 10px; /* 内側の余白 */
                margin-bottom: 15px; /* 下の余白 */
            }
            .post .body {
                margin-bottom: 10px; /* 投稿の本文下の余白 */
            }
            a {
                text-decoration: none; /* アンダーバーをなくす */
            }

        </style>
    </head>
    <body>
        @include('threads.left-column', ['like' => $likes])
        <header id="header">
            <h1>Header</h1>
            <p class="button"><span>
                <a href="/serch">　</a>
            </span></p>
        </header>
        <main>
            <h1>Post一覧</h1>
            <div class='likes'>
                <div class="fixed-info">
                <h2>{{$like->thread->live->artist->name}} / {{$like->thread->live->livename}} / {{$like->thread->threadname}}</h2>
                </div>
                <div class="posts">
                    @foreach($like->thread->posts as $post)
                    <div class="post">
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
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="fixed-form">
                <form action="/{{$like->id}}/post" method="POST">
                    @csrf
                    <!-- 任意の<input>要素＝入力欄などを用意する -->
                    <textarea name="body"></textarea>
                    <!-- 送信ボタンを用意する -->
                    <input type="submit" name="submit" value="投稿">
                </form>
            </div>
        </main>
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