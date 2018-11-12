<?php


class blve_spotify_class
{
	//Client ID configuration
	private $clientID;
	//Client Private configuration
	private $clientPrivate;
	//Callback URI
	private $clientURI;
	//Session to Use
	private $session;
	//Api to use
	private $api;
	//Token To Save
	private $token;
	//Data
	private $data;


	//SINGLENTON
	protected static $instance = null;
	
	public static function getInstance()
  {
  	if (!isset(static::$instance)) {
  		error_log("blve_spotify_class if getInstance \n",3,'/mnt/var/log/registro.log');
      	static::$instance = new blve_spotify_class();
  	}
  	return static::$instance;
  }

	//Funcion que llama los parametros de configuracion e inicializa las variables de session y el api
	protected function __construct()
	{
		$this->clientID = variable_get('spotify_client_id');
		$this->clientPrivate = variable_get('spotify_client_secret');
		$this->clientURI = variable_get('spotify_client_URI');

		$this->session = new Session(
			$this->clientID,
			$this->clientPrivate,
			$this->clientURI
		);

		error_log("blve_spotify_class __construct 111 \n",3,'/mnt/var/log/registro.log');

		$this->api = new SpotifyWebAPI();

	}
  


	/*
	 Funcion para retornar el token / code (desde GET)
	Ejemplo de uso:
	INPUT: NULL
	OUTPUT: AQDeqej1P_dOeyp-gSh3OeUBSxgjBVtNhBMxSdrWu-6J9ZrvMqeUOGdXD1HJzMI5mH6lylzuuhFi0E6MRvzDbzEPdfXGnuRU9lgq-q9Fjzs_KAYLt2T_GC9tffMXIDyEiN6TzVbPBF_5zeAQ20At3xZC66yg-YA6hME_3V0ecW1vLNh8wFgfuatUb7QuLKwG04zDkFtWKnGkUFvm4RglZ6uEVf-UPTi9VMct7y7w0sgWz1QF0VOTO-P7Oy_HXa03TRpQc3BKuq4IaLPmhv0VQuNWdhNy6-zSXsudnlW1g3uhAbyKAWRt-3DJWH7mIVQpjME-tx4aWG7q_or_xQ
	*/
	public function GetTokenVariable()
	{
		$this->CheckToken();

		return $this->token;
	}

	/*
	Funcion para loguearse, la cual usa la configuracion y los permisos para ejecutarse (scopes)
	Ejemplo de uso: SpotifyLogin();
	INPUT: NULL
	OUTPUT: NULL
	*/
	public function SpotifyLogin()
	{
		$arreglo_scopes = explode(",", variable_get('p_scopes'));
		if (isset($_GET['code'])) {
			
			error_log("blve_spotify_class IF \n",3,'/mnt/var/log/registro.log');

			$this->session->requestAccessToken($_GET['code']);
			$this->data =  $this->api->setAccessToken($this->session->getAccessToken());

			error_log("blve_spotify_class token: ".$this->session->getAccessToken()."\n",3,'/mnt/var/log/registro.log');
			
			$_SESSION['blve_spotify_token'] = $this->session->getAccessToken();
			
		} else {
			$scopes = array(
				'scope' => $arreglo_scopes,
			);

			error_log("blve_spotify_class ELSE \n",3,'/mnt/var/log/registro.log');

			header('Location: ' . $this->session->getAuthorizeUrl($scopes));
		}

	}

	/*
	Obtiene la lista de los playlist de un usuario en un array
	Ejemplo de uso: GetPlayLists('reihead');
	INPUT: 'reihead'
	OUTPUT: 
	stdClass Object
	(
		[href] => https://api.spotify.com/v1/users/reihead/playlists?offset=0&limit=20
		[items] => Array
			(
				[0] => stdClass Object
					(
						[collaborative] => 
						[external_urls] => stdClass Object
							(
								[spotify] => http://open.spotify.com/user/reihead/playlist/7swmc5yLignZafcpCCZid6
							)

						[href] => https://api.spotify.com/v1/users/reihead/playlists/7swmc5yLignZafcpCCZid6
						[id] => 7swmc5yLignZafcpCCZid6
						[images] => Array
							(
								[0] => stdClass Object
									(
										[height] => 640
										[url] => https://i.scdn.co/image/a374faa94a6b19bf804292a099dfd12b26c8b034
										[width] => 640
									)

							)

						[name] => Europe â€” The Final Countdown
						[owner] => stdClass Object
							(
								[external_urls] => stdClass Object
									(
										[spotify] => http://open.spotify.com/user/reihead
									)

								[href] => https://api.spotify.com/v1/users/reihead
								[id] => reihead
								[type] => user
								[uri] => spotify:user:reihead
							)

						[public] => 1
						[snapshot_id] => su0nJFZAna5L0LTcfBd3gpUoCEfplJYhWs/WEC98HHA6vJWwyyv8Y/GVpEqLvI9L
						[tracks] => stdClass Object
							(
								[href] => https://api.spotify.com/v1/users/reihead/playlists/7swmc5yLignZafcpCCZid6/tracks
								[total] => 2
							)

						[type] => playlist
						[uri] => spotify:user:reihead:playlist:7swmc5yLignZafcpCCZid6
					)

				[1] => stdClass Object
					(
						[collaborative] => 
						[external_urls] => stdClass Object
							(
								[spotify] => http://open.spotify.com/user/reihead/playlist/2Cg0KUeyva7TlXRZ5m1zdc
							)

						[href] => https://api.spotify.com/v1/users/reihead/playlists/2Cg0KUeyva7TlXRZ5m1zdc
						[id] => 2Cg0KUeyva7TlXRZ5m1zdc
						[images] => Array
							(
								[0] => stdClass Object
									(
										[height] => 640
										[url] => https://i.scdn.co/image/495b0549379fc4c324445fd7d2bfa219a8c18a90
										[width] => 640
									)

							)

						[name] => Este para copiar
						[owner] => stdClass Object
							(
								[external_urls] => stdClass Object
									(
										[spotify] => http://open.spotify.com/user/reihead
									)

								[href] => https://api.spotify.com/v1/users/reihead
								[id] => reihead
								[type] => user
								[uri] => spotify:user:reihead
							)

						[public] => 1
						[snapshot_id] => 7CkYuYLanjfcEOSnx5Wl/B0rkXm5O6RHu+2PCU7xTQVHcAL/Y3GoGgg0uxKd/DOm
						[tracks] => stdClass Object
							(
								[href] => https://api.spotify.com/v1/users/reihead/playlists/2Cg0KUeyva7TlXRZ5m1zdc/tracks
								[total] => 2
							)

						[type] => playlist
						[uri] => spotify:user:reihead:playlist:2Cg0KUeyva7TlXRZ5m1zdc
					)

				[2] => stdClass Object
					(
						[collaborative] => 
						[external_urls] => stdClass Object
							(
								[spotify] => http://open.spotify.com/user/reihead/playlist/0NiZpVanCOXFQCxF1LGusq
							)

						[href] => https://api.spotify.com/v1/users/reihead/playlists/0NiZpVanCOXFQCxF1LGusq
						[id] => 0NiZpVanCOXFQCxF1LGusq
						[images] => Array
							(
								[0] => stdClass Object
									(
										[height] => 640
										[url] => https://i.scdn.co/image/a1abc10f4c78f1c35b12f049fe7aff7953d608e8
										[width] => 640
									)

							)

						[name] => TEST
						[owner] => stdClass Object
							(
								[external_urls] => stdClass Object
									(
										[spotify] => http://open.spotify.com/user/reihead
									)

								[href] => https://api.spotify.com/v1/users/reihead
								[id] => reihead
								[type] => user
								[uri] => spotify:user:reihead
							)

						[public] => 1
						[snapshot_id] => ITwAfxv00HW0IRkCYEs1NN9bH9AddcqwYlKJ3o6/CWsSNsrPq5zKaJ4tQAbj2vq2
						[tracks] => stdClass Object
							(
								[href] => https://api.spotify.com/v1/users/reihead/playlists/0NiZpVanCOXFQCxF1LGusq/tracks
								[total] => 1
							)

						[type] => playlist
						[uri] => spotify:user:reihead:playlist:0NiZpVanCOXFQCxF1LGusq
					)

			)

		[limit] => 20
		[next] => 
		[offset] => 0
		[previous] => 
		[total] => 3
	)
	1
	*/
	public function GetPlayLists($usuario)
	{
		
		error_log("inicio GetPlayLists \n",3,'/mnt/var/log/registro.log');
		
		$this->CheckToken();

		$playlists_user = $this->api->getUserPlaylists($usuario);
		
		error_log("GetPlayLists playlists_user: ".print_r( $playlists_user, TRUE)."\n",3,'/mnt/var/log/registro.log');
		
		return $playlists_user;
	}

	/* Get my saved Albums*/
	public function GetAlbums()
	{
		error_log("inicio GetAlbums \n",3,'/mnt/var/log/registro.log');
		
		$this->CheckToken();

		$albums = $this->api->getMySavedAlbums();

		return $albums;
	}

	/* Get an Album */
	public function GetAlbum($album_id)
	{
		$this->CheckToken();

		$album = $this->api->getAlbum($album_id);
		return $album;
	}

	/* Get all tracks from an album */
	public function getAlbumTracks($album_id)
	{
		$this->CheckToken();

		$tracks = $this->api->getAlbumTracks($album_id);
		return $tracks;
	}

	/* Get a user's playlists */
	public function getPlaylist($username)
	{
		$this->CheckToken();

		$playlists = $this->api->getUserPlaylists($username);
		return $playlists;
	}

	/* Get all tracks in a user's playlist */
	public function getPlaylistTracks($username, $album_id)
	{
		$this->CheckToken();

		$tracks = $this->api->getUserPlaylistTracks($username, $album_id);
		return $tracks;
	}

	/*
	Obtiene los tracks de un playlist
	Ejemplo de uso: GetPlayLists('reihead','0NiZpVanCOXFQCxF1LGusq');
	INPUT: 'reihead','0NiZpVanCOXFQCxF1LGusq'
	OUTPUT:
	stdClass Object
	(
		[href] => https://api.spotify.com/v1/users/reihead/playlists/0NiZpVanCOXFQCxF1LGusq/tracks?offset=0&limit=100
		[items] => Array
			(
				[0] => stdClass Object
					(
						[added_at] => 2015-11-04T19:24:47Z
						[added_by] => stdClass Object
							(
								[external_urls] => stdClass Object
									(
										[spotify] => http://open.spotify.com/user/reihead
									)

								[href] => https://api.spotify.com/v1/users/reihead
								[id] => reihead
								[type] => user
								[uri] => spotify:user:reihead
							)

						[is_local] => 
						[track] => stdClass Object
							(
								[album] => stdClass Object
									(
										[album_type] => album
										[available_markets] => Array
											(
												[0] => AD
												[1] => AR
												[2] => AU
												[3] => BE
												[4] => BG
												[5] => BO
												[6] => BR
												[7] => CL
												[8] => CO
												[9] => CR
												[10] => CY
												[11] => CZ
												[12] => DK
												[13] => DO
												[14] => EC
												[15] => EE
												[16] => ES
												[17] => FI
												[18] => FR
												[19] => GB
												[20] => GR
												[21] => GT
												[22] => HK
												[23] => HN
												[24] => HU
												[25] => IE
												[26] => IS
												[27] => IT
												[28] => LI
												[29] => LT
												[30] => LU
												[31] => LV
												[32] => MC
												[33] => MT
												[34] => MY
												[35] => NI
												[36] => NL
												[37] => NO
												[38] => NZ
												[39] => PA
												[40] => PE
												[41] => PH
												[42] => PL
												[43] => PT
												[44] => PY
												[45] => RO
												[46] => SE
												[47] => SG
												[48] => SI
												[49] => SK
												[50] => SV
												[51] => TR
												[52] => TW
												[53] => UY
											)

										[external_urls] => stdClass Object
											(
												[spotify] => https://open.spotify.com/album/5Y0viLQMeeXfwRh2Blx3BG
											)

										[href] => https://api.spotify.com/v1/albums/5Y0viLQMeeXfwRh2Blx3BG
										[id] => 5Y0viLQMeeXfwRh2Blx3BG
										[images] => Array
											(
												[0] => stdClass Object
													(
														[height] => 640
														[url] => https://i.scdn.co/image/a1abc10f4c78f1c35b12f049fe7aff7953d608e8
														[width] => 640
													)

												[1] => stdClass Object
													(
														[height] => 300
														[url] => https://i.scdn.co/image/46bd397bbe078006fdd5c4d792ae23f157c81b9c
														[width] => 300
													)

												[2] => stdClass Object
													(
														[height] => 64
														[url] => https://i.scdn.co/image/c912968f48be642bf06e89ad1033a5fbb17e99fe
														[width] => 64
													)

											)

										[name] => Honeymoon
										[type] => album
										[uri] => spotify:album:5Y0viLQMeeXfwRh2Blx3BG
									)

								[artists] => Array
									(
										[0] => stdClass Object
											(
												[external_urls] => stdClass Object
													(
														[spotify] => https://open.spotify.com/artist/00FQb4jTyendYWaN8pK0wa
													)

												[href] => https://api.spotify.com/v1/artists/00FQb4jTyendYWaN8pK0wa
												[id] => 00FQb4jTyendYWaN8pK0wa
												[name] => Lana Del Rey
												[type] => artist
												[uri] => spotify:artist:00FQb4jTyendYWaN8pK0wa
											)

									)

								[available_markets] => Array
									(
										[0] => AD
										[1] => AR
										[2] => AU
										[3] => BE
										[4] => BG
										[5] => BO
										[6] => BR
										[7] => CL
										[8] => CO
										[9] => CR
										[10] => CY
										[11] => CZ
										[12] => DK
										[13] => DO
										[14] => EC
										[15] => EE
										[16] => ES
										[17] => FI
										[18] => FR
										[19] => GB
										[20] => GR
										[21] => GT
										[22] => HK
										[23] => HN
										[24] => HU
										[25] => IE
										[26] => IS
										[27] => IT
										[28] => LI
										[29] => LT
										[30] => LU
										[31] => LV
										[32] => MC
										[33] => MT
										[34] => MY
										[35] => NI
										[36] => NL
										[37] => NO
										[38] => NZ
										[39] => PA
										[40] => PE
										[41] => PH
										[42] => PL
										[43] => PT
										[44] => PY
										[45] => RO
										[46] => SE
										[47] => SG
										[48] => SI
										[49] => SK
										[50] => SV
										[51] => TR
										[52] => TW
										[53] => UY
									)

								[disc_number] => 1
								[duration_ms] => 257573
								[explicit] => 1
								[external_ids] => stdClass Object
									(
										[isrc] => GBUM71502978
									)

								[external_urls] => stdClass Object
									(
										[spotify] => https://open.spotify.com/track/35WhawODuOs0kaHxwmPA9D
									)

								[href] => https://api.spotify.com/v1/tracks/35WhawODuOs0kaHxwmPA9D
								[id] => 35WhawODuOs0kaHxwmPA9D
								[name] => High By The Beach
								[popularity] => 77
								[preview_url] => https://p.scdn.co/mp3-preview/86b16da559c5e690d119093cc2c1cc3ac8efb809
								[track_number] => 5
								[type] => track
								[uri] => spotify:track:35WhawODuOs0kaHxwmPA9D
							)

					)

			)

		[limit] => 100
		[next] => 
		[offset] => 0
		[previous] => 
		[total] => 1
	)
	1
	*/
	public function GetTracks($usuario, $PlayListId)
	{
		$this->CheckToken();

		$tracks = $this->api->getUserPlaylistTracks($usuario, $PlayListId);
		return $tracks;
	}

	/*
	Obtiene la informacion del usuario que esta logueado
	Ejemplo de uso: GetUserLoggedInfo();
	INPUT: NULL
	OUTPUT:
	stdClass Object
	(
		[display_name] => 
		[email] => ricardojriosr@gmail.com
		[external_urls] => stdClass Object
			(
				[spotify] => https://open.spotify.com/user/ricardojriosr
			)

		[followers] => stdClass Object
			(
				[href] => 
				[total] => 0
			)

		[href] => https://api.spotify.com/v1/users/ricardojriosr
		[id] => ricardojriosr
		[images] => Array
			(
			)

		[type] => user
		[uri] => spotify:user:ricardojriosr
	)
	1
	*/
	public function GetUserLoggedInfo()
	{
		$this->CheckToken();

		$user = $this->api->me();
		return $user;
	}

	/*
	Funcion para crear un playlist a un usuario, especificando el nombre 
	Ejemplo de uso: CreatePlaylist('UserName','PlayListName');
	*/
	public function CreatePlaylist($usuario, $nombre_playlist)
	{
		$this->CheckToken();

		$respuesta = $this->api->createUserPlaylist($usuario, array(
			'name' => $nombre_playlist
		));
		return $respuesta;
	}

	/*
	Obtiene la informacion de cualquier usuario, incluso si no esta logueado
	Ejemplo de uso: GetUserInfo('UserName');
	*/
	public function GetUserInfo($username)
	{
		$this->CheckToken();

		$user = $this->api->getUser($username);
		return $user;
	}

	/*
	Añade canciones (tracks) a un playlist de un usuario
	Ejemplo de uso: GetUserInfo('UserName','playlist_id',array('1oR3KrPIp4CbagPa3PhtPp','6lPb7Eoon6QPbscWbMsk6a'));
	Como el ejemplo lo indicia, las canciones deben ser agregadas con su ID, al igual que el playlist
	*/
	public function AddTracksToPlaylist($usuario, $playlist_id, $array_tracks)
	{
		$this->CheckToken();

		$respuesta = $this->api->addUserPlaylistTracks(
			$usuario,
			$playlist_id,
			$array_tracks			
		);
		return $respuesta;
	}

	/*
	Funcion para reconocer si el usuario esta logeado o no
	Ejemplo de uso: IsLoggedIn();
	INPUT: NULL
	OUTPUT: true/false
	*/
	public function IsLoggedIn()
	{
		$this->CheckToken();

		$logueado = false;
		$error_message = "";
		try {
			$UsuarioLogueado = $this->api->me();
			if (is_array($UsuarioLogueado) || is_object($UsuarioLogueado)) {
				$logueado = true;
			}
		} catch (Exception $e) {
			$error_message = $e->getMessage();
			$logueado = false;
		}
		if ($error_message != "")
		{
			return $error_message;
		}
		else
		{
			return $logueado;
		}

	}

	/*
	Funcion para copiar el playlist completo de un usuario origen a un usuario destino
	Ejemplo de uso: CopyAllPlaylistsUsers('Usuario1','Usuario2');
	*/
	public function CopyAllPlaylistsUsers($usuario_origen, $usuario_destino)
	{
		$this->CheckToken();

		$PlayLists_origen = $this->GetPlayLists($usuario_origen);
		$arreglo_tracks = array();

		foreach ($PlayLists_origen as $plo) {
			if ((count($plo) > 0) && ((is_array($plo) || is_object($plo)))) {
				if (is_array($plo) || is_object($plo)) {
					$i = 0;
					foreach ($plo as $plo2) {
						$name_playlist = $plo2->name;
						$id_playlist = $plo2->id;
						$tracks = $this->GetTracks($usuario_origen, $id_playlist);
						foreach ($tracks as $trk) {
							if (is_array($trk) || is_object($trk)) {
								$i = 0;
								foreach ($trk as $trk2) {
									$prtrk = $trk2->track;
									$arreglo_tracks[$id_playlist][$name_playlist][$i] = $prtrk->id;
									$i++;
								}
							}
						}
						$i++;
					}
				}
			}
		}
		foreach ($arreglo_tracks as $a1) {
			$name_playlist = key($a1);

			$playlists_destino = $this->api->getUserPlaylists($usuario_destino);
			$existe = false;
			$id_playluist_destino = NULL;

			foreach ($playlists_destino as $pld) {
				if (is_array($pld) || is_object($pld)) {
					foreach ($pld as $pld2) {
						if ($pld2->name == $name_playlist) {
							$existe = true;
							$id_playluist_destino = $pld2->id;
						}
					}
				}
				if (!$existe) {
					$test_response = $this->api->createUserPlaylist($usuario_destino, array(
						'name' => $name_playlist
					));
					$playlists_destino2 = $this->api->getUserPlaylists($usuario_destino);
					foreach ($playlists_destino2 as $pld2) {
						if (is_array($pld2) || is_object($pld2)) {
							foreach ($pld2 as $pld3) {
								if ($pld3->name == $name_playlist) {
									$existe = true;
									$id_playluist_destino = $pld3->id;
								}
							}
						}
					}
				}
			}
			$para_eliminar = array();
			$xxtracks = $this->api->getUserPlaylistTracks($usuario_destino, $id_playluist_destino);
			foreach ($xxtracks as $xts) {
				if (is_array($xts) || is_object($xts)) {
					foreach ($xts as $xts2) {
						if (is_array($xts2) || is_object($xts2)) {
							foreach ($xts2 as $xts3) {
								$id_track_destio = $xts3->id;
								array_push($para_eliminar, $id_track_destio);
							}
						}

					}
				}
			}

			foreach ($a1 as $a2) {
				foreach ($a2 as $a21) {
					if (in_array($para_eliminar, $a21)) {
						$pos = array_search($a21, $a2);
						unset($a2[$pos]); //Lo elimino si se repite
					}
				}
				$this->api->addUserPlaylistTracks(
					$usuario_destino,
					$id_playluist_destino,
					$a2 //Canciones de un playlist
				);
			}
		}
	}

	public function GetFollows($type, $ids)
	{
		$this->CheckToken();

		$follows = $this->api->currentUserFollows($type, $ids);
		return $follows;
	}

	
	public function PutfollowPlaylist($userId, $playlistId, $options = [])
	{
		//$this->session->requestAccessToken($_GET['code']);
		
		error_log("PutfollowPlaylist \n",3,'/mnt/var/log/registro.log');
		
		$this->CheckToken();

		$follows = $this->api->followPlaylist($userId, $playlistId,$options = []);
		
		error_log("blve_spotify_PutfollowPlaylist:follows ".$follows ."\n",3,'/mnt/var/log/registro.log');
		return $follows;
	}

	function CheckToken()
	{
		if (empty($this->session->getAccessToken())){
			$totokenken = $_SESSION['blve_spotify_token'];
			$this->data = $this->api->setAccessToken($totokenken);
		}
	}
}
?>