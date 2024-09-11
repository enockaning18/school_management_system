<?php

use LDAP\Result;

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");



$query_command = "SELECT * FROM teachers";
$teacher_result = mysqli_query($database_connection, $query_command);
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
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false">
              <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Teachers</span>
            </button>
          </li>
        </ul>
        <div class="tab-content">



          <!-- table for teachers starts here  -->
          <!-- table for teachers starts here  -->
          <div class="tab-pane fade show active" id="navs-pills-justified-messages" role="tabpanel">
            <!-- form starts here -->
            <div class="p-3 ">
              <h5 class="card-header mb-4">All Teachers Table</h5>

              <!-- Hoverable Table rows -->
              <div class="card-body">

                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr class="flex-row align-items-center ms-auto ">
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Language</th>
                        <th>Nationality</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php while ($fetch_result = mysqli_fetch_assoc($teacher_result)) { ?>
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
                            <span class="fw-medium">
                              <?php echo $fetch_result['email'] ?>
                            </span>
                          </td>

                          <td>
                            <span>
                              <?php echo $fetch_result['phone'] ?>
                            </span>
                          </td>
                          <td>
                            <span>
                              <?php echo $fetch_result['address'] ?>
                            </span>
                          </td>
                          <td>
                            <span>
                              <?php echo $fetch_result['language'] ?>
                            </span>
                          </td>
                          <td>
                            <span><?php echo $fetch_result['nationality'] ?></span>
                          </td>
                          <td>
                            <div class="dropdown flex-row align-items-center ms-auto ">
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
