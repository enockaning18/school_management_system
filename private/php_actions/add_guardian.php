<?php
include("../private/initialize.php");


////////////assign guardian code starts here ////////////////

if (isset($_POST['add_guardian'])) {

  $surname = $_POST['surname'];
  $othername = $_POST['othername'];
  $firstname = $_POST['firstname'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $student_id = $_POST['student_id'];
  $relationship = $_POST['relationship'];

  $student_id = (int) $student_id; // You can also use intval($student_id) or settype($student_id, 'integer')
  $query_command = "INSERT INTO guardian (surname, othername, firstname, phone_number, email_address, relationship, student_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $statement = mysqli_prepare($database_connection, $query_command);

  mysqli_stmt_bind_param($statement, 'ssssssi', $surname, $othername, $firstname, $phone_number, $email, $relationship, $student_id);
  if (mysqli_stmt_execute($statement)) {
    // header("Location: student.php");

  } else {
    echo "Error " . mysqli_stmt_error($statement);
  }
  mysqli_stmt_close($statement);
  mysqli_close($database_connection);
}
////////////assign guardian code ends here ////////////////


