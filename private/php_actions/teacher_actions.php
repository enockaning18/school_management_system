<?php
include("../initialize.php");




if (isset($_POST['add_teacher'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $phone = $_POST['phonenumber'];
  $address = $_POST['address'];
  $age = $_POST['age'];
  $nationality = $_POST["nationality"];
  $language = $_POST['language'];
  $file = $_FILES['image'];
  // Generate a random 7-digit number
  $student_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
  // Check if file is uploaded
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
        $file_new_name = uniqid('') . "." . $file_own_extension;
        $file_directory =  '../../images/teachers_pictures/' . $file_new_name;

        $query_command = "INSERT INTO teachers (teachers_id, first_name, last_name, email, phone, address, age, nationality, images, language) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($database_connection, $query_command);
        mysqli_stmt_bind_param($statement, "isssssssss", $student_id, $firstname, $lastname, $email, $phone, $address, $age, $nationality, $file_new_name, $language);
        if (mysqli_stmt_execute($statement)) {
          move_uploaded_file($file_temp, $file_directory);
          echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New teacher added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        
                    });
                });
              </script>";
        } else {
          echo "Error " . mysqli_stmt_error($statement);
        }
      } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'File size too big.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        
                    });
                });
        </script>";
      }
    } else {
      echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Success!',
              text: 'There was an error uploading file.',
              icon: 'error',
              confirmButtonText: 'Retry'
          }).then(function() {
              
          });
      });
      </script>";
    }
  } else {
    echo "<script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              title: 'Success!',
              text: 'File extension not supported.',
              icon: 'error',
              confirmButtonText: 'Retry'
          }).then(function() {
              
          });
      });
      </script>";
  }
}

////////////add teachers code ends here ////////////////