<script src="../bootstrap-config/sweetalert2/jquery-3.7.1.min.js"></script>
<script src="../bootstrap-config/sweetalert2/sweetalert2.all.min.js"></script>

<script type="text/javascript">
  function payWithPaystack() {
    var handler = PaystackPop.setup({
      key: 'pk_live_1331391d9362adc096ed00e574cd590fcc024896', // Replace with your Paystack public key
      email: document.getElementById('email_address').value,
      amount: document.getElementById('amount_payed').value * 100, // Amount in kobo
      currency: "GHS",
      ref: 'PSK_' + Math.floor((Math.random() * 1000000000) + 1), // Generate a random reference
      callback: function(response) {
        let message = 'Payment was complete: ' + response.reference;
        alert(message);
        window.location.href = "http://localhost/1111/private/verify.php?reference=" + response.reference;
      
      },
      onClose: function() {
        Swal.fire({
          title: 'Error!',
          text: 'Transaction Cancelled',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    });
    handler.openIframe();
  }

  function verifyTransaction(reference) {
    // Prepare data to send to the server
    var data = {
      payment_id: reference,
      student_id: document.getElementById('student_id').value,
      fee_id: document.getElementById('fee_id').value,
      amount_payed: document.getElementById('amount_payed').value,
      payment_method: 'Paystack',
      payment_date: new Date().toISOString()
    };

    // Send data to server for verification and database update using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "verify_payment.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.status === 'success') {
          Swal.fire({
            title: 'Success!',
            text: 'Payment verified and recorded successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: 'Payment verification failed. Please contact support.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }
    };
    xhr.send(JSON.stringify(data));
  }
</script>