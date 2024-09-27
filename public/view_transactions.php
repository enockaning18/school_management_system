<?php

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (isset($_GET['reference'])) {
  $date = getdate();


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
        $transaction_receipt_number = $verify_responds['data']['receipt_number'];
        $transaction_reference = $verify_responds['data']['reference'];
        $transaction_amount = $verify_responds['data']['amount'] / 100; // Paystack returns amount in kobo, divide by 100 for GHS
        $transaction_paid_at = $verify_responds['data']['paid_at'];
        $customer_email = $verify_responds['data']['customer']['email'];
        $payment_channel = $verify_responds['data']['authorization']['channel'];
        $payment_brand = $verify_responds['data']['authorization']['brand'];



        // Assuming you have a payments table with a column for the reference
        $query = "UPDATE transactions SET payment_status = ?, amount_payed = ?, payment_date = ?, customer_email = ?, channel = ?,  brand = ? WHERE payment_reference = ?";

        if ($statement = mysqli_prepare($database_connection, $query)) {
          mysqli_stmt_bind_param($statement, 'sssssss', $transaction_status, $transaction_amount, $transaction_paid_at, $customer_email, $payment_channel, $payment_brand, $reference_id);

          if (mysqli_stmt_execute($statement)) {
            $query_command = "SELECT * FROM transactions 
            JOIN student ON transactions.student_id = student.student_id
            JOIN class ON transactions.student_id = student.student_id
            JOIN payments ON transactions.student_id = payments.student_id
            WHERE payment_reference  = ? LIMIT 1 ";
            $statement = mysqli_prepare($database_connection, $query_command);
            $result = mysqli_stmt_bind_param($statement, 's', $reference_id);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement); ?>

            <?php while ($transaction_data = mysqli_fetch_assoc($result)) { ?>
              <div class="row invoice mx-auto row-printable">
                <div class="col-md-10">
                  <div class="card" id="dash_0">
                    <div class="card-body p-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="invoice-logo">
                            <img width="100" class="d-block rounded" src="../images/student_pictures/<?php echo $transaction_data['images']; ?>" alt="Receipt logo">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="invoice-from text-end">
                            <ul class="list-unstyled">
                              <li><strong>Dash LLC</strong></li>
                              <li>2500 Ridgepoint Dr, Suite 105-C</li>
                              <li>Austin TX 78754</li>
                              <li>VAT Number EU826113958</li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="invoice-details mt-4">
                            <div class="alert alert-light">
                              <ul class="list-unstyled mb-0">
                                <li><strong>Receipt Number:</strong> <?php echo $transaction_receipt_number ?> </li>
                                <li><strong>Payment Date:</strong> <?php echo $transaction_data['payment_date'] ?></li>
                                <li><strong>Amount Payed: </strong> <?php echo 'GH₵' . ' ' . $transaction_data['amount_payed'] ?></li>
                                <li><strong>Channel:</strong> <?php echo $transaction_data['channel'] . ' / ' . $transaction_data['brand']; ?></li>
                                <li><strong>Email:</strong> <?php echo $transaction_data['email'] ?></li>
                                <li><strong>Status:</strong> <span class="badge bg-success">successfull</span></li>
                              </ul>
                            </div>
                          </div>
                          <div class="invoice-to mt-4 p-3">
                            <ul class="list-unstyled">
                              <li><strong>Receipt To</strong></li>
                              <li><strong>Full Name: </strong><?php echo $transaction_data['surname'] . ' ' . $transaction_data['firstname'] . ' ' . $transaction_data['othername']; ?></li>
                              <li><strong>Phone No. </strong><?php echo $transaction_data['phonenumber']; ?></li>
                              <li><strong>Nationality: </strong><?php echo $transaction_data['nationality']; ?></li>
                              <li><strong>Class Name: </strong><?php echo $transaction_data['class_name']; ?></li>
                            </ul>
                          </div>
                          <div class="invoice-items">
                            <div class="table-responsive">
                              <table class="table table-bordered">

                                <thead>
                                  <tr>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Total</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <tr>
                                    <td>Payment for <?php echo $transaction_data['purpose'] ?></td>

                                    <td class="text-center"><?php echo 'GH₵' . ' ' . $transaction_data['amount_payed'] ?></td>
                                  </tr>                               

                                  <tr>
                                    <th colspan="" class="text-end">Tax:</th>
                                    <td class="text-center">GH₵ 0.00</td>
                                  </tr>
                                  <tr>
                                    <th colspan="" class="text-end">VAT:</th>
                                    <td class="text-center">GH₵ 0.00</td>
                                  </tr>

                                  <tr>
                                    <th colspan="" class="text-end">Total:</th>
                                    <td class="text-center"><?php echo 'GH₵' . ' ' . $transaction_data['amount_payed'] ?></td>
                                  </tr>

                                </tbody>

                              </table>
                            </div>
                          </div>
                          <div class="invoice-footer mt-4 text-center">
                            <p>Generated on , <?php echo $date['weekday'] . ', ' . $date['mday'] . ' ' . $date['month'] . ' ' . $date['year']; ?> <a href="#" class="btn btn-outline-secondary ms-3"><i class="fa fa-print me-2"></i>Print</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>


<? } else {
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
