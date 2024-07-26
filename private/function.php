<?php
function url_for($script_path)
{
    // add the leading '/' if not present
    if ($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

session_start();

function is_logged_in()
{
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']);
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function require_login()
{
    if (!is_logged_in()) {
        ('Location: ../../public/auth_login.php');
    } else {
        // Do nothing, let the rest of the page proceed
    }
}

function log_out_admin() {
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    // session_destroy(); // optional: destroys the whole session
    return true;
  }
