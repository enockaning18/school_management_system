<?php

use LDAP\Result;

include("../private/initialize.php");
include(SHARED_PATH . "/navbar.php");
?>


<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">

    <div class="position-absolute top-50 start-50 translate-middle bs-toast toast fade show bg-danger  top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-medium">Notification</div>
        <small>0 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Student Deleted Successfully.
      </div>
    </div>



  </div>
</div>
<!-- Content wrapper -->




<?php
include(SHARED_PATH . "/footer.php");
