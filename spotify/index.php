<?php

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '{49a8683e606d45e7900519ef30e7fcea}', 
    '{2e12cbe8d38c40e3a05221574463d8a1}', 
    '{http://localhost:3000}'
);
$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_GET['code'])) {
    $session->requestAccessToken($_GET['code']);
    $api->setAccessToken($session->getAccessToken());

} else {
    header('Location: ' . $session->getAuthorizeUrl(array(
        'scope' => array( 
          'playlist-read-private', 
          'playlist-modify-private', 
          'user-read-private',
          'playlist-modify'
        )
    )));
    die();
}

echo '<pre>';
    print_r($api->me()); //認証を受けたアカウントのプロフィールが表示される
echo '</pre>';
?>