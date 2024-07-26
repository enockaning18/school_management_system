<?php
ob_start();
include "../private/initialize.php";
include(SHARED_PATH . "/navbar.php");
include "../private/scripts.php";
if (!empty($_SESSION["admin_id"])) {

    // Handle assignment of fees if the form is submitted
    if (isset($_POST['assign_amount'])) {
        // Sanitize input
        $fee_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
        $class_id = intval($_POST['class_id']);
        $amount = floatval($_POST['amount']);

        // Check if amount is already assigned
        $check_query = "SELECT * FROM fees WHERE class_id = ? AND fee_id > 0";
        $check_statement = mysqli_prepare($database_connection, $check_query);
        mysqli_stmt_bind_param($check_statement, 'i', $class_id);
        mysqli_stmt_execute($check_statement);
        $result = mysqli_stmt_get_result($check_statement);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Amount already assigned.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
        } else {
            // Insert new fee record
            $query_command = "INSERT INTO fees (fee_id, class_id, amount) VALUES (?, ?, ?)";
            $statement = mysqli_prepare($database_connection, $query_command);
            mysqli_stmt_bind_param($statement, "iis", $fee_id, $class_id, $amount);
            if (mysqli_stmt_execute($statement)) {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Amount Added.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    });
                  </script>";
            } else {
                echo "Error: " . mysqli_stmt_error($statement);
            }
        }
    } else {
?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="">
                    <h6 class="text-muted">Pay Fees</h6>
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-payment" aria-controls="navs-pills-justified-payment" aria-selected="true">
                                    <i class="tf-icons bx bx-user-plus fs-4 me-1"></i><span class="d-none d-sm-block">Payment</span>
                                </button>
                            </li>
                            <li class="nav-item align-items-center">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-fees" aria-controls="navs-pills-justified-fees" aria-selected="false">
                                    <i class="tf-icons bx bx-user me-1"></i><span class="d-none d-sm-block">Fees</span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- fees payment here -->
                            <div class="tab-pane fade show active" id="navs-pills-justified-payment" role="tabpanel">
                                <form action="pay_fees.php" id="paymentForm" method="POST" enctype="multipart/form-data">
                                    <div class="mb-4 p-3">
                                        <h5 class="mb-3">PAY FEES</h5>
                                        <div class="row">
                                            <div class="row">
                                                <?php
                                                $query_command = "SELECT * FROM class";
                                                $class_fees_result = mysqli_query($database_connection, $query_command);
                                                ?>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="country">Class</label>
                                                    <select id="class_id" name="class_id" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <?php while ($fetched_fees_class = mysqli_fetch_assoc($class_fees_result)) { ?>
                                                            <option value="<?php echo $fetched_fees_class['class_id'] ?>"> <?php echo $fetched_fees_class['class_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="country">Student</label>
                                                    <select id="student_id" name="student_id" class="select2 form-select">
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <input type="hidden">
                                                    <label class="form-label" for="country">Payment For</label>
                                                    <select id="payment" name="payment" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <option value="School Fees">School Fees</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="country">Amount</label>
                                                    <div>
                                                        <div class="input-group input-group-merge">
                                                        <box-icon name='dollar-circle'></box-icon>
                                                            <span id="basic-icon-default-dollar-circle" class="input-group-text"><i class="dollar-circle"></i></span>
                                                            <input type="number" name="amount_payed" id="amount_payed" class="form-control" placeholder="GH 0.00" aria-label="GH 0.00" aria-describedby="basic-icon-default-company2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="email" name="email_address" id="email_address" class="form-control" placeholder="example@example.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="button" onclick="payWithPaystack()" name="pay_fees" class="btn btn-primary me-2"> Make Payment </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- fees assignment here -->
                            <div class="tab-pane fade" id="navs-pills-justified-fees" role="tabpanel">
                                <form action="pay_fees.php" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                                    <div class="mb-4 p-3">
                                        <h5 class="mb-3">ASSIGN FEES</h5>
                                        <p class="font-primary">Note: Amount assigned will be the amount each student will pay</p>
                                        <div class="row">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <?php $payment_result = mysqli_query($database_connection, $query_command);  ?>
                                                    <label class="form-label" for="country">Class</label>
                                                    <select id="class_id" name="class_id" class="select2 form-select">
                                                        <option value="">Select</option>
                                                        <?php while ($fetched_payment_class = mysqli_fetch_assoc($payment_result)) { ?>
                                                            <option value="<?php echo $fetched_payment_class['class_id'] ?>"> <?php echo $fetched_payment_class['class_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="amount">Amount</label>
                                                    <div>
                                                        <div class="input-group input-group-merge">
                                                            <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                                            <input type="number" name="amount" id="basic-icon-default-company" class="form-control" placeholder="GH 0.00" aria-label="GH 0.00" aria-describedby="basic-icon-default-company2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="submit" name="assign_amount" class="btn btn-primary me-2"> Assign Amount </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end of fees assignment here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php }
    mysqli_close($database_connection); ?>
    <?php include "../private/shared/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle fetching students based on exams code
            document.getElementById('class_id').addEventListener('change', function() {
                var class_id = this.value;
                var studentSelect = document.getElementById('student_id');
                studentSelect.innerHTML = '<option value="">Select Student</option>'; // Reset the students combo box

                if (class_id) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'fetch_fees_students.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var students = JSON.parse(xhr.responseText);
                            students.forEach(function(student) {
                                var option = document.createElement('option');
                                option.value = student.student_id;
                                option.textContent = student.surname + ' ' + student.othername + ' ' + student.firstname;
                                studentSelect.appendChild(option);
                            });
                        }
                    };
                    xhr.send('class_id=' + encodeURIComponent(class_id));
                }
            });
        });
    </script>

<?php
} else {
    header("Location: auth_login.php");
    exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer

?>