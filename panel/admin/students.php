<?php include 'include/header.php'; 

      $LEADSTATUSMSG = [
           "No Calls Made",
           "Interested",
           "Not Interested",
           "Enrolled",
      ];
       $LEADSTATUS = [
            "pending",
            "pending",
            "inactive",
            "active",
      ]

?>
<div class="content">
  <h2 class="page-title">All Students</h2>

  <div class="table-header">
    <button id="openFilterModal" class="btn filter-btn">🔍 Filter</button>
  </div>
 
  <table class="student-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile No</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Program</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <!-- Sample data row (replace with PHP/MySQL loop in real use) -->
      <tr>
        <td>1</td>
        <td>Alice Johnson</td>
        <td>alice@example.com</td>
        <td>9876543210</td>
        <td>New York, NY</td>
        <td>Female</td>
        <td>B.Tech</td>
        <td>
        <span class="status-badge active open-status-modal" data-status="active">  <!--- res.leads[lead].status // add this to your code --->
            Active
        </span>
        </td>

      </tr>
      <!-- Add more rows here -->
    </tbody>
  </table>

  <div class="pagination">
    <button class="page-btn">Prev</button>
    <span class="page-number">1</span>
    <!-- <span class="page-number">2</span>
    <span class="page-number">3</span> -->
    <button class="page-btn">Next</button>
  </div>
</div>

<div id="statusModal" class="status-modal" style="display:none">
  <div class="modal-content">
    <h3>Change Student Status</h3>
    <select id="statusSelect" class="input">
      <?php 
      foreach ($LEADSTATUSMSG as $x=>$y) {
       
            echo "<option value='$LEADSTATUS[$x]'>$y</option>";

      }
     

      ?>
    </select>
    <div class="modal-actions">
      <button id="confirmStatusChange" class="submit-btn">Change Status</button>
      <button id="closeModal" class="btn nav-btn">Cancel</button>
    </div>
  </div>
</div>


<!-- Filter Modal -->
<div id="filterModal" class="modal-overlay">
  <div class="modal-box">
    <span class="close-btn">&times;</span>
    <h2><i class="fas fa-filter"></i> Filter</h2>

      <!-- 🔴 Error message div added below heading -->
      <div id="filterError" class="error-message" style="display: none; color: red; margin-bottom: 10px;">
    
    </div>

    <form id="filterForm">
      <!-- Row 1 -->
      <div class="form-row">
      <input type="email" id = "email" placeholder="Serach Email ">
       
      </div>
     
      <!-- Row 2 -->
      <div class="form-row">
        <input type="text" id = "name" placeholder="Search Name">
        <select id = "gndr">
          <option value="" selected disabled >Select a Gender</option>
          <option value="M">Male</option>
          <option value="F">Female</option>
        </select>
      </div>
    

      <!-- Row 3 -->
      <div class="form-row">
        <input type="text" id = "phone" placeholder="Moblie No">
        <select id="program" >
            <option value="" selected disabled>Select a Program</option>
            <option value="cs">Computer Science</option>
            <option value="ba">Business Administration</option>
            <option value="eng">Engineering</option>
        </select>
      </div>
      

      <div class="action-buttons">
        <button type="button" class="btn-secondary closeFilter">Close</button>
        <button type="submit" class="btn-primary">Search</button>
      </div>
    </form>
  </div>
</div>
<!-- Filter Model  -->

<!-- Delete Model -->
 <div id="deleteModal" class="modal-overlay">
  <div class="modal-box">
    <span class="close-btn">&times;</span>
    <h2><i class="fas fa-filter"></i> Delete Confirmation</h2>

      <!-- 🔴 Error message div added below heading -->
      <div id="filterError" class="error-message" style="display: show; margin-bottom: 10px;">
        Are you sure you want to delete this item?<br> This action cannot be undone.
    </div>

      <div class="action-buttons">
              <button type="button" class="btn-secondary closeFilter">Close</button>
              <button type="submit" id = "del-conf" class="btn-primary">Yes,Delete</button>
      </div>
  </div>
</div>
<!-- Delete Model -->



<?php include 'include/footer.php'; ?>
<script>
  $(document).ready(function(){
    
   

   const subARR = {
        cs : 'Computer Science',
        ba: 'Business Administration',
        eng : 'Engineering',
      }
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

      $('#openFilterModal').click(function () {
      $('#filterModal').fadeIn(150);
    });

   $('.close-btn, .closeFilter').click(function () {
      $('#filterModal').fadeOut(150);
      $("#deleteModal").fadeOut(150);
    });
        $(document).on("click","#del",function(){
      $("#deleteModal").fadeIn(150  );
    })
     $("#del-conf").on("click",function(){
      const id = $("#del").data("pid");
      console.log("confirm delete -->");
      
       $.ajax({
            url: 'http://localhost:3000/v1/delete',     // URL to send the request to
            type: 'POST',                 // or 'GET'
            data: {"id":id},
            success: function(res) {
              // Code to run on successful res
              console.log(res);
              let printDataList = '';
                   
              if(res.status == "success"){
              
                  $("#errorPopup").html(` <div class="toast success-toast show"> <span class="toast-message">${res.message}</span>
                                                            <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);
                                                            
                  printLeads();

                setTimeout(() => {
                  $(".toast").removeClass("show").remove("toast");
                }, 3000);
              }else{
                $("#errorPopup").html(` <div class="toast error-toast show"> <span class="toast-message">${res.message} </span>
                                                            <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);

                setTimeout(() => {
                  $(".toast").removeClass("show").remove("toast");
                }, 3000);
              }
               $('#deleteModal').fadeOut(150);
            },
            error: function(xhr, status, error) {
              // Code to run on error
              console.error('Error:', error);
            }
          });

          // $("#")
    })     
  
  })

</script>
