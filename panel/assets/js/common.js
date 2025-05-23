$(document).ready(function () {
  $("#show-btn").on("click", function () {
    console.log($("#pass").attr("type"));
    let type = $("#pass").attr("type");
    if (type == "password") {
      $("#pass").attr("type", "text");
    } else {
      {
        $("#pass").attr("type", "password");
      }
    }
  });
});
