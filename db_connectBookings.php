<?php

class DB_CONNECT {
    var $myconn;
    function connect() {
        define('DB_USER', "root"); // db user
        define('DB_PASSWORD', ""); // db password (default is empty)
        define('DB_DATABASE', "myproject"); // database name
        define('DB_SERVER', "localhost"); // db server
 
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysqli_error($con));
    $this->myconn = $con;
    return $this->myconn;
    }
    function close($myconn) {
        mysqli_close($myconn);
    }
}
?>