<?php
// Base URL on which all other urls are based. Don't include a trailing slash.
/* If you run the site locally, be sure that [$BASE_URL]/auth/auth.php (where [$BASE_URL] is your set value for $BASE_URL)
   is set as a whitelisted redirect location in the settings for your app listing on the Spotify developer dashboard. More
   instructions in the README. */
$BASE_URL = 'https://tuneutils.com';

// Spotify app info. Used in the auth URL.
// Replace the client ID with your own if you want to run the site locally. More instructions in the README.
$SPOTIFY_CLIENT_ID = 'f56f74aa293d4d68a866d8a4fbc45ecb';
$SPOTIFY_SCOPES = 'user-read-private user-read-recently-played ugc-image-upload playlist-read-private playlist-modify-public playlist-modify-private';
$_SESSION['spotify_state'] = bin2hex(random_bytes(32)); // save state to session to check when token is being set

$SPOTIFY_AUTH_URL = 'https://accounts.spotify.com/authorize?client_id=' . $SPOTIFY_CLIENT_ID . '&redirect_uri=' . $BASE_URL . '%2Fauth%2Fauth.php&scope=' . $SPOTIFY_SCOPES . '&response_type=token&state=' . $_SESSION['spotify_state'];

?>
