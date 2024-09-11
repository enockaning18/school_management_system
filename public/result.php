<?php
include "../private/shared/navbar.php";

// Fetch subjects
$query_command = "SELECT * FROM `subject`";
$subject_result = mysqli_query($database_connection, $query_command);

// Fetch exam results
$query_command = "SELECT exams.exams_name AS exams_name, student.surname, student.images, student.firstname, subject.subject_name AS subject_name, exams_score, exams_grade 
FROM exams_result 
JOIN exams ON exams_result.exams_id = exams.exams_code 
JOIN subject ON exams.subject_id = subject.subject_id
JOIN student ON exams_result.student_id = student.student_id";
$exams_result = mysqli_query($database_connection, $query_command);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="">
      <h6 class="text-muted">Exams Result</h6>
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
          <?php while ($fetched_subject_result = mysqli_fetch_assoc($subject_result)) { ?>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#subject_<?php echo $fetched_subject_result['subject_id']; ?>" aria-controls="navs-pills-justified-home" aria-selected="true">
                <i class="tf-icons bx bx-user-plus fs-4 me-1"></i><span class="d-none d-sm-block"><?php echo $fetched_subject_result['subject_name']; ?></span>
              </button>
            </li>
          <?php } ?>
        </ul>
        <div class="tab-content">
          <?php
          mysqli_data_seek($subject_result, 0); // Reset pointer to the start of the result set
          while ($fetched_subject_data = mysqli_fetch_assoc($subject_result)) { ?>
            <div class="tab-pane fade show active" id="subject_<?php echo $fetched_subject_data['subject_id']; ?>" role="tabpanel">
              <!-- form starts here -->
              <div class="p-3">
                <h5 class="card-header mb-4"><?php echo $fetched_subject_data['subject_name']; ?></h5>
                <!-- Hoverable Table rows -->
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Student Name</th>
                          <th>Exams Name</th>
                          <th>Subject Name</th>
                          <th>Score</th>
                          <th>Grade</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // mysqli_data_seek($exams_result, 0); // Reset pointer to the start of the result set
                        while ($row = mysqli_fetch_assoc($exams_result)) {
                          if ($row['subject_name'] == $fetched_subject_data['subject_name']) {
                        ?>
                            <tr>
                              <td>
                                <div class="flex-row align-items-center ms-auto ">
                                  <span class="fw-medium">
                                    <img src="../images/student_pictures/<?php echo $row['images']; ?>" alt="Avatar" class="rounded-circle avatar avatar-xd me-3" />
                                    <span class="fw-medium"> <?php echo $row['surname']  . ' ' . $row['firstname'];  ?></span>
                                  </span>
                                </div>
                              </td>
                              <td>
                                <div class="flex-row align-items-center ms-auto ">
                                  <?php echo $row['exams_name'] ?>
                                  </span>
                                </div>
                              </td>
                              <td>
                                <div class="flex-row align-items-center ms-auto ">
                                  <span class="fw-medium">
                                    <span class="fw-medium"><?php echo $row['subject_name']; ?>
                                    </span>
                                </div>
                              </td>
                              <td>
                                <div class="flex-row align-items-center ms-auto ">
                                  <span class="fw-medium">
                                    <?php echo $row['exams_score']; ?>
                                  </span>
                                </div>
                              </td>
                              <td>
                                <div class="flex-row align-items-center ms-auto ">
                                  <span class="fw-medium">
                                    <?php echo $row['exams_grade']; ?>
                                  </span>
                                </div>
                              </td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!--/ Hoverable Table rows -->
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content wrapper -->
<?php include "../private/shared/footer.php"; ?>




