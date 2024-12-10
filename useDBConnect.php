<?php

require_once __DIR__ . '/db_connectBookings.php';


if(isset($_POST["submit"])) {
    $db= new DB_CONNECT();
    $connection = $db->connect();
    if (!$connection) 
        echo("Connection failed");
    else
        echo "Connected successfully"; 
}
?>

<h2> SQL Database Connection </h2>
<form action="useDBConnect.php" method="post">
<input type="submit" name="submit" value="Connect">
</form>