<?php session_start(); 
require 'vendor/autoload.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TuneUtils</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <?php require_once('includes/favicon.php'); ?>
</head>
<body>

<?php 
$transparentNav = true;
require_once('includes/nav.php');
?>
 
<section class="hero is-medium is-info">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                TuneUtils
            </h1>
            <!-- <h2 class="subtitle">
                Primary bold subtitle
            </h2> -->
        </div>
    </div>
</section>

</body>
</html>
