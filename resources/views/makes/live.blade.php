<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>makeLive</title>
    </head>
    <body>
        <h1>ライブ登録画面</h1>
        <form action="/serch/{{$artist->id}}/makelive" method="POST">
            @csrf
            <div class="livename">
                <h2>LiveName</h2>
                <input type="text" name="live[livename]" placeholder="ライブ名" value="{{ old('live.livename') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('live.livename') }}</p>
            </div>
            <div class="prace">
                <h2>Prace</h2>
                <input type="text" name="live[prace]" placeholder="東京ドーム" value="{{ old('live.prace') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('live.prace') }}</p>
            </div>
            <div class="date">
                <h2>Date</h2>
                <input type="text" name="live[date]" placeholder="8/3" value="{{ old('live.date') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('live.date') }}</p>
            </div>
            <div class="time">
                <h2>StartTime</h2>
                <input type="text" name="live[time]" placeholder="18:00" value="{{ old('live.time') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('live.time') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/serch/{{$artist->id}}">back</a>]</div>
    </body>
</html>