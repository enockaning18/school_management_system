<?php
include("../initialize.php");




////////////add student code starts here ////////////////
if (isset($_POST['add_student'])) {

  // Generate a random 7-digit number
  $student_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

  $surname = $_POST['surname'];
  $othername = $_POST['othername'];
  $firstname = $_POST['firstname'];
  $dateofbirth = $_POST['date'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $address = $_POST['address'];
  $age = $_POST['age'];
  $nationality = $_POST['nationality'];
  $language = $_POST['language'];
  $class_id = $_POST['class_id'];

  $file = $_FILES['image'];
  $file_name = $_FILES['image']['name'];
  $file_size = $_FILES['image']['size'];
  $file_temp = $_FILES['image']['tmp_name'];
  $file_error = $_FILES['image']['error'];

  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_own_extension = strtolower($file_extension);
  $extension_allowed = array('jpg', 'png', 'jpeg', 'heic','svg', 'webp', 'bmp','tiff', 'ico');

  if (in_array($file_own_extension, $extension_allowed)) {
    if ($file_error === 0) {
      if ($file_size < 1000000000000) {
        $file_new_name = uniqid('') . "." . $file_extension;
        $file_directory = '../../images/student_pictures/' . $file_new_name;


        $query_command = "INSERT INTO student(student_id, surname, othername, firstname, dateofbirth, email, phonenumber, address, age, nationality, language, images, class_id) VALUES(?, ?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, 'isssssssssssi', $student_id, $surname, $othername, $firstname, $dateofbirth, $email, $phonenumber, $address, $age, $nationality, $language, $file_new_name, $class_id);
        if (mysqli_stmt_execute($statement)) {
          move_uploaded_file($file_temp, $file_directory);
          header("Location: ../../public/student.php");
        } else {
          echo "Error " . mysqli_stmt_error($statement);
        }
      } else {
        echo 'File size too big';
      }
    } else {
      echo 'There was an error uploading your file';
    }
  } else {
    echo "Extension now allowed";
  }
}
////////////add student code ends here ////////////////















////////////update student code starts here ////////////////
if (isset($_POST['update_student'])) {
  $get_fields['student_id'] = $student_id;
  $get_fields['age'] = $_POST['age'];
  $get_fields['email'] = $_POST['email'];
  $get_fields['surname'] = $_POST['surname'];
  $get_fields['othername'] = $_POST['othername'];
  $get_fields['firstname'] = $_POST['firstname'];
  $get_fields['dateofbirth'] = $_POST['dateofbirth'];
  $get_fields['phonenumber'] = $_POST['phonenumber'];
  $get_fields['address'] = $_POST['address'];
  $get_fields['nationality'] = $_POST['nationality'];
  $get_fields['language'] = $_POST['language'];

  $query_command = "UPDATE student SET ";
  $query_command .= "surname = '" . $get_fields['surname'] . "',";
  $query_command .= "othername = '" . $get_fields['othername'] . "',";
  $query_command .= "firstname = '" . $get_fields['firstname'] . "',";
  $query_command .= "dateofbirth = '" . $get_fields['dateofbirth'] . "',";
  $query_command .= "phonenumber = '" . $get_fields['phonenumber'] . "',";
  $query_command .= "address = '" . $get_fields['address'] . "',";
  $query_command .= "language = '" . $get_fields['language'] . "' ";
  $query_command .= " WHERE student_id = '" . $get_fields['student_id'] . "'";

  $result = mysqli_query($database_connection, $query_command);
  if ($result) {
    echo 'updated';
  } else {
    mysqli_error($database_connection);
  }
}

////////////update student code ends here ////////////////











//////////// delete student starts here ////////////

if (isset($_POST['delete_student'])) {
  $student_id;
  // $student_id = $fetch_result['student_id'];

  $query_command = "DELETE FROM student WHERE student_id = ?";
  $statement = mysqli_prepare($database_connection, $query_command);
  mysqli_stmt_bind_param($statement, 'i', $student_id);
  if (mysqli_stmt_execute($statement)) {
    // header("Location: ../../public/index.php");
  } else {
    echo "Error " . mysqli_stmt_error($statement);
  }
}
