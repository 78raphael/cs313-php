// document.getElementById("click-me").addEventListener("click", () => { alert("Clicked!") });

// document.getElementById("color-button").addEventListener("click", () => {
//   $color = document.getElementById("color-chooser").value;

//   let $div = document.getElementById("first-div");
//   $div.style.color = $color;
// });

$("#click-me").click(function() {
  alert("JQuery: Clicked!");
});

$("#color-button").click(function() {
  $color = $("#color-chooser").val();

  $("#first-div").css("color", $color);
});

$("#visibility").click(function() {
  $("#third-div").fadeToggle("slow");
});