<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>likeThread</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            body {
                margin: 0;
                font-family: 'Nunito', sans-serif;
                overflow: hidden; 
            }
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
            #left-column,
            main {
                padding-top: 80px; 
                overflow-y: auto;
                height: calc(100vh - 80px); 
            }
            #left-column {
                width: 30%;
                float: left;
                background-color: #fffafa;
            }
            main {
                width: 70%;
                float: left;
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
            
        </style>
    </head>
    <body>
        <header id="header">
            <h1>Header</h1>
            <p class="button"><span>
                <a href="/serch"></a>
            </span></p>
        </header>
        <div>
            <div id="left-column">
                <div class="inside-line">
                    <h2>Thread</h1>
                </div>
                <div class='likes'>
                    @foreach($likes as $like)
                    <div class='like'>
                        <a href="/{{$like->id}}/post">
                            {{$like->thread->live->artist->name}} / {{$like->thread->live->livename}} / {{$like->thread->threadname}}
                        </a>
                        <form id="form_{{$like->id}}" action="/{{$like->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="delete">
                                <p type="button" onclick="deleteLike({{ $like->id }})"><span></span></p> 
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <main>
            
        </main>
        <script>
            function deleteLike(id) {
                'use strict';
                
                if (confirm('登録したスレッドを削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>