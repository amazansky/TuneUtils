<?php
session_start();

require '../vendor/autoload.php';

use GuzzleHttp\Event\ErrorEvent;

$client = new GuzzleHttp\Client(
    [
        'base_uri' => 'https://api.spotify.com',
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['access']]
    ]
);

if (isset($_POST['playlist'])) {
    $playlist = htmlspecialchars($_POST['playlist']);
    $img = $_FILES['userfile']['tmp_name'];

    $testImg = @imagecreatefromjpeg($img); // this will return null if it didn't work
    if ($img !== '') { // handle file upload
        if ($testImg) {
            // imagedestroy($img);
            $path = $_FILES['userfile']['tmp_name'];
            $data = file_get_contents($path);
            $base64 = base64_encode($data);
    
            try {
                $response = $client->request('PUT', 'v1/playlists/' . $playlist . '/images', ['body' => $base64, 'headers' => ['Content-Type' => 'image/jpeg']]);
                $_SESSION['flash'] .= '<li>Image upload successful. It may take a few minutes for Spotify to process your image, and additional time for it to show up across all of your devices.</li>';
            }
            catch (GuzzleHttp\Exception\ClientException $e) {
                $response = $e->getResponse();
            
                $resString = $response->getBody()->getContents();
                $resJson = json_decode($resString, true);
            
                $status = $response->getStatusCode();
            
                // taken out because this returns 202.
                // $_SESSION['status'] = $status;
            
                $_SESSION['flash'] .= '<li>Image upload error status ' . $status . '.</li>';
            }
        }
        else {
            $_SESSION['flash'] .= '<li>You must upload a valid JPG/JPEG image.</li>';
        }
    }

    if ($_POST['description'] !== '') {
        $description = htmlspecialchars($_POST['description']);

        try {
            $response = $client->request('PUT', 'v1/playlists/' . $playlist, ['json' => ['description' => $description]]);
            $_SESSION['flash'] .= '<li>Description change succesful.</li>';
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
        
            $resString = $response->getBody()->getContents();
            $resJson = json_decode($resString, true);
        
            $status = $response->getStatusCode();

            // taken out because this returns 202.
            // $_SESSION['status'] = $status;

            $_SESSION['flash'] .= '<li>Description change error status ' . $status . '.</li>';
        }
    }
    if (!$img && !$description) { // the user submitted nothing
        $_SESSION['flash'] .= '<li>You did not choose an image or enter a description. No changes were made.</li>';
    }
}
else {
    $_SESSION['flash'] .= '<li>You must choose a playlist.</li>';
}
header('Location: ../cover.php');
die('Redirecting...');

?>
