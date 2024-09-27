<?php
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (!empty($_SESSION["admin_id"])) {
    $student_id = $_GET['student_id'] ?? 'User not found'; // PHP > 7.0
    $query_command = "SELECT * FROM student WHERE student_id = '" . $student_id . "'";
    $student_result = mysqli_query($database_connection, $query_command);

    ////////////update student code starts here ////////////////
    if (isset($_POST['update_student'])) {
        $get_fields['student_id'] = $student_id;
        $get_fields['age'] = $_POST['age'];
        $get_fields['email'] = $_POST['email'];
        $get_fields['surname'] = $_POST['surname'];
        $get_fields['othername'] = $_POST['othername'];
        $get_fields['firstname'] = $_POST['firstname'];
        $get_fields['dateofbirth'] = $_POST['dateofbirth'];
        $get_fields['phonenumber'] = $_POST['phonenumber'];
        $get_fields['address'] = $_POST['address'];
        $get_fields['nationality'] = $_POST['nationality'];
        $get_fields['language'] = $_POST['language'];

        $query_command = "UPDATE student SET ";
        $query_command .= "surname = '" . $get_fields['surname'] . "',";
        $query_command .= "othername = '" . $get_fields['othername'] . "',";
        $query_command .= "firstname = '" . $get_fields['firstname'] . "',";
        $query_command .= "dateofbirth = '" . $get_fields['dateofbirth'] . "',";
        $query_command .= "phonenumber = '" . $get_fields['phonenumber'] . "',";
        $query_command .= "address = '" . $get_fields['address'] . "',";
        $query_command .= "language = '" . $get_fields['language'] . "' ";
        $query_command .= " WHERE student_id = '" . $get_fields['student_id'] . "'";

        $result = mysqli_query($database_connection, $query_command);
        if ($result) {
            echo 'updated';
        } else {
            mysqli_error($database_connection);
        }
    }


    ////////////update student code ends here ////////////////




    ////////////update image code starts here ////////////////

    if (isset($_POST['update_image'])) {
        $file = $_FILES['image'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];
        $file_error = $_FILES['image']['error'];

        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_own_extension = strtolower($file_extension);
        $extension_allowed = array('jpg', 'png', 'jpeg', 'heic', 'svg', 'webp', 'bmp', 'tiff', 'ico');

        if (in_array($file_own_extension, $extension_allowed)) {
            if ($file_error === 0) {
                if ($file_size < 1000000000000) {
                    $file_new_name = uniqid('') . "." . $file_extension;
                    $file_directory = '../images/student_pictures/' . $file_new_name;

                    $query_command = "UPDATE student SET images = ? WHERE student_id = ?";
                    $statement = mysqli_prepare($database_connection, $query_command);
                    mysqli_stmt_bind_param($statement, 'si', $file_new_name, $student_id);

                    if (mysqli_stmt_execute($statement))
                        move_uploaded_file($file_temp, $file_directory);
                    echo '                
                    <div class="position-absolute top-50 start-50 translate-middle bs-toast toast fade show bg-success  top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-medium">Notification</div>
                    <small>0 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                    Image Updated Successfully.
                    </div>
                    </div>';
                } else {
                    echo "File size too big";
                }
            } else {
                echo "There was an error uploading file";
            }
        } else {
            echo "File extension not accepted";
        }
    } else {
    }

    if (isset($_POST['delete_student'])) {
        $student_id;

        $query_command = "DELETE FROM student WHERE student_id = ?";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, 'i', $student_id);
        if (mysqli_stmt_execute($statement)) {
            header("Location: delete_message.php");
        } else {
            echo "Error " . mysqli_stmt_error($statement);
        }
    }
?>
<?php } else {
    header("Location: auth_login.php");
    exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>


<?php while ($get_fields = mysqli_fetch_assoc($student_result)) { ?>
    <!-- Content wrapper -->
    <form action="" id="formAccountSettings" method="POST" enctype="multipart/form-data">
        <div class="position-absolute top-50 start-50 translate-middle bs-toast toast fade show bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-medium">Confirmation Message</div>
                <small>0 mins ago</small>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
            </div>
            <div class="toast-body">
                Do you want to delete <?php echo $get_fields['surname'] ?>
            </div>

            <div class="flex me-auto">
                <button type="submit" name="delete_student" class="btn btn-primary me-2"> Delete </button>
            </div>

        </div>
    </form>


    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="">
                <h6 class="text-muted">Edit Student Details</h6>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                                <i class="tf-icons bx bx-user-plus fs-4 me-1"></i><span class="d-none d-sm-block"> Add Student</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false">
                                <i class="tf-icons bx bx-user me-1"></i><span class="d-none d-sm-block"> Add Parent</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false">
                                <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Students</span>
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

                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <img src="../images/student_pictures/<?php echo $get_fields['images']; ?>" alt="<?php echo $get_fields['surname'] ?>" name="image" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                    <span class="d-none d-sm-block">choose new image</span>
                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                    <input type="file" name="image" id="upload" class="account-file-input" hidden />
                                                </label>
                                                <button type="submit" name="update_image" class="btn btn-outline-secondary account-image-reset mb-4">
                                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Save Changes</span>
                                                </button>

                                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider divider-primary">
                                        <div class="divider-text"></div>
                                    </div>
                                    <!-- <hr class="my-0 mb-4" /> -->
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="mb-3 col-md-6">
                                                <label for="lastName" class="form-label">Surname </label>
                                                <input class="form-control" readonly value="<?php echo $get_fields['surname']; ?>" type="text" name="surname" id="lastName" placeholder="Surname " />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Other Name</label>
                                                <input class="form-control" readonly value="<?php echo $get_fields['othername']; ?>" type="text" id="othername" name="othername" placeholder="Other Name" autofocus />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input class="form-control" readonly value="<?php echo $get_fields['firstname']; ?>" type="text" id="firsName" name="firstname" placeholder="First Name" autofocus />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Date Of Birth</label>
                                                <input class="form-control" readonly type="date" value="<?php echo $get_fields['dateofbirth']; ?>" id="dateofbirth" name="dateofbirth" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" readonly type="text" value="<?php echo $get_fields['email']; ?>" id="email" name="email" placeholder="john.doe@example.com" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">GH (+233)</span>
                                                    <input type="text" readonly id="phoneNumber" value="<?php echo $get_fields['phonenumber']; ?>" name="phonenumber" class="form-control" placeholder="202 555 0111" />
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" readonly class="form-control" id="address" value="<?php echo $get_fields['address']; ?>" name="address" placeholder="Address" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">Age</label>
                                                <input type="text" readonly class="form-control" id="age" name="age" value="<?php echo $get_fields['age']; ?>" placeholder="Age" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="country">Country</label>
                                                <select id="country" readonly name="nationality" class="select2 form-select">
                                                    <option value="" <?php echo $get_fields['nationality']; ?>> <?php echo $get_fields['nationality']; ?></option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6" readonly>
                                                <label for="language" class="form-label">Language</label>
                                                <select id="language" name="language" class="select2 form-select">
                                                    <option value="" <?php echo $get_fields['language']; ?>> <?php echo $get_fields['language']; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" name="update_student" class="btn btn-primary me-2"> Save Changes </button>
                                        </div>


                                </form>

                            </div>
                            <!-- /Account -->
                            <!-- form ends here -->
                        </div>
                    </div>
                </div>


            </div>
            <!-- Content wrapper -->
        </div>
    </div>

<?php } ?>


<?php include(SHARED_PATH . "/footer.php"); ?>