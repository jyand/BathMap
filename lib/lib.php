<?php
# 'Library': function wrapper for routines used in pages
# The purpose is to abstract details of back-end operations from the user.

# validates the password server-side when creating a new user account
function passwdcheck($password, $confirmpw) {
        $regex = array("/[A-Z]/", "/[0-9]/", "/[a-z]/") ;
        $minchar = 8 ;
        if (strlen($password) >= $minchar && md5($password) === md5($confirmpw)) {
                $valid = TRUE ;
                foreach ($regex as $temp) {
                        if (!preg_match($temp, $password)) {
                                $valid = FALSE ;
                        }
                }
                unset($temp) ;
        }
        else {
                $valid = FALSE ;
        }
        return $valid ;
}

# adds user information to the database, formats and encrypts password
# email is formatted for security in the web page
function useradd($email, $password, $confirm) {
        require_once("cred.php");
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
                die('<p class="error">Sorry!</p>') ;
                echo "<p>We are having connection issues.</p><p>Please try again later.</p>" ;
        }
        if (passwdcheck($password, $confirm) === TRUE) {
                $password = md5(trim($password)) ;
                $joindate = date("Y-m-d") ;
                $mysqlstr = "INSERT INTO User (Email, Password, JoinDate) VALUES ('{$email}', '{$password}', '{$joindate}')" ;
                $conn->query($mysqlstr) ;
                return TRUE ;
        }
        else {
                return FALSE ;
        }
}
# query the database for results based on search terms in forms
# a keyword search with one or more characters can be used for the business
# the zip code must be set to obtain results
function dbsearch($bname, $zip) {
include_once("cred.php");
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
                die('<p class="error">sorry!</p>') ;
                echo "<p>we are having connection issues.</p><p>please try again later.</p>" ;
        }
        else {
                $mysql = "SELECT * FROM Zip WHERE Name = '{$zip}'" ;
        }
        if (strlen($bname) > 0) {
                $term = preg_replace("/ /", "%", $bname) ;
                $term = "%" . $term . "%" ;
                $mysqlstr .= " AND Name LIKE '{$bname}'" ;
        }
        return $conn->query($mysqlstr) ;
}

# inserts record into the database when a user posts a review
# the html forms are all required so this ensures that no forms are blank
function postreview($name, $address, $city, $zip) {
        require_once("cred.php");
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
                die('<p class="error">sorry!</p>') ;
                echo "<p>we are having connection issues.</p><p>please try again later.</p>" ;
        }
        else {
                $mysqlstr = "INSERT INTO Business (Name, Address, City, Zip, State) VALUES('{$name}', '{$address}', '{$city}', '{$zip}', 'NJ'" ;
                $conn->query($mysqlstr) ;
        }
}

# dbconnect() is an unused function since it ended up being more efficient to just connect to the database when needed
function dbconnect() {
include_once("cred.php");
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
                die('<p class="error">sorry!</p>') ;
                echo "<p>we are having connection issues.</p><p>please try again later.</p>" ;
                return false ;
        }
        else {
                return TRUE ;
        }
}

?>
