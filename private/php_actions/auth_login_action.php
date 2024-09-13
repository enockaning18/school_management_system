<?php
include("../initialize.php");
include("../shared/bootstrap-script.php");

if (isset($_POST['auth_register'])) {
    // Generate a random 7-digit number
    $admin_id = str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query_command = "INSERT INTO admin(admin_id, email, password, username) VALUES(?, ?,?,?)";
    $statement = mysqli_prepare($database_connection, $query_command);
    mysqli_stmt_bind_param($statement, 'ssss', $admin_id, $email, $password, $username);
    if (mysqli_stmt_execute($statement)) {
        header('Location: ../../public/index.php');
    } else {
        echo "Error " . mysqli_stmt_error($statement);
    }
}

if (isset($_POST['auth_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query_command = "SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $result = mysqli_query($database_connection, $query_command);
    $fetched_admin = mysqli_fetch_assoc($result);
    if ($fetched_admin > 1) {
        $_SESSION["login"] = true;
        $_SESSION['admin_id'] = $fetched_admin["admin_id"];
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: 'Login Successfull.',                
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../../public/index.php';                
            });
        });
      </script>";
        // header('Location: ../../public/index.php');
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Unable to sign in check username and password.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../../public/auth_login.php';                
                    });
                });
              </script>";
        // header('Location: ../../public/auth_login.php');
    }
}
