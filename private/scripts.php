<script src="../bootstrap-config/sweetalert2/jquery-3.7.1.min.js"></script>
<script src="../bootstrap-config/sweetalert2/sweetalert2.all.min.js"></script>

<script type="text/javascript">
  function payWithPaystack() {
    var handler = PaystackPop.setup({
      key: 'pk_test_edd00935ae2ac1c00884bf695e188e7084d8b93c', // Replace with your Paystack public key
      email: document.getElementById('email_address').value,
      amount: document.getElementById('amount_payed').value * 100, // Amount in kobo
      currency: "GHS",
      ref: 'PSK_' + Math.floor((Math.random() * 1000000000) + 1), // Generate a random reference
      callback: function(response) {
        // Payment successful
        // You can verify the transaction with your server here      
        alert('Payment successful. Transaction reference: ' + response.reference);
        // Prepare data to send to the server
        var data = {
          payment_id: response.reference,
          student_id: document.getElementById('student_id').value,
          fee_id: document.getElementById('fee_id').value,
          amount_payed: document.getElementById('amount_payed').value,
          payment_method: 'Paystack',
          payment_date: new Date().toISOString()
        };

        // Send data to server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../public/pay_fees.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('Server response:', xhr.responseText);
          }
        };
        xhr.send(JSON.stringify(data));
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
</script>