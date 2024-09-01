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
        mysqli_stmt_bind_param($statement, "sssssssss", $firstname, $lastname, $email, $new_phone, $address, $age, $nationality, $file_new_name, $language);
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