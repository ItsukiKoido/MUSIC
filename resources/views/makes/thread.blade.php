<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>makeThread</title>
    </head>
    <body>
        <h1スレッド登録画面</h1>
        <form action="/serch/{{$artist->id}}/{{$live->id}}/makethread" method="POST">
            @csrf
            <h1>{{$live->livename}}</h1>
            <div class="threadName">
                <h2>スレッド名</h2>
                <input type="text" name="thread[threadname]" placeholder="スレッド1" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('thread.threadname') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/serch/{{$artist->id}}">back</a>]</div>
    </body>
</html>