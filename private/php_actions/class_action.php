<?php
include("../initialize.php");

if (isset($_POST['add_class'])) {
    $classname = $_POST['classname'];
    $no_student = $_POST['no_students'];
    $subjects = $_POST['subjects'];

    // Generate a random 7-digit number
    $class_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

    // Check if file is uploaded
    $file_name = $_FILES['class_image']['name'];
    $file_size = $_FILES['class_image']['size'];
    $file_temp = $_FILES['class_image']['tmp_name'];
    $file_error = $_FILES['class_image']['error'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_own_extension = strtolower($file_extension);
    $extension_allowed = array('jpg', 'png', 'jpeg', 'heic','svg', 'webp', 'bmp','tiff', 'ico');


    if (in_array($file_own_extension, $extension_allowed)) {
        if ($file_error === 0) {
            if ($file_size < 1000000000000) {
                $file_new_name = uniqid('') . "." . $file_own_extension;
                $file_directory =  '../../images/class_pictures/' . $file_new_name;

                $query_command = "INSERT INTO class(class_id, class_name, no_student, subject, image) VALUES (?,?,?,?,?)";
                $statement = mysqli_prepare($database_connection, $query_command);
                mysqli_stmt_bind_param($statement, "issss", $class_id, $classname, $no_student, $subjects, $file_new_name);
                if (mysqli_stmt_execute($statement)) {
                    move_uploaded_file($file_temp, $file_directory);
                    echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New class added successfully.',
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






////////////update student code starts here ////////////////
if (isset($_POST['assign_teacher'])) {

    $teacher_id = $_POST['teacher'];
    $class = $_POST['class'];

    $query_command = "UPDATE Class SET ";
    $query_command .= "teachers_id = '" . $teacher_id . "' ";
    $query_command .= "WHERE class_id = '" . $class . "'";
    $result = mysqli_query($database_connection, $query_command);

    if ($result) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'New teacher assigned.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        
                    });
                });
              </script>";
    } else {
        echo $query_command;
        echo mysqli_error($database_connection);
    }
}
