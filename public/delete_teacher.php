<?php
include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (!empty($_SESSION["admin_id"])) {
    $teachers_id = $_GET['teachers_id'] ?? 'User not found'; // PHP > 7.0


    $query_command = "SELECT * FROM teachers WHERE teachers_id = '" . $teachers_id . "'";
    $student_result = mysqli_query($database_connection, $query_command);



    if (isset($_POST['delete_teacher'])) {
        $student_id;

        $query_command = "DELETE FROM teachers WHERE teachers_id = ?";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, 'i', $teachers_id);
        if (mysqli_stmt_execute($statement)) {
            header("Location: ../delete_message.php");
        } else {
            echo "Error " . mysqli_stmt_error($statement);
        }
    }
?>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <?php while ($get_fields = mysqli_fetch_assoc($student_result)) { ?>
                <form action="" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                    <div class="position-absolute top-50 start-50 translate-middle bs-toast toast fade show bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-medium">Confirmation Message</div>
                            <small>0 mins ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Do you want to delete <?php echo $get_fields['last_name'] ?>
                        </div>

                        <div class="flex me-auto">
                            <button type="submit" name="delete_teacher" class="btn btn-primary me-2"> Delete </button>
                        </div>

                    </div>
                    <div class="">
                        <h5 class="text-muted">Edit <b> <?php echo $get_fields['last_name'] ?> </b> Details</h5>
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                                        <i class="tf-icons bx bx-edit-alt fs-4 me-1"></i><span class="d-none d-sm-block"> Edit Teacher</span>
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


                                        <div class="card-body">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <img src="../images/teachers_pictures/<?php echo $get_fields['images']; ?>" alt="<?php echo $get_fields['first_name'] ?>" name="image" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
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

                                                <div class="mb-3 ">
                                                    <label for="lastName" class="form-label">First Name </label>
                                                    <input class="form-control" value="<?php echo $get_fields['first_name']; ?>" type="text" name="first_name" id="lastName" placeholder="Surname " readonly />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="firstName" class="form-label">Last Name</label>
                                                    <input class="form-control" value="<?php echo $get_fields['last_name']; ?>" type="text" id="last_name" name="last_name" placeholder="Other Name" readonly autofocus />
                                                </div>


                                                <div class="mb-3 col-md-6">
                                                    <label for="email" class="form-label">E-mail</label>
                                                    <input class="form-control" type="text" value="<?php echo $get_fields['email']; ?>" id="email" name="email" placeholder="john.doe@example.com" readonly />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">GH (+233)</span>
                                                        <input type="text" id="phoneNumber" value="<?php echo $get_fields['phone']; ?>" name="phone" class="form-control" placeholder="202 555 0111" readonly />
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address" value="<?php echo $get_fields['address']; ?>" name="address" placeholder="Address" readonly />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="address" class="form-label">Age</label>
                                                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $get_fields['age']; ?>" placeholder="Age" readonly />
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="country">Country</label>
                                                    <select id="country" name="nationality" class="select2 form-select" readonly>
                                                        <option readonly value="" <?php echo $get_fields['nationality']; ?>> <?php echo $get_fields['nationality']; ?> </option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="China">China</option>
                                                        <option value="France">France</option>
                                                        <option value="Germany">Ghana</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="India">India</option>
                                                        <option value="Indonesia">Indonesia</option>
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Korea">Korea, Republic of</option>
                                                        <option value="Mexico">Mexico</option>
                                                        <option value="Philippines">Philippines</option>
                                                        <option value="Russia">Russian Federation</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="Thailand">Thailand</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="Ukraine">Ukraine</option>
                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="United States">United States</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="language" class="form-label">Language</label>
                                                    <select id="language" name="language" class="select2 form-select">
                                                        <option readonly value="" <?php echo $get_fields['language']; ?>> <?php echo $get_fields['language']; ?></option>
                                                        <option value="English">English</option>
                                                        <option value="Twi">Twi</option>
                                                        <option value="Fante">Fante</option>
                                                        <option value="Sefwi">Sefwi</option>
                                                        <option value="Ga">Ga</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" name="update_teacher" class="btn btn-primary me-2"> Save Changes </button>
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
            <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                    <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
            </form>
        </div>
    </div>
    </div>
    </div>


    </div>
    <!-- Content wrapper -->
<?php } else {
    header("Location: auth_login.php");
    exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>


<?php include(SHARED_PATH . "/footer.php"); ?>