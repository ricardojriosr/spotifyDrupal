<?php

require '../vendor/autoload.php';
require_once '../src/Request.php';
require_once '../src/SpotifyWebAPI.php';

$session = new SpotifyWebAPI\Session(
    'f3c2e70d9d3247239210692352761e1f',
    '6f5acf76793240438cfc191d65bcfe5c',
    'http://localhost:8080/BLVE/Spotify/WebApiPHP1/demo/'
);
$api = new SpotifyWebAPI\SpotifyWebAPI();

//Operations

// Request a access token using the code from Spotify

$session->requestAccessToken($_GET['code']);
$data = $api->setAccessToken($session->getAccessToken());

//Pierde la sesion al actualizar

//echo "Estoy logueado";

//echo "INFORMACION USUARIO";

$user = $api->me();

$username = $user->id;

	$api->createUserPlaylist($username, array(
    	'name' => 'TEST OUTSIDE ITERATION'
	));

//echo "PLAYLIST REIHEAD";

$playlists = $api->getUserPlaylists('reihead');

//echo "PLAYLIST TRACKS REIHEAD";
$id_playlists = array();

foreach ($playlists->items as $track) 
{	

	//echo "CREO EL PLAYLIST " .$track->name. " EN MI USUARIO " . $username;
		
	
	$api->createUserPlaylist($username, array(
    	'name' => $track->name
	));
	
	//echo "ADDING TRACKS A LAST CREATED PLAYLIST";
	
	$playlists_user = $api->getUserPlaylists($username);
	
	$playlists_userx = $playlists_user->items;
	
	foreach($playlists_userx as $p_user) 
	{
		//echo "<pre>",print_r($p_user),"</pre>";
		
		$vale = false;
		
		$name_user_track_destiny = $p_user->name;
		$name_user_track_origin = $track->name;
		$playlist_id = $track->id;
		
		//echo "TRACKS IN PLAYLIST " . $playlist_id;
	
		$tracks = $api->getUserPlaylistTracks('reihead', $playlist_id);
		
		if ($name_user_track_destiny == $name_user_track_origin) 
		{
			array_push($id_playlists,$p_user->id);
			$vale = true;
			
			if ($vale) 
			{
				$tracks_in_playlist = array();
				$playlist_id = $track->id;
				$tracks = $api->getUserPlaylistTracks('reihead', $playlist_id);
				
				foreach($tracks as $tracks_to_playlist) 
				{
					if (is_array($tracks_to_playlist) || is_object($tracks_to_playlist))
					{
						foreach($tracks_to_playlist as $trackpx) 
						{
							$pre_track = $trackpx->track;
							//echo "<pre>",print_r($pre_track),"</pre>";
							array_push($tracks_in_playlist[$p_user->id], $pre_track->id);
						}
					}
				}
			}
			
		}
		
	}	
}
?>