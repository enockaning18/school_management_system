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

        echo $response;
      }
    }
  }
}




mysqli_close($database_connection);
include(SHARED_PATH . "/footer.php");
