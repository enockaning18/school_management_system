<?php
include "../private/initialize.php";
$_SESSION = [];
session_unset();
session_destroy();
header("Location: auth_login.php");
