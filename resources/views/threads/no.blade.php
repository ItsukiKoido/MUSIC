<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Artist</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
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
                color: #f0ffff;
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
                overflow-y: auto;
                background-color: #f0f8ff;
            }
            main {
                width: 70%;
                float: left;
                overflow-y: auto;
                background-color: #f5f5f5;
            }
    </style>
    <body>
        <header id="header">
            <h1>Header</h1>
            <p class="button"><span>
                <a href="/serch">　</a>
            </span></p>
        </header>
        <div id="left-column">
            <div class="inside-line">
                <h2>Thread</h1>
            </div>
        </div>    
        <main>
            <h1>threadを登録しよう</h1>
            [<a href='/serch'>アーティスト検索</a>]
        </main>    
    </body>
</html>