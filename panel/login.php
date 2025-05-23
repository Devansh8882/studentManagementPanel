<?php
$page_title = "NIT Admin Login";
$body_class = "auth-page";
include 'includes/header.php';
?>

<!-- Only shows branding (no nav) -->
<div class="auth-container">
    <!-- ... login form ... -->
</div>

<body class="login-page" style="position:fixed">
    <!-- Background Blur Effect -->
    <div class="login-bg"></div>

    <div class="text-center mb-4 " >
       <div style="display:flex ; justify-content: center; background:white ; width:100% ">
           <img src="../images/logo.png" alt="NIT Logo" class="login-logo">
            <div style="display:grid">
                <h1 style="margin:1px">Northwell Institute of Technology.</h1>
                <p class="text-muted" >...Excellence in Education Since 2020...</p>
            </div>
        </div>
    </div>
    <main class="login-container" style="margin-top: 25%; margin-left: 90%">
        <!-- College Branding -->

        <!-- Error Popup -->
        <div class="error-popup" id="errorPopup">
            ❌ Something went wrong!
        </div>
        <!-- Error Popup -->
   
        <!-- Login Card -->
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <h2 class="card-title">Sign In</h2>
            
            <form id="loginForm">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input style='margin-right: -22px' type="email" id="email" placeholder="admin@nit.edu" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div style="display:flex ; width:auto">
                        <input type="password" id="pass" placeholder="••••••••" required>
                        <i id="show-btn" class="fa-solid fa-eye" style="font-size: 24px; margin-top: 10px ; margin-left: 7px ; margin-right: -22px;"></i>
                    </div>
                    <!-- <div class="show-password-toggle">
                        <label for="showPassword"> Show Password</label>
                        <input type="checkbox" id="showPassword"> 
                    </div> -->
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </main>

    <!-- Scripts -->
    <?php include "includes/footer.php";?>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/login.js"></script>
</body>
</html>