<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently listened</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" /> -->
    <?php require_once('includes/favicon.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php');

    require 'vendor/autoload.php';

    $client = new GuzzleHttp\Client(
        [
            'base_uri' => 'https://api.spotify.com',
            'headers' => ['Authorization' => 'Bearer ' . $_SESSION['access']]
        ]
    );

    use GuzzleHttp\Event\ErrorEvent;

    try {
        $response = $client->request('GET', 'v1/me/player/recently-played');
    }
    catch (GuzzleHttp\Exception\ClientException $e) {
        $response = $e->getResponse();

        $resString = $response->getBody()->getContents();
        $resJson = json_decode($resString, true);

        $status = $resJson['error']['status'];
        $message = $resJson['error']['message'];

        $help = '';
        $_SESSION['status'] = $status;
        if ($status === 401) {
            $help = 'Please refresh your access token.';
        }
        elseif ($status === 400) {
            $help = 'Please login with Spotify.';
        }

        echo('<div class="notification is-danger is-light"><strong>Error ' . $status . '</strong>: ' . $message . '. <strong>' . $help . '</strong></div>');
        exit(1);
    }


    $body = $response->getBody();

    // echo($body);

    $arr = json_decode($body, true); ?>
    
    <div class="container">
        <br>
        <?php
        foreach ($arr['items'] as $value) {
        $track = $value['track']; ?>

        <article class="media">
            <figure class="media-left">
                <p class="image is-64x64">
                    <img src="<?php echo $track['album']['images'][2]['url']; ?>">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><?php echo htmlspecialchars($track['name']); ?></strong> <small><?php echo htmlspecialchars($track['artists'][0]['name']); ?></small>
                        <br>
                        <small>Listened at <?php echo $value['played_at']; ?></small>
                        <br>
                    </p>
                </div>
                <!-- Add these back when I can change the functionality to Spotify-related icons like add to playlist
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-reply"></i></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-heart"></i></span>
                        </a>
                    </div>
                </nav> -->
            </div>
            <div class="media-right">
                <audio controls><source src="<?php echo $track['preview_url']; ?>" type="audio/mpeg">Your browser does not support the audio element.</audio>
            </div>
        </article>
        <?php } ?> 
    </div>
</body>
</html>
