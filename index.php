<?php session_start(); 
require 'vendor/autoload.php';
$pageTitle = 'Home'; ?>
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
    <?php 
    $transparentNav = true;
    require_once('includes/nav.php');
    ?>
    
    <section class="hero is-medium is-info bg-img">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">TuneUtils for Spotify</h1>
                <h2 class="subtitle">TuneUtils is a set of quick tools that add some much-desired functionaltiy to the Spotify user experience.</h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="content container">
            <h1>Features</h1>
            <div class="columns">
                <div class="column">
                    <h3>Time travel! 🚀 (Okay, not really. But kind of.)</h3>
                    <p class="feature-text">
                        <a href="recent.php"><span class="tag feature-tag is-success">Go there</span></a>
                        Have you ever heard a song you loved the sound of, only to have the song finish before you could see the
                        title? No more! <strong>Recently played</strong> displays your 20 most recently listened to songs on
                        Spotify and lets you hear samples of each, so you can find the song that is now stuck in your head.
                    </p>
                </div>
                <div class="column">
                    <h3>Get a new perspective on your playlists</h3>
                    <p class="feature-text">
                        <span class="tag feature-tag is-info" disabled>Coming soon</span>
                        With <strong>Sort by sound</strong>, you can sort the tunes in your playlist by the actual sound qualities
                        of the song, including tempo, acousticness, danceability, and more.
                    </p>
                </div>
                <div class="column">
                    <h3>Edit your playlist covers on the fly</h3>
                    <p class="feature-text">
                        <a href="cover.php"><span class="tag feature-tag is-warning">Go there (in beta)</span></a>
                        Normally, it's only possible to edit the cover or description of your playlists through the Spotify app on a
                        computer. That changes with <strong>Quick cover</strong>, which allows you to upload a cover and descriptions
                        to any of your playlists from a neat web interface, allowing you to personalize your lists to your heart's
                        content from anywhere with an internet connection.
                    </p>
                    <!-- External project: Looking for a snazzy, customizable image to use as the cover for this playlist? Check out replacecover.com... -->
                </div>
                <div class="column">
                    <h3>Visualize and compare your music taste</h3>
                    <p class="feature-text">
                        <span class="tag feature-tag is-info">Coming soon</span>
                        Check out <strong>Tunealytics</strong>. It uses sound qualities of the songs within your playlists to help
                        you find trends among the music you like. You can also compare your results with a friend's playlist.
                    </p>
                    <!-- External project: Want to see how your taste compares to thousands of other Spotify users? Check out obscurifymusic.com... -->
                </div>
            </div>
        </div>
    </section>
    <?php require_once('includes/footer.php'); ?>
</body>
</html>
