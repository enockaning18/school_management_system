<?php
include("../private/initialize.php");

$input = json_decode(file_get_contents('php://input'), true);
$payment_id = $input['payment_id'];
$student_id = $input['student_id'];
$fee_id = $input['fee_id'];
$amount_payed = $input['amount_payed'];
$payment_method = $input['payment_method'];
$payment_date = $input['payment_date'];

// Verify the transaction using Paystack's API
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $payment_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer pk_live_1331391d9362adc096ed00e574cd590fcc024896", // Replace with your Paystack secret key
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo json_encode(['status' => 'error', 'message' => 'cURL Error #:' . $err]);
    exit();
}

$paystack_response = json_decode($response, true);

if ($paystack_response['status'] && $paystack_response['data']['status'] == 'success') {
    // Transaction is successful, update the database
    $payment_id = mysqli_real_escape_string($database_connection, $payment_id);
    $student_id = mysqli_real_escape_string($database_connection, $student_id);
    $fee_id = mysqli_real_escape_string($database_connection, $fee_id);
    $amount_payed = mysqli_real_escape_string($database_connection, $amount_payed);
    $payment_method = mysqli_real_escape_string($database_connection, $payment_method);
    $payment_date = mysqli_real_escape_string($database_connection, $payment_date);

    $query_command = "INSERT INTO payments (payment_id, student_id, fee_id, amount_payed, payment_method, payment_date) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($database_connection, $query_command);
    mysqli_stmt_bind_param($statement, "siisss", $payment_id, $student_id, $fee_id, $amount_payed, $payment_method, $payment_date);

    if (mysqli_stmt_execute($statement)) {
        echo json_encode(['status' => 'success', 'message' => 'Payment recorded successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database update failed: ' . mysqli_stmt_error($statement)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Payment verification failed.']);
}
