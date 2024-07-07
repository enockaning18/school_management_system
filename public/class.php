<?php

include("../private/initialize.php");
require_login();
include(SHARED_PATH . "/navbar.php");

$class_id = $_GET['class_id'] ?? null;

if (!$class_id) {
    echo "Class ID not found.";
    exit;
}

// Sanitize the class_id to prevent SQL injection
$class_id = mysqli_real_escape_string($database_connection, $class_id);

// Query to fetch teacher and class information
$query_command = "SELECT * FROM class INNER JOIN teachers ON class.teachers_id = teachers.teachers_id WHERE class.class_id = '$class_id'";
$result = mysqli_query($database_connection, $query_command);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "No teachers found for the given class ID.";
    exit;
}

while ($fetched_teacher_data = mysqli_fetch_assoc($result)) {
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="profile-banner.png" alt="Banner image" class="rounded-top img-fluid">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="../images/teachers_pictures/<?php echo htmlspecialchars($fetched_teacher_data['images']); ?>" alt="user image" width="130" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4><?php echo htmlspecialchars($fetched_teacher_data['first_name']); ?></h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item fw-medium">
                                    <i class="bx bx-pen"></i> Class Teacher
                                </li>
                                <li class="list-inline-item fw-medium">
                                    <i class="bx bx-map"></i> <?php echo htmlspecialchars($fetched_teacher_data['class_name']); ?>
                                </li>
                                <li class="list-inline-item fw-medium">
                                    <i class="bx bx-calendar-alt"></i> Joined April 2021
                                </li>
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
                            <i class="bx bx-user-check me-1"></i>Active
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Pagination logic -->
    <?php
    // Number of students per page
    $students_per_page = 5;

    // Get the current page number from the URL, if not present default to 1
    $current_page = $_GET['page'] ?? 1;
    $current_page = (int)$current_page;

    // Query to get the total number of students
    $total_students_query = "SELECT COUNT(*) AS total FROM student WHERE class_id = '$class_id'";
    $total_students_result = mysqli_query($database_connection, $total_students_query);
    $total_students = mysqli_fetch_assoc($total_students_result)['total'];

    // Calculate the offset for the SQL query
    $offset = ($current_page - 1) * $students_per_page;

    // Query to fetch students with limit and offset
    $student_query = "SELECT * FROM student WHERE class_id = '$class_id' LIMIT $students_per_page OFFSET $offset";
    $student_result = mysqli_query($database_connection, $student_query);

    if (!$student_result || mysqli_num_rows($student_result) === 0) {
        echo "No students found for this class.";
    } else {
    ?>
        <div class="row">
            <?php while ($fetched_student = mysqli_fetch_assoc($student_result)) { ?>
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="dropdown btn-pinned">
                                <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Share connection</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Block connection</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
                                </ul>
                            </div>
                            <!-- student details -->
                            <div class="mx-auto mb-3">
                                <img src="../images/student_pictures/<?php echo htmlspecialchars($fetched_student['images']); ?>" alt="Avatar Image" class="rounded-circle w-px-100 h-px-100">
                            </div>
                            <h5 class="mb-1 card-title"><?php echo htmlspecialchars($fetched_student['student_id']); ?></h5>
                            <span><?php echo htmlspecialchars($fetched_student['surname'] . " " . $fetched_student['othername']); ?></span>
                            <div class="d-flex align-items-center justify-content-center my-3 gap-2">
                                <a href="javascript:;" class="me-1"><span class="badge bg-label-secondary">Database </span></a>
                                <a href="javascript:;"><span class="badge bg-label-warning">Software</span></a>
                            </div>
                            <div class="d-flex align-items-center justify-content-around my-4 py-2">
                                <div>
                                    <h4 class="mb-1">18</h4>
                                    <span>Projects</span>
                                </div>
                                <div>
                                    <h4 class="mb-1">834</h4>
                                    <span>Attendance</span>
                                </div>
                                <div>
                                    <h4 class="mb-1">129</h4>
                                    <span>Connections</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="javascript:;" class="btn btn-primary d-flex align-items-center me-3"><i class="bx bx-user-check me-1"></i>Active</a>
                                <a href="javascript:;" class="btn btn-label-secondary btn-icon"><i class="bx bx-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        // Pagination controls
        $total_pages = ceil($total_students / $students_per_page);
        ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($current_page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?class_id=<?php echo $class_id; ?>&page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>
                <?php for ($page = 1; $page <= $total_pages; $page++) { ?>
                    <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>"><a class="page-link" href="?class_id=<?php echo $class_id; ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                <?php } ?>
                <?php if ($current_page < $total_pages) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?class_id=<?php echo $class_id; ?>&page=<?php echo $current_page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php } ?>
    </div>
</div>
<!-- Content wrapper -->

<?php include(SHARED_PATH . "/footer.php"); ?>

<?php
mysqli_free_result($result);
mysqli_free_result($student_result);
mysqli_close($database_connection);
?>
