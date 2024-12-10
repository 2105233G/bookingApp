<?php

if (isset($_POST['action']) && isset($_POST['pid'])) {
    $action = $_POST['action'];
    $pid = $_POST['pid'];
    require_once __DIR__ . '/db_connectBookings.php';

    $myConnection = new DB_CONNECT();
    $myConnection->connect();

    if ($action === 'delete') {
        $sqlCommand = "DELETE FROM bookings WHERE pid = ?";
        if ($stmt = mysqli_prepare($myConnection->myconn, $sqlCommand)) {
            mysqli_stmt_bind_param($stmt, 'i', $pid);
            if (mysqli_stmt_execute($stmt)) {
                echo "Success";
            } else {
                echo "Error: Could not execute delete query: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare delete query: " . mysqli_error($myConnection->myconn);
        }
    } elseif (
        $action === 'update' && 
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

        $sqlCommand = "UPDATE bookings SET name = ?, date = ?, starttime = ?, endtime = ?, des = ? WHERE pid = ?";
        if ($stmt = mysqli_prepare($myConnection->myconn, $sqlCommand)) {
            mysqli_stmt_bind_param($stmt, 'sssssi', $name, $date, $starttime, $endtime, $des, $pid);
            if (mysqli_stmt_execute($stmt)) {
                echo "Success";
            } else {
                echo "Error: Could not execute update query: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: Could not prepare update query: " . mysqli_error($myConnection->myconn);
        }
    } else {
        echo "Error: Missing required fields for update";
    }

    $myConnection->close($myConnection->myconn);
} else {
    echo "Error: Missing required fields";
}
?>
