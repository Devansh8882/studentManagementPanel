<?php include 'include/header.php'; ?>
<div class="content">
  <h2 class="page-title">All Students</h2>

  <div class="table-header">
    <button id="filterBtn" class="btn filter-btn">Filter</button>
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
        <span class="status-badge active open-status-modal" data-id="1" data-status="active">
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
      <option value="active">Active</option>
      <option value="pending">Pending</option>
      <option value="inactive">Inactive</option>
    </select>
    <div class="modal-actions">
      <button id="confirmStatusChange" class="submit-btn">Change Status</button>
      <button id="closeModal" class="btn nav-btn">Cancel</button>
    </div>
  </div>
</div>


<?php include 'include/footer.php'; ?>
<script>
  
  $('#filterBtn').click(function () {
    alert("Filter functionality to be implemented.");
  });
</script>
