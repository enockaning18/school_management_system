<?php
ob_start();
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");
if (!empty($_SESSION["admin_id"])) {
    $admin_id = $_SESSION["admin_id"];
    $query_command = "SELECT * FROM admin WHERE admin_id = $admin_id";
    $result = mysqli_query($database_connection, $query_command);
    $fetch_admin = mysqli_fetch_assoc($result);

?>
    <?php

    $query_command = "SELECT * FROM admin WHERE admin_id = '" . $admin_id . "'";
    $admin_result = mysqli_query($database_connection, $query_command);

    ////////////update admin code starts here ////////////////
    if (isset($_POST['update_admin'])) {
        $get_fields['admin_id'] = $admin_id;
        $get_fields['email'] = $_POST['email'];
        $get_fields['username'] = $_POST['username'];
        $get_fields['surname'] = $_POST['surname'];
        $get_fields['lastname'] = $_POST['lastname'];
        $get_fields['othername'] = $_POST['othername'];
        $get_fields['phonenumber'] = $_POST['phonenumber'];

        $query_command = "UPDATE `admin` SET ";
        $query_command .= "surname = '" . $get_fields['surname'] . "',";
        $query_command .= "username = '" . $get_fields['username'] . "',";
        $query_command .= "lastname = '" . $get_fields['lastname'] . "',";
        $query_command .= "othername = '" . $get_fields['othername'] . "',";
        $query_command .= "email = '" . $get_fields['email'] . "',";
        $query_command .= "phonenumber = '" . $get_fields['phonenumber'] . "'";
        $query_command .= " WHERE admin_id = '" . $get_fields['admin_id'] . "'";

        $result = mysqli_query($database_connection, $query_command);
        if ($result) {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Updated.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })then(function() {
                
                });
            });
          </script>";
        } else {
            mysqli_error($database_connection);
        }
    }


    ////////////update admin code ends here ////////////////




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
                    $file_directory = '../images/admin_pictures/' . $file_new_name;

                    $query_command = "UPDATE `admin` SET images = ? WHERE admin_id = ?";
                    $statement = mysqli_prepare($database_connection, $query_command);
                    mysqli_stmt_bind_param($statement, 'si', $file_new_name, $admin_id);

                    if (mysqli_stmt_execute($statement))
                        move_uploaded_file($file_temp, $file_directory);
                    echo '                
                    <div class="position-absolute top-50 start-50 translate-right bs-toast toast fade show bg-success  top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
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



    ?>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="">
                <h6 class="text-muted">My Profile</h6>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                                <i class="tf-icons bx bx-user-plus fs-4 me-1"></i><span class="d-none d-sm-block"> Edit Profile</span>
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
                                    <?php while ($get_fields = mysqli_fetch_assoc($admin_result)) { ?>
                                        <div class="card-body">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <img src="../images/admin_pictures/<?php echo $get_fields['images']; ?>" alt="<?php echo $get_fields['surname'] ?>" name="image" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
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
                                                    <input class="form-control" value="<?php echo $get_fields['surname']; ?>" type="text" name="surname" id="surname" placeholder="First Name " />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Other Name</label>
                                                    <input class="form-control" value="<?php echo $get_fields['othername']; ?>" type="text" id="othername" name="othername" placeholder="Surname" autofocus />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Last Name</label>
                                                    <input class="form-control" value="<?php echo $get_fields['lastname']; ?>" type="text" id="last_name" name="lastname" placeholder="Last Name" autofocus />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Email</label>
                                                    <input class="form-control" value="<?php echo $get_fields['email']; ?>" type="text" id="email" name="email" placeholder="john.doe@example.com" autofocus />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">Username</label>
                                                    <input class="form-control" type="text" value="<?php echo $get_fields['username']; ?>" id="username" name="username" placeholder="john.doe" />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">GH (+233)</span>
                                                        <input type="text" id="phoneNumber" value="<?php echo $get_fields['phonenumber']; ?>" name="phonenumber" class="form-control" placeholder="202 555 0111" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" name="update_admin" class="btn btn-primary me-2"> Save Changes </button>
                                            </div>


                                        <?php } ?>
                                </form>

                            </div>
                            <!-- /Account -->
                            <!-- form ends here -->
                        </div>
                        <div class="card">
                            <h5 class="card-header">Delete Account</h5>
                            <div class="card-body">
                                <div class="mb-3 col-12 mb-0">
                                    <div class="alert alert-warning">
                                        <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                                        <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                                    </div>
                                </div>
                                <form id="formAccountDeactivation" method="POST">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="account_deactivate" id="account_deactivate" />
                                        <label class="form-check-label" for="account_deactivate">I confirm my account deactivation</label>
                                    </div>
                                    <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
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
                $admin_id;

                $query_command = "DELETE FROM admin WHERE admin_id = ?";
                $statement = mysqli_prepare($database_connection, $query_command);
                mysqli_stmt_bind_param($statement, 'i', $admin_id);
                if (mysqli_stmt_execute($statement)) {
                    header("Location: index.php");
                } else {
                    echo "Error " . mysqli_stmt_error($statement);
                }
            } else {
                
            }
        }
    } else {
        header("Location: auth_login.php");
        exit; // It's a good practice to call exit after a header redirect
    }
    ob_end_flush(); // Flush the output buffer

    include(SHARED_PATH . "/footer.php");
