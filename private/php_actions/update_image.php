<?php
include("../private/initialize.php");

// Update image starts here

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
          if ($file_size < 100000000000000000000) {
              $file_new_name = uniqid('') . "." . $file_extension;
              $file_directory = '../images/student_pictures/' . $file_new_name;

              $query_command = "UPDATE student SET images = ? WHERE student_id = ?";
              $statement = mysqli_prepare($database_connection, $query_command);
              mysqli_stmt_bind_param($statement, 'si', $file_new_name, $student_id);

              if (mysqli_stmt_execute($statement))
                  echo 'image updated';
              move_uploaded_file($file_temp, $file_directory);
          } else {
              mysqli_error($database_connection);
          }
      } else {
          echo "file too too big";
      }
  } else {
      echo "file size too big";
  }
}