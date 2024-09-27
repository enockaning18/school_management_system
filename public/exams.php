<?php

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (!empty($_SESSION["admin_id"])) {
  // Fetch teachers, subjects, and exams
  $query_command = "SELECT * FROM teachers";
  $teacher_result = mysqli_query($database_connection, $query_command);

  $query_command = "SELECT * FROM exams";
  $exams_result = mysqli_query($database_connection, $query_command);

  $query_command = "SELECT * FROM `subject`";
  $subject_result = mysqli_query($database_connection, $query_command);

  if (isset($_POST['book_exams'])) {
    $exams_code = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
    $exams_name = $_POST['exams_name'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];

    $query_command = "INSERT INTO exams(exams_code, exams_name, subject_id, teacher_id, time_start, time_end) VALUES(?,?,?,?,?,?)";
    $statement = mysqli_prepare($database_connection, $query_command);
    mysqli_stmt_bind_param($statement, 'isiiss', $exams_code, $exams_name, $subject_id, $teacher_id, $time_start, $time_end);

    if (mysqli_stmt_execute($statement)) {
      echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Exams booked successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = window.location.href;
                });
            });
          </script>";
    } else {
      echo mysqli_error($database_connection);
    }
  }

  if (isset($_POST['add_score'])) {
    $result_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
    $exams_id = $_POST['exams_code'];
    $student_id = $_POST['student_id'];
    $exams_score = $_POST['exams_score'];
    $exams_grade = $_POST['exams_grade'];

    // Check if the exam score already exists
    $check_query = "SELECT * FROM exams_result WHERE exams_id = ? AND student_id = ?";
    $check_statement = mysqli_prepare($database_connection, $check_query);
    mysqli_stmt_bind_param($check_statement, 'ii', $exams_id, $student_id);
    mysqli_stmt_execute($check_statement);
    $result = mysqli_stmt_get_result($check_statement);

    if (mysqli_num_rows($result) > 0) {
      // Score already exists, display error message
      echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Exam score already exists for this student and exam.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
          </script>";
    } else {
      // Proceed to insert the new score
      $query_command = "INSERT INTO exams_result(result_id, exams_id, student_id, exams_score, exams_grade) VALUES(?,?,?,?,?)";
      $statement = mysqli_prepare($database_connection, $query_command);
      mysqli_stmt_bind_param($statement, 'iiiis', $result_id, $exams_id, $student_id, $exams_score, $exams_grade);

      if (mysqli_stmt_execute($statement)) {
        echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      title: 'Success!',
                      text: 'Exams score added .',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then(function() {
                      window.location.href = window.location.href;
                  });
              });
            </script>";
      } else {
        echo mysqli_error($database_connection);
      }
    }
  }
?>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="">
        <h6 class="text-muted">Exams</h6>
        <div class="nav-align-top mb-4">
          <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-book-exams" aria-controls="navs-pills-justified-book-exams" aria-selected="true">
                <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Book Exams</span>
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-exams-score" aria-controls="navs-pills-justified-exams-score" aria-selected="false">
                <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Exams Score</span>
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-exams-results" aria-controls="navs-pills-justified-exams-score" aria-selected="false">
                <i class="tf-icons bx bx-message-square me-1"></i><span class="d-none d-sm-block">Exams Results</span>
              </button>
            </li>
          </ul>
          <div class="tab-content">
            <!-- Add exams form starts here -->
            <div class="tab-pane fade show active" id="navs-pills-justified-book-exams" role="tabpanel">
              <form action="" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                <div class="p-3 mb-4">
                  <h5 class="card-header mb-4">Book Exams</h5>
                  <div class="card-body">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="exams_name" class="form-label">Exams Name</label>
                        <input class="form-control" type="text" id="exams_name" name="exams_name" required />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="subject_id">Subject</label>
                        <select id="subject_id" name="subject_id" class="select2 form-select" required>
                          <option value="">Select Subject</option>
                          <?php while ($fetched_subject = mysqli_fetch_assoc($subject_result)) { ?>
                            <option value="<?php echo $fetched_subject['subject_id'] ?>"> <?php echo $fetched_subject['subject_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="teacher_id">Supervisor</label>
                        <select id="teacher_id" name="teacher_id" class="select2 form-select" required>
                          <option value="">Select</option>
                          <?php while ($fetched_teacher = mysqli_fetch_assoc($teacher_result)) { ?>
                            <option value="<?php echo $fetched_teacher['teachers_id'] ?>"> <?php echo $fetched_teacher['first_name'] . ' ' . $fetched_teacher['last_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="row col-md-6">
                        <div class="mb-3 col-md-6">
                          <label for="time_start" class="form-label">Start Time</label>
                          <input class="form-control" type="time" id="time_start" name="time_start" required />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label for="time_end" class="form-label">End Time</label>
                          <input class="form-control" type="time" id="time_end" name="time_end" required />
                        </div>
                      </div>
                    </div>
                    <div class="mt-2">
                      <input type="submit" name="book_exams" class="btn btn-primary me-2" value="Book Exams">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- Add exams form ends here -->
            <!-- Add score form starts here -->
            <div class="tab-pane fade" id="navs-pills-justified-exams-score" role="tabpanel">
              <form action="" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                <div class="p-3 mb-4">
                  <h5 class="card-header mb-4">Exams Score Forms</h5>
                  <div class="card-body">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="exams_code">Exams</label>
                        <select id="exams_code" name="exams_code" class="select2 form-select">
                          <option value="">Select Exams</option>
                          <?php
                          mysqli_data_seek($exams_result, 0); // reset pointer
                          while ($fetched_exams = mysqli_fetch_assoc($exams_result)) { ?>
                            <option value="<?php echo $fetched_exams['exams_code'] ?>"> <?php echo $fetched_exams['exams_name'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="student_id">Student</label>
                        <select id="student_id" name="student_id" class="select2 form-select">
                          <option value="">Select Student</option>
                          <!-- Options will be populated by JavaScript -->
                        </select>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="exams_score" class="form-label">Exams Score</label>
                        <input class="form-control" type="number" id="exams_score" name="exams_score" required />
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="exams_grade" class="form-label">Exams Grade</label>
                        <input class="form-control" type="text" id="exams_grade" name="exams_grade" readonly required />
                      </div>
                    </div>
                    <div class="mt-2">
                      <input type="submit" name="add_score" class="btn btn-primary me-2" value="Add Score">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- Add score form ends here -->

            <!-- results from starts here -->
            <div class="tab-pane fade" id="navs-pills-justified-exams-results" role="tabpanel">
              <div class="p-3">

                <h5 class="card-header mb-4"></h5>
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
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <img src="" alt="Avatar" class="rounded-circle avatar avatar-xd me-3" />
                              <span class="fw-medium"> </span>
                            </div>
                          </td>
                          <td>
                            <span class="fw-medium"> </span>
                          </td>
                          <td>
                            <span class="fw-medium"> </span>
                          </td>
                          <td>
                            <span class="fw-medium"> </span>
                          </td>
                          <td>
                            <span class="fw-medium"> </span>
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
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- results from ends here -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content wrapper -->
  <?php mysqli_close($database_connection); ?>

  <!-- JavaScript to handle AJAX call and grade calculation -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Handle fetching students based on exams code
      document.getElementById('exams_code').addEventListener('change', function() {
        var examsCode = this.value;
        var studentSelect = document.getElementById('student_id');
        studentSelect.innerHTML = '<option value="">Select Student</option>'; // Reset the students combo box

        if (examsCode) {
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'fetch_students.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
              var students = JSON.parse(xhr.responseText);
              students.forEach(function(student) {
                var option = document.createElement('option');
                option.value = student.student_id;
                option.textContent = student.surname + ' ' + student.othername + ' ' + student.firstname;
                studentSelect.appendChild(option);
              });
            }
          };
          xhr.send('exams_code=' + encodeURIComponent(examsCode));
        }
      });

      // Handle grade calculation based on score input
      document.getElementById('exams_score').addEventListener('input', function() {
        var score = parseInt(this.value);
        var gradeField = document.getElementById('exams_grade');
        var grade;

        if (score >= 80 && score <= 100) {
          grade = 'A';
        } else if (score >= 60 && score <= 79) {
          grade = 'B';
        } else if (score >= 40 && score <= 59) {
          grade = 'C';
        } else if (score >= 20 && score <= 39) {
          grade = 'D';
        } else if (score >= 0 && score <= 19) {
          grade = 'F';
        } else {
          grade = '';
        }

        gradeField.value = grade;
      });
    });
  </script>
<?php } else {
  header("Location: auth_login.php");
  exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>
<?php include(SHARED_PATH . "/footer.php"); ?>