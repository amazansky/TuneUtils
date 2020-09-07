<?php session_start(); 
require 'vendor/autoload.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About TuneUtils</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"
        integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <?php require_once('includes/favicon.php'); ?>
</head>

<body>
    <?php require_once('includes/nav.php'); ?>
    <div class="content container">
        <br>
        <h2>A little about TuneUtils...</h2>
        <blockquote>
            Hi there! I'm Alex, the developer behind this project. <br><br>I <u>love</u> Spotify. I use it all the time
            and love the listening experience, however there are still some things I wish it did. This website has a set
            of quick tools designed to make your Spotify experience a little better. I hope you enjoy it :) <br><br>P.S.
            - <strong>This project is open source!</strong> If you have an idea for a feature or would like to
            contribute some code, <a href="https://github.com/amazansky/TuneUtils">check TuneUtils out on GitHub!</a>
        </blockquote>
        <h3>Resources</h3>
        <ul>
            <li>
                The logo for TuneUtils is a <a href="https://fontawesome.com/icons/record-vinyl?style=solid">Font Awesome
                icon</a>, and is licensed under <a href="https://creativecommons.org/licenses/by/4.0/">Creative Commons
                Attribution 4.0 International</a>. For the favicon version of the logo, the icon was changed to a blue
                color (<span class="tag is-info">#209CEE</span>).
            </li>
            <li>
                The cover image for the homepage is by Michael Mroczek (mroczekm), is found on
                <a href="https://commons.wikimedia.org/wiki/File:Grado_Headphones_SR80e_(Unsplash).jpg">Wikimedia
                Commons</a>, and is licensed under the <a href="https://creativecommons.org/publicdomain/zero/1.0/">
                Creative Commons Zero 1.0 Universal Public Domain Dedication</a>.
            </li>
        </ul>
    </div>
</body>

</html>