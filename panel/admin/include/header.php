<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>College Admin Panel</title>
  <link rel="stylesheet" href="adminStyle.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-left">
      <img src="../../images/logo.png" alt="College Logo" class="logo" />
      <span class="college-name">Northwell Institute of Technology..</span>
    </div>
    <div class="navbar-right">
     <a href="../login.php" class="btn logout-btn">  <i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </nav>
  <div class="nav-buttons">
    <a href="dashboard.php" class="btn nav-btn"> <i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="students.php" class="btn nav-btn"> <i class="fas fa-users"></i> All Students</a>
    <a href="add-student.php" class="btn nav-btn"> <i class="fa-solid fa-user-plus"></i> Add Student</a>
    <a href="leads-students.php" class="btn nav-btn"><i class="fa-solid fa-headset"></i> Leads</a>
  </div>



<!-- Toast Notification -->
 <div id = "errorPopup">
     <!-- <div class="toast success-toast show">
       <span class="toast-message">✔️ Operation successful!</span>
      <button class="toast-close"><i class="fas fa-times"></i></button>
     </div> -->
     
     <!-- <div class="toast error-toast "> -->
       <!-- <span class="toast-message">❌ Something went wrong!</span>
      <button class="toast-close"><i class="fas fa-times"></i></button> -->
     <!-- </div> -->
 </div>

