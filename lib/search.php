<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"/>
        <title>Search Results</title>
        <link href="theme.css" rel=stylesheet type="text/css">
</head>
<body>
<main>
<?php
# query the database for results based on search terms in forms
# a keyword search with one or more characters can be used for the name of a business, it can also be left blank to show all stores in a single town 
# the zip code must be set to obtain results
require_once("cred.php");
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
        die('<p class="error">sorry!</p>') ;
        echo "<p>we are having connection issues.</p><p>please try again later.</p>" ;
}
else {
        if(isset($_GET["zip"])) {
# MySQL query for zip code, takes priority over store name since it is manadtory
                $mysqlstr = "SELECT * FROM Business WHERE Zip = '{$_GET['zip']}'" ;
# the name field uses MySQL wildcards for all entries containing all words separated by spaces in the search term
                if(isset($_GET["bname"])) {
                        $word = addslashes($_GET["bname"]) ;
                        $term = preg_replace("/ /", "%", $word) ;
                        $term = "%" . $term . "%" ;
                        $mysqlstr .= " AND Name LIKE '{$term}'" ;
                }
                $result = $conn->query($mysqlstr) ;
                if ($result->num_rows > 0) {
# Prints name and address from query results, each on one line
                        foreach ($result as $row) {
                                echo "<p>Store: {$row['Name']} Address: {$row['Address']} {$row['City']} {$row['State']}</p>" ;
                        }
                        unset($row) ;
                }
                else {
                        echo "<p>Sorry, we could not find anything.</p>" ;
                }
        }
}
$conn->close() ;
?>
</main>
</body>
</html>
