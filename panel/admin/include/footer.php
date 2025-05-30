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

  $(document).on('click', '.open-status-modal', function () {

    currentBadge = $(this); // store reference
    console.log("current badge",currentBadge.parent().parent().find("#del").data("pid"));
    
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
    const page = $(this).data("page");  
    const id = currentBadge.parent().parent().find("#del").data("pid")

    console.log("status from page --> ", page);
    
    $('#statusModal').fadeOut();

    if (currentBadge) {
      currentBadge
        .removeClass('active pending inactive')
        .addClass(LEADSTATUS[newStatus])
        .text(LEADSTATUSMSG[newStatus])
        .data('status', newStatus);

        $.ajax({
              url: 'http://localhost:3000/v1/statusUpdate', 
              type: 'POST',          
              data: { "id":id,"page":page,"status":newStatus},
              dataType: 'json',         
              success: function(res) {
              
                console.log('Response:', res);
              
                if(res.status == "success"){
                  
                      $("#errorPopup").html(` <div class="toast success-toast show"> <span class="toast-message">${res.message}</span>
                                                                <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);
                                                                
                      // printLeads();

                    setTimeout(() => {
                      $(".toast").removeClass("show").remove("toast");
                    }, 1000);
                  }else{
                    $("#errorPopup").html(` <div class="toast error-toast show"> <span class="toast-message">${res.message} </span>
                                                                <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);

                    setTimeout(() => {
                      $(".toast").removeClass("show").remove("toast");
                    }, 1000);
                  }
                },
              error: function(xhr, status, error) {

                console.error('Error Caught in status update:', error);
              }
          });
    }
  });


</script>

</body>
</html>
