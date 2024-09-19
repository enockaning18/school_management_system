<?php

use LDAP\Result;

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (isset($_POST['add_teacher'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phonenumber'];
  $address = $_POST['address'];
  $age = $_POST['age'];
  $nationality = $_POST["nationality"];
  $language = $_POST['language'];
  $file = $_FILES['image'];
  // Generate a random 7-digit number
  $student_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
  // Check if file is uploaded
  $file_name = $_FILES['image']['name'];
  $file_size = $_FILES['image']['size'];
  $file_temp = $_FILES['image']['tmp_name'];
  $file_error = $_FILES['image']['error'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_own_extension = strtolower($file_extension);
  $extension_allowed = array('jpg', 'png', 'jpeg', 'heic', 'svg', 'webp', 'bmp', 'tiff', 'ico');;



  if (in_array($file_own_extension, $extension_allowed)) {
    if ($file_error === 0) {
      if ($file_size < 1000000000000) {
        $file_new_name = uniqid('') . "." . $file_own_extension;
        $file_directory =  '../images/teachers_pictures/' . $file_new_name;

        $query_command = "INSERT INTO teachers (teachers_id, first_name, last_name, email, phone, address, age, nationality, images, language) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, "isssssssss", $student_id, $firstname, $lastname, $email, $phone, $address, $age, $nationality, $file_new_name, $language);
        if (mysqli_stmt_execute($statement)) {
          move_uploaded_file($file_temp, $file_directory);
          echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New teacher added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        
                    });
                });
              </script>";
        } else {
          echo "Error " . mysqli_stmt_error($statement);
        }
      } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'File size too big.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        
                    });
                });
        </script>";
      }
    } else {
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Error!',
              text: 'There was an error uploading file.',
              icon: 'error',
              confirmButtonText: 'Retry'
          }).then(function() {
              
          });
      });
      </script>";
    }
  } else {
    echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Error!',
              text: 'File extension not supported.',
              icon: 'error',
              confirmButtonText: 'Retry'
          }).then(function() {
              
          });
      });
      </script>";
  }
}


if (isset($_POST['add_class'])) {
  $class_name = $_POST['classname'];
  $no_student = $_POST['no_students'];

  // Generate a random 7-digit number
  $class_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

  // Check if file is uploaded
  $file_name = $_FILES['class_image']['name'];
  $file_size = $_FILES['class_image']['size'];
  $file_temp = $_FILES['class_image']['tmp_name'];
  $file_error = $_FILES['class_image']['error'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_own_extension = strtolower($file_extension);
  $extension_allowed = array('jpg', 'png', 'jpeg', 'heic', 'svg', 'webp', 'bmp', 'tiff', 'ico');


  if (in_array($file_own_extension, $extension_allowed)) {
    if ($file_error === 0) {
      if ($file_size < 1000000000000) {
        $file_new_name = uniqid('') . "." . $file_own_extension;
        $file_directory =  '../images/class_pictures/' . $file_new_name;

        $query_command = "INSERT INTO class(class_id, class_name, no_student, image) VALUES (?,?,?,?)";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, "isss", $class_id, $class_name, $no_student, $file_new_name);
        if (mysqli_stmt_execute($statement)) {
          move_uploaded_file($file_temp, $file_directory);
          echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      title: 'Success!',
                      text: 'New class added successfully.',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      
                  });
              });
            </script>";
        } else {
          echo "Error " . mysqli_stmt_error($statement);
        }
      } else {
        echo "<script>
                      document.addEventListener('DOMContentLoaded', function() {
                          Swal.fire({
                              title: 'Success!',
                              text: 'File size too big.',
                              icon: 'error',
                              confirmButtonText: 'OK'
                          }).then(function() {
                              
                          });
                      });
              </script>";
      }
    } else {
      echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'There was an error uploading file.',
                    icon: 'error',
                    confirmButtonText: 'Retry'
                }).then(function() {
                    
                });
            });
            </script>";
    }
  } else {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'File extension not supported.',
                    icon: 'error',
                    confirmButtonText: 'Retry'
                }).then(function() {
                    
                });
            });
            </script>";
  }
}


if (isset($_POST['assign_teacher'])) {

  $teacher_id = $_POST['teacher'];
  $class = $_POST['class'];

  $query_command = "UPDATE Class SET ";
  $query_command .= "teachers_id = '" . $teacher_id . "' ";
  $query_command .= "WHERE class_id = '" . $class . "'";
  $result = mysqli_query($database_connection, $query_command);

  if ($result) {
    echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      title: 'Success!',
                      text: 'New teacher assigned.',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      
                  });
              });
            </script>";
  } else {
    echo $query_command;
    echo mysqli_error($database_connection);
  }
}


$query_command = "SELECT * FROM teachers";
$teacher_result = mysqli_query($database_connection, $query_command);

$query_command = "SELECT * FROM class";
$class_result = mysqli_query($database_connection, $query_command);

$query_command = "SELECT * FROM teachers JOIN class ON class.teachers_id = teachers.teachers_id";
$table_result = mysqli_query($database_connection, $query_command);


?>


<!-- Content wrapper -->

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- starts here -->
    <div class="">
      <h6 class="text-muted">Teachers</h6>
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
              <i class="tf-icons bx bx-user-plus fs-4 me-1"></i><span class="d-none d-sm-block"> Enroll Teacher</span>
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false">
              <i class="tf-icons bx bx-user me-1"></i><span class="d-none d-sm-block"> Assign Class</span>
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false">
              <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Teachers</span>
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <!-- add teacher form starts here  -->
          <!-- add teacher form starts here  -->
          <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
            <!-- form starts here -->
            <form action="teachers.php" id="formAccountSettings" method="POST" enctype="multipart/form-data">
              <div class="p-3 mb-4">
                <h5 class="card-header mb-4">Profile Details</h5>
                <!-- Account -->

                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <input type="file" name="image" class="d-block rounded" height="100" width="100" id="uploadedAvatar" required />
                    <div class="button-wrapper">

                      <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
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
                      <label for="firstName" class="form-label">First Name</label>
                      <input class="form-control" type="text" id="firsName" name="firstname" placeholder="First Name" autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="lastName" class="form-label">Surname </label>
                      <input class="form-control" type="text" name="lastname" id="lastName" placeholder="Surname " />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">E-mail</label>
                      <input class="form-control" type="text" id="email" name="email" placeholder="john.doe@example.com" />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="phoneNumber">Phone Number</label>
                      <div class="input-group input-group-merge">
                        <span class="input-group-text">GH (+233)</span>
                        <input type="text" id="phoneNumber" name="phonenumber" class="form-control" placeholder="202 555 0111" />
                      </div>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="address" class="form-label">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="address" class="form-label">Age</label>
                      <input type="text" class="form-control" id="address" name="age" placeholder="Age" />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="country">Country</label>
                      <select id="country" name="nationality" class="select2 form-select">
                        <option value="">Select</option>
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
                        <option value="">Select Language</option>
                        <option value="English">English</option>
                        <option value="Twi">Twi</option>
                        <option value="Fante">Fante</option>
                        <option value="Sefwi">Sefwi</option>
                        <option value="Ga">Ga</option>
                      </select>
                    </div>
                  </div>
                  <div class="mt-2">
                    <input type="submit" name="add_teacher" class="btn btn-primary me-2">
                  </div>
                </div>
                <!-- /Account -->
                <!-- form ends here -->
              </div>
            </form>
          </div>
          <!-- add teacher form ends here  -->
          <!-- add teacher form ends here  -->


          <!-- assign class starts here  -->
          <!-- assign class starts here  -->
          <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
            <!-- form starts here -->
            <form action="teachers.php" id="formAccountSettings" method="POST" enctype="multipart/form-data">
              <div class=" mb-4">

                <div class="tab-content">
                  <div class="container-xxl flex-grow-1 container-p-y">

                    <!-- add teacher form starts here  -->
                    <!-- add teacher form starts here  -->
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                      <!-- form starts here -->
                      <div class=" mb-4">
                        <h5 class="card-header mb-4">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../images/student_pictures/" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                              <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">choose new image</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" name="class_image" id="upload" class="account-file-input" hidden />
                              </label>
                              <button type="submit" name="update_image" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Save Changes</span>
                              </button>

                              <p class="text-muted mb-0">Allowed JPG, GIF or PNG.</p>
                            </div>
                          </div>
                        </div>
                        <div class="divider divider-primary">
                          <div class="divider-text"></div>
                        </div>
                        <!-- <hr class="my-0 mb-4" /> -->
                        <div class="card-body ">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="card mb-4">
                                <div class="card-body">
                                  <h5 class="mb-3">ADD CLASS</h5>

                                  <div class="mb-3 ">
                                    <label for="lastName" class="form-label">Class Name</label>
                                    <input class="form-control" type="text" name="classname" id="classname" placeholder="Class 1 " />
                                  </div>

                                  <div class="mb-3 ">
                                    <label for="lastName" class="form-label">No. Students</label>
                                    <input class="form-control" type="number" name="no_students" id="classname" placeholder=" " />
                                  </div>                        

                                  <div class="mt-2">
                                    <button type="submit" name="add_class" class="btn btn-primary me-2"> Add Class </button>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <!--assign teachers starts here  -->

                            <div class="col-md-6">
                              <div class="card mb-4">
                                <div class="card-body">
                                  <h5 class="mb-3">ASSIGN TEACHER</h5>
                                  <div class="mb-3 ">
                                    <label for="class" class="form-label">Class</label>
                                    <select id="class" name="class" class="select2 form-select">
                                      <option value="">Select Class</option>
                                      <option value="0">N/A</option>
                                      <?php while ($class_data = mysqli_fetch_assoc($class_result)) { ?>
                                        <option value="<?php echo $class_data['class_id'] ?>"><?php echo $class_data['class_name'] ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>

                                  <div class="mb-3 ">
                                    <label for="language" class="form-label">Teacher</label>
                                    <select id="teacher" name="teacher" class="select2 form-select">
                                      <option value="">Select Teacher</option>
                                      <?php while ($teachers_data = mysqli_fetch_assoc($teacher_result)) { ?>
                                        <option value="<?php echo $teachers_data['teachers_id'] ?>"><?php echo $teachers_data['first_name'] . ' ' . $teachers_data['last_name'] ?> </option>
                                      <? } ?>
                                    </select>
                                  </div>

                                  <div class="mt-2">
                                    <button type="submit" name="assign_teacher" class="btn btn-primary me-2"> Assign Teacher</button>
                                  </div>
                                </div>
                              </div>

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /Account -->
            </form>

            <!-- form ends here -->
          </div>


          <!-- table for teachers starts here  -->
          <!-- table for teachers starts here  -->
          <div class="tab-pane fade " id="navs-pills-justified-messages" role="tabpanel">
            <!-- form starts here -->
            <div class="p-3 ">
              <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                <div>
                  <h5 class="card-header ">Assigned Teachers Table</h5>
                </div>
                <div>
                  <a href="all_teachers.php" class="btn btn-info ">Show All</a>
                </div>
              </div>
              <!-- Hoverable Table rows -->
              <div class="card-body">

                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr class="flex-row align-items-center ms-auto ">
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Course</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php while ($fetch_result = mysqli_fetch_assoc($table_result)) { ?>
                        <tr>

                          <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                              <div class="avatar-wrapper">
                                <div class="avatar me-2"><img src="../images/teachers_pictures/<?php echo $fetch_result['images']; ?>" alt="Avatar" class="rounded-circle"></div>
                              </div>
                              <div class="d-flex flex-column ">
                                <span class="emp_name text-truncate "><?php echo $fetch_result['first_name'] . ' ' . $fetch_result['last_name'] ?></span>
                                <span class="emp_post text-truncate "><?php echo $fetch_result['teachers_id'] ?></span>
                              </div>
                            </div>


                          </td>

                          <td>
                            <div class="flex-row align-items-center ms-auto ">
                              <span class="fw-medium"> <?php if (!empty($fetch_result['class_name'])) {
                                                          echo $fetch_result['class_name'];
                                                        } else {
                                                          echo "Null";
                                                        } ?></span>
                            </div>
                          </td>

                          <td>
                            <div class="flex-row align-items-center ms-auto ">
                              <span class="fw-medium badge bg-label-primary me-1">
                                <?php if (!empty($fetch_result['subject'])) {
                                  echo $fetch_result['subject'];
                                } else {
                                  echo "Null";
                                } ?>

                              </span>
                            </div>
                          </td>
                          <td>
                            <span><?php echo $fetch_result['phone'] ?></span>
                          </td>
                          <td>
                            <span><?php echo $fetch_result['email'] ?></span>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo url_for('edit_teacher.php?teachers_id=' . $fetch_result['teachers_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="<?php echo url_for('delete_teacher.php?teachers_id=' . $fetch_result['teachers_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <button onclick="printResult()" class="btn btn-primary mt-3">Print Result</button>
                </div>
              </div>
              <!--/ Hoverable Table rows -->
            </div>
          </div>


          <!-- table for teachers ends here  -->
          <!-- table for teachers ends here  -->


        </div>





      </div>
    </div>
    <!-- assign class ends here  -->
    <!-- assign class ends here  -->





    <!-- table for subject starts here  -->
    <!-- table for subject starts here  -->


    <!-- table for subject ends here  -->
    <!-- table for subject ends here  -->

  </div>
</div>
</div>
<!-- ends here -->
</div>

<script>
  function printResult() {
    var printContents = document.getElementById('result-table').outerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '<table>' + printContents + '</table>';
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
<!-- Content wrapper -->
<?php mysqli_close($database_connection); ?>
<?php include(SHARED_PATH . "/footer.php");
