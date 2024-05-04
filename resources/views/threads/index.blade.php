<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Thread</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Thread一覧</h1>
        <div class='threads'>
            @foreach($threads as$thread)
            <div class='thread'>
                <h2 class='threadname'>{{$thread->threadname}}</h2>
            </div>
            @endforeach
        </div>
    </body>
</html>