<?php
session_start();

if ($_POST['state'] === $_SESSION['spotify_state']) {
    $_SESSION['access'] = $_POST['access_token'];
    $_SESSION['status'] = 200;
    
    require '../vendor/autoload.php';
    
    // TODO: Error handling for if this request results in error
    
    $client = new GuzzleHttp\Client(
        [
            'base_uri' => 'https://api.spotify.com',
            'headers' => ['Authorization' => 'Bearer ' . $_SESSION['access']]
        ]
    );
    
    $response = $client->request('GET', 'v1/me');
    $body = $response->getBody();
    $arr = json_decode($body, true);
    
    $_SESSION['name'] = htmlspecialchars($arr['display_name']);
    $_SESSION['user_id'] = $arr['id'];
    $_SESSION['pfp'] = $arr['images'][0]['url'];
}
else {
    die('States don\'t match. Possible CSRF attack.'); // TODO: Make this more noticeable to the user. As of now it just appears as if nothing has happened.
}

?>
