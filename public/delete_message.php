<?php

use LDAP\Result;

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");
?>


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
              </script>"
    ?>


  </div>
</div>
<!-- Content wrapper -->




<?php
include(SHARED_PATH . "/footer.php");
