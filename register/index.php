<?php include 'header.php';?>
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content" >
        <h1>Welcome to Northwell Institute of Technology </h1>
        <p>Shaping futures through quality education</p>
        <a href="#registration" class="cta-button">Start Your Application</a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section">
    <h2 style= "color:#ff6600">About Our College</h2>
    <div class="about-content">
        <img src="../images/entry.jpeg" alt="College Campus">
        <div class="about-text">
            <p>Founded in 2020, NIT College has been a pioneer in providing quality education to students from diverse backgrounds. Our mission is to empower students with knowledge and skills to succeed in their careers.</p>
            <p>With state-of-the-art facilities and experienced faculty, we create an environment conducive to learning and personal growth.</p>
            <!-- <a href="about.php" class="read-more">Learn More</a> -->
        </div>
    </div>
</section>

<!-- Academics Section -->
<section id="academics" class="section">
    <h2 style= "color:#ff6600">Academic Programs</h2>
    <div class="programs-grid">
        <div class="program-card">
            <i class="fas fa-laptop-code"></i>
            <h3>Computer Science</h3>
            <p>4-year degree program with specialization options</p>
        </div>
        <div class="program-card">
            <i class="fas fa-briefcase"></i>
            <h3>Business Administration</h3>
            <p>Comprehensive business education with real-world applications</p>
        </div>
        <div class="program-card">
            <i class="fas fa-flask"></i>
            <h3>Engineering</h3>
            <p>Hands-on engineering programs with industry partnerships</p>
        </div>
    </div>
    <!-- <a href="programs.html" class="view-all">View All Programs</a> -->
</section>

<!-- Registration Section -->
<section id="registration" class="section">
    <h2 style= "color:#ff6600 ">Registration</h2>
    <div class="registration-form">
        <h3>Begin Your Application</h3>
        <form id="std-form">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input placeholder = "Enter Your Name" type="text" id="name" >
            </div>
            <div class="form-group" >
                <label for="email">Email</label>
                <div style ="display : flex">
                    <input type="email" id="email" placeholder="Enter your email" >
                    <button id="vld-otp" type="button" class="verify-btn">Verify</button>
                    <span id="verify-tick" style="display:none"><i class="fas fa-check verified-icon"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="otp">OTP</label>
                <input placeholder = "Enter OTP" type="text" id="otp" >
            </div>
            <div class="form-group">
                <label for="phone">Phone No</label>
                <input placeholder = "Enter Your Phone No." type="text" id="phone" >
            </div>
            <div class="form-group">
                <label for="adrs">Address</label>
                <input placeholder = "Enter Your Address" type="text" id="adrs" >
            </div>
            <div class="form-group ">
                <label class="gender-label">Gender:</label>
                <div class="gender-options">
                    <label class="gender-option">Male</label>
                    <input type="radio" name="gender" value="M">

                    <label class="gender-option">Female</label>
                    <input type="radio" name="gender" value="F">
                </div>
            </div>
            <div class="form-group">
                <label for="program">Program of Interest</label>
                <select id="program" >
                    <option value="" selected disabled>Select a program</option>
                    <option value="cs">Computer Science</option>
                    <option value="ba">Business Administration</option>
                    <option value="eng">Engineering</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">Submit Application</button>
        </form>
       
    </div>
</section>

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

<?php include "footer.php"?>
<script>
    const subARR = ["cs","ba","eng"]
    let orgOtp = 12345;
    $(document).ready(function() {
    //     // Form submission
    //     $('#app-form').submit(function(e) {
    //         e.preventDefault();
            
    //         // Generate random ticket number
    //         const ticketNum = 'NIT-' + Math.floor(100000 + Math.random() * 900000);
            
    //         // Display ticket
    //         $('#ticket-number').text(ticketNum);
    //         $('#app-form').hide();
    //         $('#ticket-display').show();
            
    //         // In a real application, you would send this data to your server
    //         // and the admin panel would access it from there
    //         console.log('Application submitted:', {
    //             name: $('#fullname').val(),
    //             email: $('#email').val(),
    //             program: $('#program').val(),
    //             ticket: ticketNum
    //         });
    //     });
        $("#otp").on("input",function(){
           let userOtp =  Number($(this).val()) || "";
           error = false ;
           msg = "";
           if(userOtp != "" && orgOtp == userOtp ) {
            $("#verify-tick").show();          

           }else{
            $("#verify-tick").hide();  
           }

        })
        $("#email").on("input",function(){
            $("#vld-otp").prop("disabled",false);
        })

        $("#vld-otp").on("click",function(){

            console.log("in function");

            let email = $("#email").val() || "";
            error = false;
            msg = "";
            const emailPtrn = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if(!emailPtrn.test(email)){
                error = true;
                msg = "Invalid Email";
            }
            if(email == ""){
                error = true;
                msg = "Please Provide The email";
            }
            if(error == true){
                $("#errorPopup").html(` <div class="toast error-toast show"> <span class="toast-message">❌ ${msg}!</span>
                                                                <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);

                setTimeout(() => {
                $(".toast").removeClass("show").remove("toast");
             }, 3000);
             
            }
            if(error == false){
                console.log("this-->",$(this));

                orgOtp = generateOTP();

                $.ajax({
                    url: 'http://localhost:3000/v1/sendOTP',
                    type: 'POST',
                    data: {"email":email,"otp":orgOtp},
                    success: function(res) {
                       if(res.status == "success"){
                        $(this).prop("disabled",true);
                        $("#errorPopup").html(` <div class="toast success-toast show">
                                                <span class="toast-message">✔️ ${res.message}</span>    
                                                <button class="toast-close"><i class="fas fa-times"></i></button>
                                                </div>`); 

                        $("#vld-otp").prop("disabled",true);
                       }else{
                        $("#errorPopup").html(` <div class="toast error-toast show"> <span class="toast-message">❌ ${res.message}!</span>
                                                    <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);
             
                       }

                       setTimeout(() => {
                            $(".toast").removeClass("show").remove("toast");
                        }, 3000);
                    },
                    error: function(e) {
                        console.error('Error caught in api call: ', e);
                    }
                });
            
            }

            // setTimeout(() => {
            //     $(".toast").removeClass("show").remove("toast");
            //  }, 3000);
        })

        $("#std-form").submit(function(e) {
            e.preventDefault();
            console.log("form submit btn clicked...");
            let name = $("#name").val() || "";
            let email = $("#email").val() || "";
            let userOtp = $("#otp").val() || "";
            let phone = $("#phone").val() || "";
            let adrs = $("#adrs").val() || "";
            let gender =  $('input[name="gender"]:checked').val() || "";
            let program = $("#program").val() || "";
            const regexForName = /^[A-Za-z]+(?: [A-Za-z]+)?$/;
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            
            let error = false;
            let msg = ""; 

            console.log("name-->",name,"email-->",email,"otp-->",userOtp,"phone-->",phone,"length-->",phone.length,"adrs-->",adrs,"gender-->",gender,"program-->",program);
            
            // Validation...

            if(!regexForName.test(name)) {   
                error = true;
                msg = "Invalid Name..!!";
            }
            if(isNaN(Number(phone)) || phone.length != 10) {
                error = true;
                msg = "Invalid Phone No..!!";
            } 
            if(!emailRegex.test(email)){
                error = true;
                msg = "Invalid E-mail address..!!";
            } if( userOtp != orgOtp ){
                error = true;
                msg = "Invalid OTP..!!";
            }
            if(adrs.length > 30){
                error= true;
                msg = "Too Lengthy Address..!!"
            }
            if(gender != "M" && gender != "F"){
                error = true;
                msg = "Please Select a Gender..!!";
            }
            if(!name || !email || !userOtp || !phone || !adrs || !subARR.includes(program)){
                error = true;
                msg = "Please Fill All The Fields..!!";
            }

            // Validation Completed.....
            
            if(error == true){
                $("#errorPopup").addClass("show").html(`  <div class="toast error-toast show"> <span class="toast-message">❌ ${msg}</span>
                                                            <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);
                setTimeout(() => {
                    $(".toast").removeClass("show").remove("toast");
                }, 3000);

            }
            if(error == false){
                console.log("success");

console.log("name-->",name,"email-->",email,"phone-->",phone,"length-->",phone.length,"adrs-->",adrs,"gender-->",gender,"program-->",program);

                const STUDENTDATA ={
                    "name":name,
                    "email":email,
                    "address":adrs,
                    "phone":phone,
                    "gender":gender,
                    "program":program,
                } 
                $.ajax({
                url:"http://localhost:3000/v1/register",
                method:"POST",
                data:{"data":STUDENTDATA},
                success:function(res){
                    // alert(res.message);
                    $("#errorPopup").html(` <div class="toast success-toast show">
                                                <span class="toast-message">✔️ ${res.message}</span>    
                                                <button class="toast-close"><i class="fas fa-times"></i></button>
                                                </div>`); 

                                                           
                    setTimeout(() => {
                        $(".toast").removeClass("show").remove("toast");
                    }, 3000);
                },
                error:function(e){
                    console.log("error caugth while calling api-->",e);
                    
                    $("#errorPopup").addClass("show").html(`  <div class="toast error-toast show"> <span class="toast-message">❌ Something went wrong!</span>
                                                                <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);
           
                    setTimeout(() => {
                        $(".toast").removeClass("show").remove("toast");
                    }, 3000);
                }
    
            })
            }

           
            // setTimeout(() => {
            //     $(".toast").removeClass("show").remove("toast");
            //  }, 3000);
        })


        $(document).on("click",".toast-close",function() {
            console.log("remove btn clicked-->");
            console.log($(this).parent());
            
            
            $(this).parent().removeClass("show");
        })
    });

    function generateOTP(){
        return Math.floor(100000 + Math.random() * 900000);
    }
</script>