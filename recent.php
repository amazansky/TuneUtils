<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently played</title>
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
    
    <section class="section">
        <div class="container">
            <span class="content">
                <h1>Recently played</h1>
            </span>
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
                            <strong><?php echo htmlspecialchars($track['name']); ?></strong>
                            <small>
                                <?php
                                foreach ($track['artists'] as $key => $artist) {
                                    if ($key > 0) {
                                        echo ', ';
                                    }
                                    echo htmlspecialchars($artist['name']);
                                }
                                ?>
                            </small>
                            <br>
                            <?php
                            // Determine the human readable timestamp
                            $played = strtotime($value['played_at']); // unix timestamp
                            $playedstr = 'Played ' . date('M j\, Y H\:i \U\T\C', $played); // exact time for title attr
                            $diff = time() - $played; // difference in seconds
                            if ($diff < 60) { // 1 minute
                                $diffstr = 'just now';
                            }
                            elseif ($diff < 3600) { // 1 hour
                                $diffstr = $diff < 90 ? 'a minute ago' : round($diff/60) . ' minutes ago';
                            }
                            elseif ($diff < 86400) { // 1 day
                                $diffstr = $diff < 5400 ? 'an hour ago' : round($diff/3600) . ' hours ago';
                            }
                            elseif ($diff < 2592000) { // 1 month
                                $diffstr = $diff < 129600 ? 'a day ago' : round($diff/86400) . ' days ago';
                            }
                            elseif ($diff < 31536000) { // 1 year
                                $diffstr = $diff < 3888000 ? 'a month ago' : round($diff/2592000) . ' months ago';
                            }
                            else {
                                $diffstr = 'over a year ago';
                            }
                            ?>
                            <small title="<?php echo $playedstr; ?>">Played <?php echo $diffstr; ?></small>
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
                    <audio controls><source src="<?php echo $track['preview_url']; ?>" type="audio/mpeg">Your browser does not
                    support the audio element.</audio>
                </div>
            </article>
            <?php } ?> 
        </div>
    </section>
</body>
</html>
