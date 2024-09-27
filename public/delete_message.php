<?php

use LDAP\Result;

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");

if (!empty($_SESSION["admin_id"])) { ?>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <?php
      echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          title: 'Success ✅!',
                          text: 'Successfully Deleted!.',
                          icon: 'success',
                          confirmButtonText: 'OK'
                      }).then(function() {
                        window.location.href = 'index.php'
                      });
                  });
                </script>" ?>


    </div>
  </div>
  <!-- Content wrapper -->
<?php } else {
  header("Location: auth_login.php");
  exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>








<?php
include(SHARED_PATH . "/footer.php");
