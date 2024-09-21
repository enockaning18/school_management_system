<?php
include("../private/initialize.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reference = $_POST['reference'];
    $student_id = $_POST['student_id'];

    // Assuming $database_connection is your database connection
    $query = "INSERT INTO transactions (payment_reference, student_id) VALUES ('$reference', '$student_id')";
    if (mysqli_query($database_connection, $query)) {
        echo "Transaction saved successfully!";
    } else {
        echo "Error: " . mysqli_error($database_connection);
    }
}
?>
