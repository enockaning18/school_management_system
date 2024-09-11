<?php
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");
require_login();
$subject_id = $_GET['subject_id'] ?? 'User not found'; // PHP > 7.0

////////////update student code starts here ////////////////
if (isset($_POST['update_subject'])) {
    $get_fields['subject_id'] = $subject_id;
    $get_fields['subject_name'] = $_POST['subject_name'];
    $fetched_subject_teacher['teachers_id'] = $_POST['teacher_id'];
    $fetched_subject_class['class_id'] = $_POST['class_id'];



    $query_command = "UPDATE subject SET ";
    $query_command .= "subject_name = '" . $get_fields['subject_name'] . "',";
    $query_command .= "teacher_id = '" . $fetched_subject_teacher['teachers_id'] . "',";
    $query_command .= "class_id = '" . $fetched_subject_class['class_id'] . " ' ";
    $query_command .= " WHERE subject_id = '" . $get_fields['subject_id'] . "'";


    $result = mysqli_query($database_connection, $query_command);
    if ($result) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            swal.fire({
                title: 'Success!',
                text: 'Subject Updated.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {                
                window.location.href = 'edit_subject.php?subject_id=' + $subject_id;                
            });
        });
      </script>";
    } else {
        echo mysqli_error($database_connection);
    }
}
?>




?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="">
            <h6 class="text-muted">Edit Course Details </h6>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                            <i class="tf-icons bx bx-user-plus fs-4 me-1"></i><span class="d-none d-sm-block"> Edit</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- add teacher form starts here  -->
                    <!-- add teacher form starts here  -->
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                        <!-- form starts here -->
                        <div class="p-3 mb-4">
                            <h5 class="card-header mb-4">Profile Details</h5>
                            <!-- Account -->
                            <form action="" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                                <?php
                                $query_command = "SELECT subject_id, subject_name, class_id, duration, teachers.last_name, teachers.images FROM subject JOIN teachers ON subject.teacher_id = teachers.teachers_id WHERE subject_id = '" . $subject_id . "' ";
                                $teacher_subject_result = mysqli_query($database_connection, $query_command);
                                ?>
                                <?php while ($get_fields = mysqli_fetch_assoc($teacher_subject_result)) { ?>
                                    <!-- <hr class="my-0 mb-4" /> -->

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Subject Name</label>
                                                <input class="form-control" type="text" id="firsName" name="subject_name" value="<?php echo $get_fields['subject_name'] ?>" placeholder="Subject Name" autofocus />
                                            </div>

                                            <?php
                                            $query_command = "SELECT * FROM teachers";
                                            $teacher_subject_result = mysqli_query($database_connection, $query_command);
                                            ?>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Teacher</label>
                                                <select id="teacher" name="teacher_id" class="select2 form-select">
                                                    <option value="<?php echo $fetched_subject_teacher['teachers_id'] ?>"><?php echo $fetched_subject_teacher['first_name'] . ' ' . $fetched_subject_teacher['last_name'] ?></option>
                                                    <?php while ($fetched_subject_teacher = mysqli_fetch_assoc($teacher_subject_result)) { ?>
                                                        <option value="<?php echo $fetched_subject_teacher['teachers_id'] ?>"> <?php echo $fetched_subject_teacher['first_name'] . ' ' . $fetched_subject_teacher['last_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <?php
                                            $query_command = "SELECT * FROM class";
                                            $class_subject_result = mysqli_query($database_connection, $query_command);
                                            ?>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Class</label>
                                                <select id="class_id" name="class_id" class="select2 form-select">
                                                    <option value="">Select</option>
                                                    <?php while ($fetched_subject_class = mysqli_fetch_assoc($class_subject_result)) { ?>
                                                        <option value="<?php echo $fetched_subject_class['class_id'] ?>"> <?php echo $fetched_subject_class['class_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Duration</label>
                                                <select id="class_id" name="duration" class="select2 form-select">
                                                    <option value="">Select</option>
                                                    <option value="1 Hour">1 Hour</option>
                                                    <option value="2 Hours">2 Hours</option>
                                                    <option value="3 Hours">3 Hours</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" name="update_subject" class="btn btn-primary me-2"> Save Changes </button>
                                    </div>


                                <?php } ?>
                            </form>

                        </div>
                        <!-- /Account -->
                        <!-- form ends here -->
                    </div>
                    <div class="card">
                        <h5 class="card-header">Delete Subject</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading mb-1">Are you sure you want to delete this subject?</h6>
                                    <p class="mb-0">Once you delete this subject, there is no going back. Please be certain.</p>
                                </div>
                            </div>
                            <form id="formAccountDeactivation" method="POST">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="account_deactivate" id="account_deactivate" />
                                    <label class="form-check-label" for="account_deactivate">I confirm my delete subject</label>
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account">Delete Subject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- Content wrapper -->

        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['account_deactivate']) && $_POST['account_deactivate'] === 'on') {
                $student_id;

                $query_command = "DELETE FROM student WHERE student_id = ?";
                $statement = mysqli_prepare($database_connection, $query_command);
                mysqli_stmt_bind_param($statement, 'i', $student_id);
                if (mysqli_stmt_execute($statement)) {
                    header("Location: teacher.php");
                } else {
                    echo "Error " . mysqli_stmt_error($statement);
                }
            } else {
                echo '                
                <div class="position-absolute top-50 start-50 translate-right bs-toast toast fade show bg-danger  top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-medium">Notification</div>
                    <small>0 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                    Select Confirm before account can be deactivated.
                    </div>
                </div>';
            }
        }



        include(SHARED_PATH . "/footer.php");
