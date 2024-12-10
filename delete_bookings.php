<?php
/*
* Following code will delete the selected booking
* Booking ID is read from HTTP POST Request from Volley
*/

// Check if the booking ID is sent via POST
if (isset($_POST['pid'])) {
    // Retrieve the booking ID
    $pid = $_POST['pid'];

    // Include the database connection class
    require_once __DIR__ . '/db_connectBookings.php';

    // Connect to the database
    $myConnection = new DB_CONNECT();
    $myConnection->connect();

    // SQL command to delete the booking from the database
    $sqlCommand = "DELETE FROM bookings WHERE pid = $pid";

    // Prepare the statement to avoid SQL injection
    if ($stmt = mysqli_prepare($myConnection->myconn, $sqlCommand)) {
        // Bind the booking ID to the prepared statement
        mysqli_stmt_bind_param($stmt, 'i', $pid);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Booking successfully deleted
            echo "Success";
        } else {
            // Failed to delete the booking
            echo "Error: Could not execute query: " . mysqli_stmt_error($stmt);
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        // Failed to prepare the statement
        echo "Error: Could not prepare query: " . mysqli_error($myConnection->myconn);
    }

    // Close the database connection
    $myConnection->close($myConnection->myconn);
} else {
    // Booking ID not sent via POST
    echo "Error: Booking ID not provided";
}
?>
