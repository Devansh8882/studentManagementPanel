<?php include 'include/header.php'; ?>
<div class="dashboard-container">
  <h2 class="page-title">Dashboard Overview</h2>
  <div class="dashboard-cards">

    <div class="card fade-in">
      <h3>Total Students</h3>
      <p class="stat-number" id="totalStudents">1</p>
    </div>

    <div class="card fade-in">
      <h3>Enrolled Students</h3>
      <p class="stat-number" id="enrolledStudents">1</p>
    </div>

    <div class="card fade-in">
      <h3>Revenue Generated</h3>
      <p class="stat-number" id="revenueGenerated">$1800</p>
    </div>

    <div class="card fade-in">
      <h3>Date & Time</h3>
      <p id="dateTime"></p>
    </div>

  </div>

  <div class="notice fade-in">
    <h3>Notice Board</h3>
    <p>New semester enrollment starts next week. Please update student data before Friday.</p>
  </div>
</div>

<?php include 'include/footer.php'; ?>
<script>
  // Live Date and Time
  function updateDateTime() {
    const now = new Date();
    const formatted = now.toLocaleString();
    $('#dateTime').text(formatted);
  }

  $(document).ready(function() {
    updateDateTime();
    setInterval(updateDateTime, 1000); 
  });
</script>

