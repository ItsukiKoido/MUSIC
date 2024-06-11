<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Thread</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="artistname">
            {{ $artist->name }}
        </h1>
        <h2>ライブを登録しよう</h2>
        [<a href="/serch/{{$artist->id}}/makelive">ライブ登録</a>]
        <dev class="lives">
            @foreach ($artist->lives as $live)
                <div class='live'>
                    <h2 class='livename'>{{ $live->livename }}</h2>
                    <p class='prace'>{{ $live->prace }}</p>
                    <p class='date'>{{ $live->date }}</p>
                    <p class='time'>{{ $live->time }}</p>
                    <form action="/spotify/login" method="GET">
                        @csrf
                        <input type="hidden" name="live" value="{{ json_encode($live) }}"/>
                        <input type="submit" name="submit" value="セットリスト登録"/>
                    </form>
                    @foreach ($live->playlists as $playlist)
                        <div class='setlist'>
                            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/{{ $playlist['spotify_id'] }}" width="500" height="370" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                        </div>
                        <form id="form_{{$playlist->id}}" action="/spotify/{{$playlist->id}}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePlaylist({{ $playlist->id }})">delete</button> 
                        </form>
                        <script>
                            function deletePlaylist(id) {
                                'use strict';
                                
                                if (confirm('登録したプレイリストを削除しますか？')) {
                                    document.getElementById(`form_${id}`).submit();
                                }
                            }
                        </script>
                    @endforeach
                    
                    <a href="/serch/{{$artist->id}}/{{$live->id}}/makethread">スレッド登録</a>
                    
                    @foreach ($live->threads as $thread)
                        <div class='thread'>
                            <a class='threadname'>{{ $thread->threadname }}</a>
                        </div>
                    @endforeach
                </div>
            @endforeach
                
            </div>
        </dev>
    </body>
</html>