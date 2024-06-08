<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>アーティスト登録</title>
    </head>
    <body>
        <h1>アーティスト登録画面</h1>
        <form action="/serch/makeartist" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="name">
                <h2>Name</h2>
                <input type="text" name="artist[name]" placeholder="アーティスト名" value="{{ old('artist.name') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('artist.name') }}</p>
            </div>
            <div class="explanation">
                <h2>Explanation</h2>
                <textarea name="artist[explanation]" placeholder="アーティスト説明">{{ old('artist.explanation') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('artist.explanation') }}</p>
            </div>
            <div class="image">
                <input type="file" name="image_path">
            </div>
            <input type="submit" value="登録"/>
        </form>
    </body>
</html>