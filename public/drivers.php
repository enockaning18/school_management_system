<?php include "../private/shared/navbar.php";
if (!empty($_SESSION["admin_id"])) {

?>
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">







    </div>
  </div>
  <!-- Content wrapper -->
<?php } else {
  header("Location: auth_login.php");
  exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>


<?php include "../private/shared/footer.php"; ?>