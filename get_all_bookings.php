<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/db_connectBookings.php';

$db = new DB_CONNECT();

if (!$db->connect()) {
    echo json_encode(array('error' => 'Database connection failed: ' . mysqli_connect_error()));
    exit;
}

$currentDate = date('Y-m-d');

$sqlCommand = "SELECT pid, date, starttime, endtime, name, des 
               FROM bookings 
               WHERE date >= '$currentDate'
               ORDER BY date ASC";

$result = mysqli_query($db->myconn, $sqlCommand);

if ($result === false) {
    echo json_encode(array('error' => 'Error executing query: ' . mysqli_error($db->myconn)));
    exit;
}

$bookings = array();

while ($row = mysqli_fetch_assoc($result)) {
    $booking = array(
        'pid' => $row["pid"],
        'date' => $row["date"],
        'starttime' => $row["starttime"],
        'endtime' => $row["endtime"],
        'name' => $row["name"],
        'des' => $row["des"], 
    );
    $bookings[] = $booking;
}

echo json_encode($bookings);
?>
