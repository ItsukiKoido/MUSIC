<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>
       
        <div class="container">
            <h1>My Playlists</h1>
            <div class="playlist-container">
                @foreach ($playlists as $playlist)
                    <div class="playlist">

                        <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/{{ $playlist['id'] }}" width="500" height="370" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                        <form action="/spotify/store" method="POST">
                            @csrf
                            <div class="storeSetlist">
                                <input type="hidden" name="spotify_id" value="{{$playlist['id']}}"/>
                                <input type="submit" name="submit" value="登録"/>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
    
            <form action="/spotify/makesetlist" method="GET">
                @csrf
                <div class="SetlistName">
                    <h2>SetlistName</h2>
                    <input type="text" name="setlist_name" placeholder="Livename" />
                </div>
                <input type="submit" value="保存"/>
            </form>
    
            <div class="serch">
                <form action="/spotify/artist" method="GET">
                    <input type="text" name="search_song">
                    <input type="submit" name="submit" value="名前を検索する">
                </form>
            </div>
        </div>
       

    </body>
</html>
