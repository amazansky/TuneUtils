<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
    <p>If you're not redirected within a few seconds, please <a href="../index.php">click here</a>.</p>
    
    <script>
        var hash = window.location.hash.slice(1); // take off the #
        var http = new XMLHttpRequest();
        var url = 'setToken.php';
        http.open('POST', url, true);
        //Send the proper header information along with the request
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {//Call a function when the state changes.
            if (http.readyState == 4 && http.status == 200) {
                // Also, could I make this so that it just goes back to whatever page you came from (location back?)   
                window.location.replace('../index.php');
            }
        }
        http.send(hash);
        
    </script>
</body>
</html>
