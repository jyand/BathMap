<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"/>
        <link href="theme.css" rel=stylesheet type="text/css">
        <title>Home Page</title>
</head>
<?php
require("lib.php") ;
session_start() ;
if (isset($_SESSION["user"])) {
        echo "<p>Welcome, {$_SESSION['user']}</p>" ;
}
else {
# if this page is accessed without a valid login session, it redirects to the sign-in page
        header("Location: signin.php") ;
        die() ;
}
# logged-in users are allowed to register data via forms
if (isset($_POST["name"]) && isset($_POST["addr"]) && isset($_POST["city"]) && isset($_POST["zipcode"])) {
        postreview($_POST["name"], $_POST["addr"], $_POST["city"], $_POST["zipcode"]) ;
}
?>
<body>
	<form action="logout.php" method="POST">
		<input type="submit" value="logout" />
	</form></br></br>
        <header><h1>Help others find a public bathroom by contributing:</h1></header>
	<form action="" method="POST">
		<p>has a public bathroom?: <input type="checkbox" id="bool" name ="bool" value="1"/></p>
		<p>Name of Store: <input type="text" id="name" name="name"/></p>
		<p>Address: <input type="text" id="addr" name="addr"/></p>
		<p>City: <input type="text" id="city" name ="city"/></p>
		<p>Zip Code: <input type="number" id="zipcode" name="zipcode"/></p>
                <p><input type="submit" id="click" name="click" value="Submit a review!"></p>
	</form>
<script type="text/javascript">
// checks for valid zip code input on search
function validform(){
        var z = document.forms["search"]["zip"].value ;
        if (z > 99999 || z < 0) {
                alert("Invalid zip code!") ;
                return false ;
        }
}
</script>
        <header><h2>Find a Public Bathroom</h2></header>
        <main>
                <form name="search" method="GET" action="search.php" onsubmit="return validform()">
                <label for="search">
                        <p>Store: <input type="text" id="bname" name="bname">
                        Zip Code: <input type="number" id="zip" name="zip"></p>
                        <p><input type="submit" value="search your location"></p>
                </label>
                </form></br>
                <p><img src="img/br.jpeg" width="170" height="200"></p>
        </main>
        <footer>&copy;Copyright 2020 - John DeSalvo</footer>
</body>
</html>
