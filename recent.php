<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently listened</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
    <?php require_once('includes/favicon.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); ?>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Listened to at</th>
                <th>Preview</th>
            </tr>
        </thead>
        <tbody>
        <?php
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
                $help = 'Please login with Spotify again to remedy this error.';
            }
            elseif ($status === 400) {
                $help = 'Please login with Spotify.';
            }

            echo('<div class="notification is-danger is-light"><strong>Error ' . $status . '</strong>: ' . $message . '. <strong>' . $help . '</strong></div>');
            exit(1);
        }


        $body = $response->getBody();

        // echo($body);

        $arr = json_decode($body, true);
        
        foreach ($arr['items'] as $value) {
            $track = $value['track']; ?>
            
            <?php
            echo('<tr><td><img src="' . $track['album']['images'][2]['url'] . '" />' . htmlspecialchars($track['name'])
            . '</td><td>' . htmlspecialchars($track['artists'][0]['name'])
            . '</td><td>' . $value['played_at']
            . '</td><td><audio controls><source src="' . $track['preview_url'] . '" type="audio/mpeg">Your browser does not support the audio element.</audio>'
            . '</td></tr>');
        }

        ?>
        </tbody>

    </table>
</body>
</html>
