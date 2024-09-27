
<?php
ob_start(); // Start output buffering
include "../private/initialize.php";
include "../private/shared/navbar.php";

                

if (!empty($_SESSION["admin_id"])) {
  $admin_id = $_SESSION["admin_id"];
  $query_command = "SELECT * FROM admin WHERE admin_id = $admin_id";
  $result = mysqli_query($database_connection, $query_command);
  $fetch_admin = mysqli_fetch_assoc($result);
?>

  <!-- Content wrapper -->
  <div class="content-wrapper ">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h1> Welcome <?php echo htmlspecialchars($fetch_admin['username']); ?> </h1>
      <div class="row">
        <!--  main dashboard  -->
        <div class="col-md-6 col-lg-7 col-xl-8 order-0 mb-4">
          <div class="card h-100">

            <!-- here -->

            <div class="row">
              <div class="col-lg-4 col-md-12 col-6 mb-4 m-4">

                <div class="border border-primary d-flex rounded-3 p-4 justify-content-between">
                  <div>
                    <div>
                      <span class="fs-1">50</span>
                    </div>
                    <div class="">
                      <span>No. of Students</span>
                    </div>
                  </div>
                  <div>
                    <span><i class="uil uil-book-reader"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../bootstrap-config/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                      </div>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <span></span>
                    <h3 class="card-title text-nowrap mb-1"></h3>
                    <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> </small>
                  </div>
                </div>
              </div>
            </div>
            <!-- here -->

          </div>
        </div>
        <!--/ main dashboard -->



        <!-- Transactions -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
          <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5 class="card-title m-0 me-2">Transactions</h5>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                  <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                  <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                  <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php $query_command = "SELECT student.student_id, student.class_id, student.firstname, student.surname, brand, channel, amount_payed, payment_status";
              $query_command .= " FROM transactions JOIN student ON transactions.student_id = student.student_id";
              $query_command .= " JOIN class ON student.class_id = class.class_id LIMIT 5 ";
              $statement = mysqli_query($database_connection, $query_command); ?>
              <ul class="p-0 m-0">
                <?php while ($transaction_data = mysqli_fetch_assoc($statement)) { ?>
                  <li class="d-flex align-items-center mb-4 pb-1">
                    <div class="avatar  flex-shrink-0 me-3">
                      <img src="../bootstrap-config/assets/img/icons/unicons/wallet.png" alt="User" class="rounded">
                    </div>
                    <div class=" w-100 flex-wrap align-items-center justify-content-between">
                      <div class="">
                        <small class=" d-block mb-1"> <?php echo $transaction_data['channel'] . ' / ' . $transaction_data['brand'] ?></small>
                        <h6 class="mb-1"> <?php echo $transaction_data['surname'] . ' ' . $transaction_data['firstname'] ?></h6>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <span><?php echo $transaction_data['student_id'] ?></span>
                      </div>
                    </div>
                    <div class="user-progress d-flex-row gap-1">
                      <div class="user-progress  d-flex align-items-center gap-1">
                        <h6 class="mb-0"> +<?php echo $transaction_data['amount_payed'] ?></h6>
                        <span class="text-muted">GH₵</span>
                      </div>
                      <div class="user-progress d-flex align-items-center gap-1">
                        <span class="text-success"><?php echo $transaction_data['payment_status'] ?></span>
                      </div>
                    </div>
                  </li>
                <? } ?>
              </ul>
            </div>

          </div>
        </div>
        <!--/ Transactions -->
      </div>
    </div>
  </div>
  <!-- Content wrapper -->
<?php
} else {
  header("Location: auth_login.php");
  exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>


<?php include "../private/shared/footer.php"; ?>