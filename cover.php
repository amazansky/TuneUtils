<?php session_start(); 
require 'vendor/autoload.php';
$pageTitle = 'Quick cover';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <?php require_once('includes/meta.php'); ?>
</head>
<body>
    <?php require_once('includes/nav.php'); 
    
    if (isset($_SESSION['flash'])) {
        echo '<div class="notification is-info is-light"><div class="content"><ul style="margin: 0;">' . $_SESSION['flash'] . '</ul></div></div>';
        unset($_SESSION['flash']);
    }
    
    require 'vendor/autoload.php';

    $client = new GuzzleHttp\Client(
        [
            'base_uri' => 'https://api.spotify.com',
            'headers' => ['Authorization' => 'Bearer ' . $_SESSION['access']]
        ]
    );

    use GuzzleHttp\Event\ErrorEvent;

    try {
        $response = $client->request('GET', 'v1/me/playlists', ['query' => ['limit' => 50]]);
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
    // echo $body;
    $arr = json_decode($body, true);
    ?>

    <section class="section">
        <div class="content container">
            <h1>Quick cover</h1>
            <form id="cover-form" enctype="multipart/form-data" method="post" action="helper/uploadCover.php" name="fileinfo">
                <div class="field">
                    <label class="label">Playlist</label>
                    <div class="control">
                        <div class="select">
                            <select name="playlist" required>
                            <?php forEach($arr['items'] as $item) {
                                if ($item['owner']['id'] === $_SESSION['user_id']) {
                                    echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                }
                            } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Select an image to upload (must be a jpg/jpeg less than 250KB)</label>
                    <div class="control">
                        <input type="file" name="userfile" accept=".jpeg,.jpg">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <textarea autofocus class="textarea" placeholder="If you don't enter anything in this field, the description of your playlist will remain unchanged." name="description"></textarea>
                    </div>
                </div>
                <input type="submit" class="button is-info" value="Do it!" />
            </form>
        </div>
    </section>

    <!--make it pretty with form styling-->
    <?php require_once('includes/footer.php'); ?>
</body>
</html>
