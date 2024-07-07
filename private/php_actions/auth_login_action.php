<?php
include("../initialize.php");


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

    // // Validations
    // if (!isset($username) || trim($username) === '') {
    //     $errors[] = "Username cannot be blank.";
    // }
    // if (!isset($password) || trim($password) === '') {
    //     $errors[] = "Password cannot be blank.";
    // }

    // if there were no errors, try to login
    // if (empty($errors)) {
    // Using one variable ensures that msg is the same

    $query_command = "SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $result = mysqli_query($database_connection, $query_command);
    $fetched_username = mysqli_fetch_assoc($result);
    if ($fetched_username > 1) {
        session_regenerate_id();
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['last_login'] = time();
        $_SESSION['username'] = $admin['username'];
        
        header('Location: ../../public/index.php');
    } else {
        header('Location: ../../public/auth_login.php');
    }
}
