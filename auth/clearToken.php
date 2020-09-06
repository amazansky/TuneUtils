<?php
session_start();
$_SESSION = [];
$_SESSION['status'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <p><strong>You have been logged out</strong>. If you're not redirected within a few seconds, please <a href="../index.php">click here</a>.</p>
    <script>
        window.location.replace('../index.php');
    </script>
</body>
</html>
