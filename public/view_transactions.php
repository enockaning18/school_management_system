<?php

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (isset($_GET['reference'])) {
  $reference_id = $_GET['reference'];
  if ($reference_id == '') {
    header("Location: ../public/index.php");
  } else {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference_id",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "           ",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $key",
        "Cache-Control: no-cache",
      )
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $verify_responds = json_decode($response, true); // Decode JSON as an associative array
      if ($verify_responds['status'] == true) {

        // Extract the relevant data from the response
        $transaction_status = $verify_responds['data']['status']; 
        $transaction_reference = $verify_responds['data']['reference'];
        $transaction_amount = $verify_responds['data']['amount'] / 100; // Paystack returns amount in kobo, divide by 100 for GHS
        $transaction_paid_at = $verify_responds['data']['paid_at'];
        $customer_email = $verify_responds['data']['customer']['email'];

        // Assuming you have a payments table with a column for the reference
        $query = "UPDATE transactions SET payment_status = ?, amount_payed = ?, payment_date = ?, customer_email = ? WHERE payment_reference = ?";

        if ($statement = mysqli_prepare($database_connection, $query)) {
          mysqli_stmt_bind_param($statement, 'sssss', $transaction_status, $transaction_amount, $transaction_paid_at, $customer_email, $transaction_reference);

          if (mysqli_stmt_execute($statement)) {
            
          } else {
            echo "Error updating transaction: " . mysqli_error($database_connection);
          }
        } else {
          echo "Error preparing query: " . mysqli_error($database_connection);
        }
      }
    }
  }
}


mysqli_close($database_connection);
include(SHARED_PATH . "/footer.php");
