<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>threadComment</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
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
        a {
            text-decoration: none; /* アンダーバーをなくす */
        }
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            display: flex;
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
    </style>
    <body>
        @include('threads.left-column', ['like' => $likes])
        <header id="header">
            <h1>Header</h1>
            <p class="button"><span>
                <a href="/serch">　</a>
            </span></p>
        </header>
        <main>
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
            <div class="fixed-form">
                <form action="/{{$post->id}}/comment" method="POST">
                    @csrf
                    <!-- 任意の<input>要素＝入力欄などを用意する -->
                    <textarea name="comment"></textarea>
                    <!-- 送信ボタンを用意する -->
                    <input type="submit" name="submit" value="投稿">
                </form>
            </div>
        </main> 
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