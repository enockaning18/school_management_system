<?php

use LDAP\Result;

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");
$query_command = "SELECT * FROM student";
$result = mysqli_query($database_connection, $query_command);

$query_command = 'SELECT surname, othername FROM student';
$student_result = mysqli_query($database_connection, $query_command);

$query_command = "SELECT * FROM class";
$class_result = mysqli_query($database_connection,$query_command);





?>


<!-- Content wrapper -->

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- starts here -->
    <div class="">
      <h6 class="text-muted">Add Student</h6>
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
              <form action="../private/php_actions/student_actions.php" id="formAccountSettings" method="POST" enctype="multipart/form-data">
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
                      <label for="lastName" class="form-label">Surname </label>
                      <input class="form-control" type="text" name="surname" id="lastName" placeholder="Surname " />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="firstName" class="form-label">Other Name</label>
                      <input class="form-control" type="text" id="othername" name="othername" placeholder="Other Name" autofocus />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input class="form-control" type="text" id="firsName" name="firstname" placeholder="First Name" autofocus />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">Date Of Birth</label>
                      <input class="form-control" type="date" id="dateofbirth" name="date" placeholder="john.doe@example.com" />
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
                      <labrgel for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="address" class="form-label">Age</label>
                      <input type="text" class="form-control" id="age" name="age" placeholder="Age" />
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

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="country">Class/Form</label>
                    <select id="country" name="class_id" class="select2 form-select">
                      <option value=" ">Select Class</option>
                      <?php while ($fetch_class_combo = mysqli_fetch_assoc($class_result)) { ?>
                        <option value="<?php echo $fetch_class_combo['class_id']; ?>"><?php echo $fetch_class_combo['class_name']?></option>
                      <? } ?>
                    </select>
                  </div>


                  <div class="mt-2">
                    <input type="submit" name="add_student" class="btn btn-primary me-2">
                  </div>
              </form>
            </div>
            <!-- /Account -->
            <!-- form ends here -->
          </div>
        </div>
        <!-- add teacher form ends here  -->
        <!-- add teacher form ends here  -->


        <!-- assign class starts here  -->
        <!-- assign class starts here  -->
        <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
          <!-- form starts here -->
          <div class="p-3 mb-4">
            <!-- Merged -->
            <!-- parents form -->
            <div class="row">
              <!-- Basic -->

              <form action="create.php" method="POST" enctype="multipart/form-data">
                <div class=" mb-4">
                  <h5 class="card-header">Guardian</h5>
                  <div class="card- demo-vertical-spacing demo-only-element">

                    <div class="row">

                      <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Surname </label>
                        <input class="form-control" type="text" name="surname" id="lastName" placeholder="Surname " />
                      </div>


                      <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Other name </label>
                        <input class="form-control" type="text" name="othername" id="othername" placeholder="Other Name" />
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">First Name</label>
                        <input class="form-control" type="text" name="firstname" id="firstName" placeholder="First Name" />
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">E-mail</label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="john.doe@example.com" />
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Phone Number</label>
                        <div class="input-group input-group-merge">
                          <span class="input-group-text">GH (+233)</span>
                          <input type="text" id="phoneNumber" name="phone_number" class="form-control" placeholder="202 555 0111" />
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="country">Assign Kid</label>
                        <select id="country" name="student_id" class="select2 form-select">
                          <option value=" "> Select</option>
                          <?php while ($fetch_combo = mysqli_fetch_assoc($student_result)) { ?>
                            <option value="<?php echo $fetch_combo['student_id']; ?>"><?php echo $fetch_combo['surname'] . " " . $fetch_combo['othername']; ?></option>
                          <? } ?>
                        </select>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="relationship" class="form-label">Relationship</label>
                        <input class="form-control" type="text" name="relationship" id="relationship" placeholder="Relationship" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="mt-2">
                  <button type="submit" name="add_guardian" class="btn btn-primary me-2">Add Guardian</button>
                </div>
              </form>
            </div>
            <!-- parents form ends here -->


          </div>
        </div>
        <!-- assign class ends here  -->
        <!-- assign class ends here  -->


        <!-- table for teachers starts here  -->
        <!-- table for teachers starts here  -->
        <div class="tab-pane fade " id="navs-pills-justified-messages" role="tabpanel">
          <!-- form starts here -->
          <div class="p-3 mb-4">
            <h5 class="card-header mb-4">Profile Details</h5>
            <!-- Hoverable Table rows -->
            <div class="card">
              <h5 class="card-header">Teachers Table</h5>
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>
                    <tr class="flex-row align-items-center ms-auto ">
                      <th>Student ID</th>
                      <th>Full Name</th>
                      <th>Nationality</th>
                      <th>Age</th>
                      <th>Date Of Birth</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    <?php while ($fetch_result = mysqli_fetch_assoc($result)) { ?>
                      <tr>

                        <td>
                          <div class="flex-row align-items-center ms-auto ">
                            <img src="../images/student_pictures/<?php echo $fetch_result['images']; ?>" alt="Avatar" class="rounded-circle avatar avatar-xd me-3" />
                            <span class="fw-medium"> <?php echo $fetch_result['student_id'] ?></span>
                          </div>
                        </td>

                        <td>
                          <div class="flex-row align-items-center ms-auto ">
                            <span class="fw-medium"> <?php echo $fetch_result['surname'] . ' ' . $fetch_result['othername'] . ' ' . $fetch_result['firstname'] ?></span>
                          </div>
                        </td>
                        <td><?php echo $fetch_result['othername'] ?></td>
                        <td>
                          <div class="flex-row align-items-center ms-auto ">
                            <span class="fw-medium"> <?php echo $fetch_result['nationality'] ?></span>
                          </div>
                        </td>
                        <td>
                          <span class="badge bg-label-primary me-1"><?php echo $fetch_result['phonenumber'] ?></span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo url_for('edit_student.php?student_id=' . $fetch_result['student_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                              <a class="dropdown-item" href="<?php echo url_for('delete_student.php?student_id=' . $fetch_result['student_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                              </form>
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
        <!-- table for teachers ends here  -->
        <!-- table for teachers ends here  -->

      </div>
    </div>
  </div>
  <!-- ends here -->
</div>
<!-- Content wrapper -->

<?php

include(SHARED_PATH . "/footer.php");
