<?php
include("../private/initialize.php");

if(isset($_POST['exams_code'])) {
    $exams_code = $_POST['exams_code'];

    $query_command = "SELECT student.student_id, student.surname, student.othername, student.firstname, student.class_id ";
    $query_command .=" FROM student ";
    $query_command .=" JOIN subject ON student.class_id = subject.class_id ";
    $query_command .=" JOIN exams ON subject.subject_id = exams.subject_id ";
    $query_command .= " WHERE exams.exams_code = ? ";
    $statement = mysqli_prepare($database_connection, $query_command);
    mysqli_stmt_bind_param($statement, 'i', $exams_code);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    $students = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }

    echo json_encode($students);
}
mysqli_close($database_connection);
?>
