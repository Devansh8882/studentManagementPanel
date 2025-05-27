<!-- footer.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Example: you can extend this
    $(document).ready(function() {
      console.log("jQuery ready!");
        
    });

    
  </script>
 <script>
  let currentBadge = null;

  $(document).on('click', '.open-status-modal', function () {

     const LEADSTATUSMSG = {
          0: "No Calls Made",
          1: "Interested",
          2: "Not Interested",
          3: "Enrolled",
      };
      const LEADSTATUS = {
        0:"pending",
        1:"pending",
        2:"inactive",
        3:"active",
      }

      
    currentBadge = $(this); // store reference
    const currentStatus = currentBadge.data('status');
    $('#statusSelect').val(currentStatus);
    $('#statusModal').fadeIn();
  });

  $('#closeModal').on('click', function () {
    $('#statusModal').fadeOut();
    $('#statusModal').css('display', 'flex');

  });

  $('#confirmStatusChange').on('click', function () {
    const newStatus = $('#statusSelect').val();
    if (currentBadge) {
      currentBadge
        .removeClass('active pending inactive')
        .addClass(newStatus)
        .text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1))
        .data('status', newStatus);
    }
    $('#statusModal').fadeOut();
  });


  $("#process").on("click",function(){
    console.log("process button clicked...!!");
    
  })
</script>

</body>
</html>
