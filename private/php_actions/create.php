<?php
include("../private/initialize.php");


////////////add teachers code starts here ////////////////

if (isset($_POST['add_teacher'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phonenumber'];
  $new_phone = $country_code . $phone;
  $address = $_POST['address'];
  $age = $_POST['age'];
  $nationality = $_POST["nationality"];
  $language = $_POST['language'];
  $file = $_FILES['image'];
  // Check if file is uploaded
  $file_name = $_FILES['image']['name'];
  $file_size = $_FILES['image']['size'];
  $file_temp = $_FILES['image']['tmp_name'];
  $file_error = $_FILES['image']['error'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_own_extension = strtolower($file_extension);
  $extension_allowed = array('jpg', 'png', 'jpeg', 'heic','svg', 'webp', 'bmp','tiff', 'ico');


  if (in_array($file_own_extension, $extension_allowed)) {
    if ($file_error === 1) {
      if ($file_size < 1000000000000) {
        $file_new_name = uniqid('') . "." . $file_own_extension;
        $file_directory =  '../images/teachers_pictures/' . $file_new_name;
        move_uploaded_file($file_temp, $file_directory);

        $query_command = "INSERT INTO teachers (first_name, last_name, email, phone, address, age, nationality, images, language) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, "isssssssss", $student_id, $firstname, $lastname, $email, $new_phone, $address, $age, $nationality, $file_new_name, $language);
        if (mysqli_stmt_execute($statement)) {
          header('Location: teachers.php');
        } else {
          echo "Error " . mysqli_stmt_error($statement);
        }
      } else {
        echo "File size too big";
      }
    } else {
      echo "There was an error uploading file";
    }
  } else {
    echo "File extension not supported";
  }
}

////////////add teachers code ends here ////////////////






////////////add student code starts here ////////////////
if (isset($_POST['add_student'])) {
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
        $file_directory = '../images/student_pictures/' . $file_new_name;


        $query_command = "INSERT INTO student(surname, othername, firstname, dateofbirth, email, phonenumber, address, age, nationality, language, images) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, 'sssssssssss', $surname, $othername, $firstname, $dateofbirth, $email, $phonenumber, $address, $age, $nationality, $language, $file_new_name);
        if (mysqli_stmt_execute($statement)) {
          move_uploaded_file($file_temp, $file_directory);
          echo 'successfully added';
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








////////////update student image code starts here ////////////////
if (isset($_POST['update_image'])) {
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
        $file_directory = '../images/student_pictures/' . $file_new_name;

        $query_command = "UPDATE student SET images = '" . $get_fields['images'] . "' WHERE student_id = '" . $student_id . "'";
        $result = mysqli_query($database_connection, $query_command);
        if ($result) {
          echo 'image updatetd';
        } else {
          mysqli_error($database_connection);
        }
      }
    } else {
      echo "file size too big";
    }
  } else {
    echo "There was an error uploading this picture";
  }
} else {
  echo "File extension not supported";
}
////////////update student image code ends here ////////////////
