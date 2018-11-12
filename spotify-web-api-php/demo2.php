<?php
//Login Auth and Scopes (permissions)
require 'vendor/autoload.php';
$session = new SpotifyWebAPI\Session(	'f3c2e70d9d3247239210692352761e1f', 
										'6f5acf76793240438cfc191d65bcfe5c', 
										'http://localhost:8080/BLVE/Spotify/WebApiPHP1/demo/'); 
$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_GET['code'])) {
	    
    $session->requestAccessToken($_GET['code']);
    $data = $api->setAccessToken($session->getAccessToken());

    $artistData = $api->me();
    $artistId = $artistData->id;
    $playlists = $api->getUserPlaylists($artistId, array(
        'limit' => 5
    ));

    foreach ($playlists->items as $playlist) {
        echo '<a href="' . $playlist->external_urls->spotify . '">' . $playlist->name . '</a> <br>';
    }
} else {
    $scopes = array(
        'scope' => array(
            'user-read-email',
            'user-library-modify',
			'playlist-modify-public',
			'playlist-modify-private'
        ),
    );

    header('Location: ' . $session->getAuthorizeUrl($scopes));
}
?>