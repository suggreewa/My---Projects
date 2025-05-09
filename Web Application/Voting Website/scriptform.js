document.getElementById("submitButton").addEventListener("click", function(event) {
  event.preventDefault(); // Prevent the form from being submitted

  alert("Form submitted!"); // Show an alert when the button is clicked
});

document.getElementById("del").addEventListener("click", function(event) {
  // Prevent the form from being submitted

  alert("entry deleted"); // Show an alert when the button is clicked
});