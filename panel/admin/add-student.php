<?php
 include 'include/header.php'; 
 ?>
<div class="content">
  <h2 class="page-title">Add New Student</h2>
  <div class="form-card">
    <form class="student-form">
      <div class="form-row">
        <div class="form-group">
          <label>Student Name</label>
          <input type="text" id = "name"class="input" placeholder="Enter full name"  />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id = "email"class="input" placeholder="Enter email"  />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Mobile Number</label>
          <input type="input" id = "phone"class="input" placeholder="Enter mobile number"  />
        </div>
        <div class="form-group">
          <label>Gender</label>
          <select id = "gndr"class="input" >
            <option value="" selected disabled>Select Gnder</option>
            <option value = "M">Male</option>
            <option value = "F">Female</option>
            <!-- <option>Other</option> -->
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label>Address</label>
          <textarea class="input" id="adrs" placeholder="Enter address" rows="3"></textarea>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Father's Name</label>
          <input type="text" id ="fn" class="input" placeholder="Enter father's name"  />
        </div>
        <div class="form-group">
          <label>Mother's Name</label>
          <input type="text" id ="mn" class="input" placeholder="Enter mother's name"  />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Highest Qualification</label>
          <input type="text" id ="hq" class="input" placeholder="E.g., 12th Pass, B.Tech"  />
        </div>
        <div class="form-group">
          <label>Program Enrolled</label>
          <select id = "program"class="input" >
            <option value="" selected disabled>Select a program</option>
                    <option value="cs">Computer Science</option>
                    <option value="ba">Business Administration</option>
                    <option value="eng">Engineering</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Is Enrolled?</label>
          <select id ="enroled" class="input" >
            <option value="" selected disabled>Select</option>
            <option value="3">Yes</option>
            <option value ="1">No</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <button type="submit" class="submit-btn">Submit</button>
      </div>
    </form>
  </div>
</div>


<?php include 'include/footer.php'; ?>
<script>
  $(document).ready(function(){
    const subARR = ["cs","ba","eng"]

    //  const queryString = window.location.search;
    // console.log("queryString -->",queryString,window,window.location);
    
    autoFill(); // auto fill fields if redirected from lead page


    $(".student-form").on("submit",function (e){
      e.preventDefault();
      let name = $("#name").val() ||"" ;
      let email = $("#email").val() ||"" ;
      let phone = $("#phone").val() ||"" ;
      let gndr = $("#gndr").val() ||"" ;
      let adrs = $("#adrs").val() ||"" ;
      let fn = $("#fn").val() ||"" ;
      let mn = $("#mn").val() ||"" ;
      let hq = $("#hq").val() ||"" ;
      let program = $("#program").val() ||"" ;
      let enroled = $("#enroled").val() ||"" ;
      const regexForName = /^[A-Za-z]+(?: [A-Za-z]+)?$/;
      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


      let error = false;
      let msg = "";



      console.log(name,email,phone,gndr,adrs,fn,mn,hq,program,enroled);
      // validation....
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
      } 
      if(adrs.length > 30){
        error= true;
        msg = "Too Lengthy Address..!!"
      }
      if(gndr != "M" && gndr != "F"){
        error = true;
        msg = "Please Select a Gender..!!";
      } 
      if(enroled != "3" && enroled != "1"){
        error = true;
        msg = "Invalid Enrollment";
      }
      if(!regexForName.test(fn)){
        error = true;
        msg = "Invalid Father's Name";
      } 
      if(!regexForName.test(mn)){
        error = true;
        msg = "Invalid Mother's Name";
      } 
      if(!name || !email || !phone || !gndr || !adrs || !fn || !mn || !hq || !enroled || !subARR.includes(program)){
        error = true;
        msg = "Please Fill all The Fileds..!!";
      }
      // validation completed...
      if(error == true){
        $("#errorPopup").html(` <div class="toast error-toast show"> <span class="toast-message">❌ ${msg}</span>
                                                            <button class="toast-close"><i class="fas fa-times"></i></button> </div>`);

            setTimeout(() => {
            $(".toast").removeClass("show").remove("toast");
          }, 3000);
      }
      if(error == false){
        const STUDENTDATA ={
                    "name":name,
                    "email":email,
                    "address":adrs,
                    "phone":phone,
                    "gender":gndr,
                    "program":program,
                    "status":enroled,
                    "father":fn,
                    "mother":mn,
                    "qualification":hq
                } 
                $.ajax({
                url:"http://localhost:3000/v1/addStudent",
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
      
    })

       function autoFill(){
       
        const QS = window.location.search 
        const params = new URLSearchParams(QS);
        let id = params.get("id");
        // console.log("id-->",id,"QS-->",QS,"params-->",params);

        if(id){
           $.ajax({
                url:"http://localhost:3000/v1/fillField",
                method:"POST",
                data:{"id":id},
                success:function(res){
                   console.log("res--->",res);
                   
                },
                error:function(e){
                    console.log("error caugth while calling api-->",e);
                    
                }
    
            })
        }
        
          
    }

  })
</script>
