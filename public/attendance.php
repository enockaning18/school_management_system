<?php
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

$class_id = $_GET['class_id'] ?? null;

// Sanitize the class_id to prevent SQL injection
$class_id = mysqli_real_escape_string($database_connection, $class_id);

// Query to fetch student and class information
$query_command = "SELECT student_id, surname, othername, firstname, images, class.class_id FROM student JOIN class ON student.class_id = class.class_id WHERE student.class_id = '$class_id'";
$students_results = mysqli_query($database_connection, $query_command);

?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- form starts here -->
        <div class="p-3 mb-4">
            <h5 class="card-header mb-4">Profile Details</h5>
            <!-- Hoverable Table rows -->
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
                                                    <input class="form-check-input" type="radio" id="present_<?php echo htmlspecialchars($fetch_result['student_id']); ?>" name="attendance[<?php echo htmlspecialchars($fetch_result['student_id']); ?>]" value="Present">
                                                    <label class="form-check-label" for="present_<?php echo htmlspecialchars($fetch_result['student_id']); ?>"></label>
                                                </div>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="flex-row align-items-center ms-auto ">
                                                <div class="form-check col">
                                                    <input class="form-check-input" type="radio" id="absent_ ?>" name="attendance[<?php echo htmlspecialchars($fetch_result['student_id']); ?>]" value="Absent">
                                                    <label class="form-check-label" for="absent_<?php echo htmlspecialchars($fetch_result['student_id']); ?>"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Hoverable Table rows -->
        </div>
    </div>
</div>