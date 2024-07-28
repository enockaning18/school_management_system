<?php
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

$class_id = $_GET['class_id'] ?? null;

// Sanitize the class_id to prevent SQL injection
$class_id = mysqli_real_escape_string($database_connection, $class_id);

// Query to fetch student and class information
$query_command = "SELECT student_id, surname, othername, firstname, images, class.class_id 
FROM student 
JOIN class ON student.class_id = class.class_id 
WHERE student.class_id = '$class_id'";
$students_results = mysqli_query($database_connection, $query_command);

if (!$students_results) {
    die("Database query failed: " . mysqli_error($database_connection));
}

if (isset($_POST['mark_attendance'])) {
    $success = true;  // Initialize success flag
    foreach ($_POST['attendance'] as $student_id => $status) {
        $attendance_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
        $current_date = date('Y-m-d H:i:s');
        $student_id = mysqli_real_escape_string($database_connection, $student_id);
        $status = mysqli_real_escape_string($database_connection, $status);

        // Check if attendance was marked within the last 12 hours
        $date_query = "SELECT * FROM attendance WHERE student_id = ? AND `date` > DATE_SUB(NOW(), INTERVAL 12 HOUR)";
        $date_statement = mysqli_prepare($database_connection, $date_query);
        mysqli_stmt_bind_param($date_statement, "i", $student_id);
        mysqli_stmt_execute($date_statement);
        $check_result = mysqli_stmt_get_result($date_statement);

        if (mysqli_num_rows($check_result) > 0) {
            $success = false;
            break;  // Exit the loop if we found an attendance marked within the last 12 hours
        } else {
            $query_command = "INSERT INTO attendance (attendance_id, student_id, `status`, `date`) VALUES (?, ?, ?, ?)";
            $statement = mysqli_prepare($database_connection, $query_command);
            mysqli_stmt_bind_param($statement, "iiis", $attendance_id, $student_id, $status, $current_date);

            if (!mysqli_stmt_execute($statement)) {
                $success = false;
                echo "Error: " . mysqli_stmt_error($statement);
            }
        }
    }

    if ($success) {
        echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          title: 'Success!',
                          text: 'Attendance marked successfully.',
                          icon: 'success',
                          confirmButtonText: 'OK'
                      }).then(function() {
                          
                      });
                  });
              </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Can\'t mark attendance till the next day.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    
                });
            });
        </script>";
    }
}
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- form starts here -->
        <div class="p-3 mb-4">
            <h5 class="card-header mb-4">Profile Details</h5>
            <!-- Hoverable Table rows -->
            <form method="post" action="attendance.php?class_id=<?php echo $class_id; ?>">
                <div class="card">
                    <h5 class="card-header">Students Table</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr class="flex-row align-items-center ms-auto ">
                                    <th>Student ID</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php while ($fetch_result = mysqli_fetch_assoc($students_results)) { ?>
                                    <tr>
                                        <td>
                                            <div class="flex-row align-items-center ms-auto ">
                                                <img src="../images/student_pictures/<?php echo htmlspecialchars($fetch_result['images']); ?>" alt="Avatar" class="rounded-circle avatar avatar-xd me-3" />
                                                <span class="fw-medium"> <?php echo htmlspecialchars($fetch_result['student_id']) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex-row align-items-center ms-auto ">
                                                <span class="fw-medium"> <?php echo htmlspecialchars($fetch_result['surname']) ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo htmlspecialchars($fetch_result['othername']) ?></td>
                                        <td>
                                            <div class="form-group">
                                                <div class="flex-row align-items-center ms-auto ">
                                                    <div class="form-check col">
                                                        <input class="form-check-input" type="radio" id="present_<?php echo htmlspecialchars($fetch_result['student_id']); ?>" name="attendance[<?php echo htmlspecialchars($fetch_result['student_id']); ?>]" value="1" required>
                                                        <label class="form-check-label" for="present_<?php echo htmlspecialchars($fetch_result['student_id']); ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="flex-row align-items-center ms-auto ">
                                                    <div class="form-check col">
                                                        <input class="form-check-input" type="radio" id="absent_<?php echo htmlspecialchars($fetch_result['student_id']); ?>" name="attendance[<?php echo htmlspecialchars($fetch_result['student_id']); ?>]" value="0" required>
                                                        <label class="form-check-label" for="absent_<?php echo htmlspecialchars($fetch_result['student_id']); ?>"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="p-3 mt-2">
                            <input type="submit" name="mark_attendance" class="btn btn-primary me-2" value="Mark Attendance">
                        </div>
                    </div>
                </div>
            </form>
            <!--/ Hoverable Table rows -->
        </div>
    </div>
</div>

<?php include(SHARED_PATH . "/footer.php"); ?>