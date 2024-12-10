<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (
    isset($_POST['date']) && 
    isset($_POST['starttime']) && 
    isset($_POST['endtime']) && 
    isset($_POST['name']) && 
    isset($_POST['des']) 
) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $des = $_POST['des']; 

    require_once __DIR__ . '/db_connectBookings.php';
    $myConnection = new DB_CONNECT();
    $myConnection->connect();

    $sqlCommand = "INSERT INTO bookings (date, starttime, endtime, name, des) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($myConnection->myconn, $sqlCommand);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssss', $date, $starttime, $endtime, $name, $des); 

        if (mysqli_stmt_execute($stmt)) {
            echo "Success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($myConnection->myconn);
    }
} else {
    echo "Error: Data not received correctly.";
}
?>
