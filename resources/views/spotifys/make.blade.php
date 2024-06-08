<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body>
        
        <form action="/serch/{{$artist->id}}/makelive" method="POST">
            @csrf
            <div class="SetlistName">
                <h2>SetlistName</h2>
                <input type="text" name="setlist_name" placeholder="Livename" />
            </div>
            <input type="submit" value="保存"/>
        </form>
        <a href="/spotify/login">spotifyにログインするためのやつ</a>
        
    </body>
</html>