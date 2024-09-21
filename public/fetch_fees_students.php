<?php
include("../private/initialize.php");

if(isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];

    $query_command = " SELECT student_id, student.surname, student.othername, student.firstname ";
    $query_command .=" FROM student where class_id = ? ";
    $statement = mysqli_prepare($database_connection, $query_command);
    mysqli_stmt_bind_param($statement, 'i', $class_id);
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


