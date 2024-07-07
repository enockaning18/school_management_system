<?php
include("../initialize.php");

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
                        window.location = '../../public/subject.php'; // Redirect to subject list page after alert
                    });
                });
              </script>";
    } else {
        echo mysqli_error($database_connection);
    }
}
?>