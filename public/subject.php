<?php

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");


if (isset($_POST['add_subject'])) {
  $subject_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
  $subject_name = $_POST['subject_name'];
  $teacher_id = $_POST['teacher_id'];
  $class_id = $_POST['class_id'];
  $duration = $_POST['duration'];

  $query_command = "INSERT INTO subject(subject_id, subject_name, teacher_id, class_id, duration) VALUES(?,?,?,?,?)";
  $statement = mysqli_prepare($database_connection, $query_command);
  mysqli_stmt_bind_param($statement, 'isiis', $subject_id, $subject_name, $teacher_id, $class_id, $duration);

  if (mysqli_stmt_execute($statement)) {
    echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New subject added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                      window.location.href = 'subject.php'
                    });
                });
              </script>";
  } else {
    echo mysqli_error($database_connection);
  }
}


// Fetch subjects and teachers data
$query_command = "SELECT subject_id, subject_name, class_id, duration, teachers.last_name, teachers.images 
                  FROM subject 
                  JOIN teachers ON subject.teacher_id = teachers.teachers_id";
$subject_result = mysqli_query($database_connection, $query_command);

?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <!-- starts here -->
    <div class="">
      <h6 class="text-muted">Subject</h6>
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-subject" aria-controls="navs-pills-justified-subject" aria-selected="true">
              <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Add Subject</span>
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-subject-list" aria-controls="navs-pills-subject-list" aria-selected="false">
              <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Subject List</span>
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <!-- Add subject form starts here -->
          <div class="tab-pane fade show active" id="navs-pills-justified-subject" role="tabpanel">
            <form action="subject.php" id="formAccountSettings" method="POST" enctype="multipart/form-data">
              <div class="p-3 mb-4">
                <h5 class="card-header mb-4">Add Subject</h5>
                <div class="card-body">
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="subjectName" class="form-label">Subject Name</label>
                      <input class="form-control" type="text" id="subjectName" name="subject_name" placeholder="Subject Name" autofocus />
                    </div>
                    <?php
                    $query_command = "SELECT * FROM teachers";
                    $teacher_subject_result = mysqli_query($database_connection, $query_command);
                    ?>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="teacher">Teacher</label>
                      <select id="teacher" name="teacher_id" class="select2 form-select">
                        <option value="">Select</option>
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
                      <label class="form-label" for="class">Class</label>
                      <select id="class" name="class_id" class="select2 form-select">
                        <option value="">Select</option>
                        <?php while ($fetched_subject_class = mysqli_fetch_assoc($class_subject_result)) { ?>
                          <option value="<?php echo $fetched_subject_class['class_id'] ?>"> <?php echo $fetched_subject_class['class_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="duration">Duration</label>
                      <select id="duration" name="duration" class="select2 form-select">
                        <option value="">Select</option>
                        <option value="1 Hour">1 Hour</option>
                        <option value="2 Hours">2 Hours</option>
                        <option value="3 Hours">3 Hours</option>
                      </select>
                    </div>
                  </div>
                  <div class="mt-2">
                    <input type="submit" name="add_subject" class="btn btn-primary me-2">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- Add subject form ends here -->
          <!-- Add subject table starts here -->
          <div class="tab-pane fade" id="navs-pills-subject-list" role="tabpanel">
            <div class="p-3">
              <h5 class="card-header mb-4">Subject Table</h5>
              <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Teacher</th>
                        <th>Course Code</th>
                        <th>Course</th>
                        <th>Class</th>
                        <th>Duration</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
                      $query_command = "SELECT subject_id, subject_name, teachers.teachers_id, class.class_name, duration, teachers.last_name, teachers.first_name, images ";
                      $query_command .= " FROM subject JOIN teachers ON subject.teacher_id = teachers.teachers_id ";
                      $query_command .= " JOIN class ON subject.class_id = class.class_id ";
                      $subject_result = mysqli_query($database_connection, $query_command);
                      while ($subject_fetch_result = mysqli_fetch_assoc($subject_result)) { ?>
                        <tr>
                          <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                              <div class="avatar-wrapper">
                                <div class="avatar me-2"><img src="../images/teachers_pictures/<?php echo $subject_fetch_result['images']; ?>" alt="Avatar" class="rounded-circle"></div>
                              </div>
                              <div class="d-flex flex-column ">
                                <span class="emp_name text-truncate "><?php echo $subject_fetch_result['last_name'] . ' ' . $subject_fetch_result['first_name'] ?></span>
                                <span class="emp_post text-truncate "><?php echo $subject_fetch_result['teachers_id'] ?></span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="fw-medium">Bs.<?php echo $subject_fetch_result['subject_id'] ?></span>
                          </td>
                          <td>
                            <span class="fw-medium"><?php echo $subject_fetch_result['subject_name'] ?></span>
                          </td>
                          <td>
                            <span class="fw-medium"><?php echo $subject_fetch_result['class_name'] ?></span>
                          </td>
                          <td>
                            <span class="fw-medium"><?php echo $subject_fetch_result['duration'] ?></span>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo url_for('edit_subject.php?subject_id=' . $subject_fetch_result['subject_id']); ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                <a class="dropdown-item" href="<?php echo url_for('delete_subject.php?subject_id=' . $subject_fetch_result['subject_id']); ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <button onclick="printResult()" class="btn btn-primary mt-3">Print Subjects</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Add subject table ends here -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content wrapper -->

<script>
  function printResult() {
    var printContents = document.getElementById('result-table').outerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '<table>' + printContents + '</table>';
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
<?php
if ($database_connection) {
  mysqli_close($database_connection);
}
include(SHARED_PATH . "/footer.php");
?>