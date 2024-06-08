<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>serchArtist</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
    <h1>アーティスト検索結果一覧</h1>
    <?php foreach ($artists as $artist): ?>
        <br><a href="/serch/{{$artist->id}}"><?php echo $artist['name']?></br></a>
            <?php echo $artist['image_path']?>
    <?php endforeach; ?>
    </body>
</html>