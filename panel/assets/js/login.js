$(document).ready(function () {
  // Toggle password visibility
  $("#showPassword").change(function () {
    const passwordField = $("#password");
    if ($(this).is(":checked")) {
      passwordField.attr("type", "text");
    } else {
      passwordField.attr("type", "password");
    }
  });

  // Form submission
  $("#loginForm").submit(function (e) {
    e.preventDefault();

    //Form Values
    let email = $("#email").val();
    let pass = $("#pass").val();
    console.log("form values--->", email, pass);
    error = false;
    msg = "Something Went Wrong..!! ";

    // Simulate loading (replace with actual AJAX)
    $('button[type="submit"]').html(
      '<i class="fas fa-spinner fa-spin"></i> Authenticating...'
    );

    if (email != "admin@nit.com" || pass != "admin@nit") {
      error = true;
      msg = " ❌ Invalid Email Or Password !!";
    }

    if (error == true) {
      console.log("error caught...");

      setTimeout(() => {
        $("#errorPopup").show().text(msg);
        $('button[type="submit"]').html("Login");
      }, 1000);

      $("#errorPopup").delay(6000).fadeOut();
    }
    if (error == false) {
      setTimeout(() => {
        // Redirect to admin panel on "success"

        window.location.href = "admin/dashboard.php";
        $('button[type="submit"]').html("Login");
      }, 1500);
    }
  });
});
