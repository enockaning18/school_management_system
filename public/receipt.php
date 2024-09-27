<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>
    School Management System
  </title>

  <meta name="description" content="" />

  <!-- Favicon -->

  <!-- <link rel="icon" type="image/x-icon" href="../bootstrap-config/assets/img/favicon/favicon.ico" /> -->
  <link rel="icon" type="" href="schoollogo.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="../bootstrap-config/assets/vendor/fonts/boxicons.css">

  <!-- Core CSS -->
  <link rel="stylesheet" href="../bootstrap-config/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../bootstrap-config/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../bootstrap-config/assets/css/demo.css">

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../bootstrap-config/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="../bootstrap-config/assets/vendor/libs/apex-charts/apex-charts.css">

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="../bootstrap-config/assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="../bootstrap-config/assets/js/config.js"></script>
</head>
<?php
include("../private/initialize.php");

$date = getdate();
$reference_id = 'PSK_218102867';

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
                <img src="schoollogo.png" width="100px" class="w-px-200 h-px-200 rounded-circle">

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
                <p>Generated on , <?php echo $date['weekday'] . ', ' . $date['mday'] . ' ' . $date['month'] . ' ' . $date['year']; ?>
                  <a href="javascript:window.print()" class="btn btn-outline-secondary ms-3"><i class="fa fa-print me-2"></i>Print</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


<?


mysqli_close($database_connection);
include(SHARED_PATH . "/footer.php");
