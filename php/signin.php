<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"/>
        <title>Sign In</title>
        <link href="theme.css" rel=stylesheet type="text/css">
</head>
<body>
        <main>
        <nav><ul>
                <a href="signup.php">Sign Up</a>
        </ul></nav></br>       
<?php
require_once("cred.php");
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
        die('<p class="error">Sorry!</p>') ;
        echo "<p>We are having connection issues.</p><p>Please try again later.</p>" ;
}
# Queries the database for matching login info, starts a session if signing in is successful, redirects to the priveleged home page
if (isset($_POST["password"]) && isset($_POST["email"])) {
        $webuser = $_POST["email"];
        $key = md5(trim($_POST["password"])) ;
        $mysqlstr = "SELECT * FROM User WHERE Email = '{$webuser}' AND Password = '{$key}'" ;
        $result = $conn->query($mysqlstr) ;
        if ($result->num_rows > 0) {
                $row = $result->fetch_assoc() ;
                session_start() ;
                $_SESSION["user"] = $row["Email"] ;
                header("Location: home.php") ;
                $conn->close() ;
                die() ;
        }
        else {
# shows an error page if not successful
                die("<p>Please enter valid login credentials.</p>") ;
        }
}
?>
                <form method="POST" action="">
                <label for="login">
                        <p>Email: <input type="text" id="email" name="email">
                        Password: <input type="password" id="password" name="password"></p>
                        <p><input type="submit" id="click" name="click" value="sign in"></p>
                </label>
                </form></br>
                <p><img src="img/br.jpeg" width="170" height="200"></p>
        </main>
        <footer>&copy;Copyright 2020 - John DeSalvo</footer>
</body>
</html>
