// Display password function
function myFunction() {
  var x = document.getElementById("password");
  var y = document.getElementById("confirmPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}

function confirmDelete(event) {
  event.preventDefault();
  const link = event.currentTarget;
  const categoryName = link.dataset.categoryName;
  const confirmation = confirm(
    `Are you sure you want to delete this category "${categoryName}"?`
  );

  if (confirmation) {
    // If the user click "OK", follow the link
    window.location.href = link.href;
  }
  // If the user clicks "Cancel", do nothing.
}

export { myFunction, confirmDelete };

// Add event on all the delete icons
const trashIcons = document.querySelectorAll(".trash-icon");
trashIcons.forEach((icon) => {
  icon.addEventListener("click", confirmDelete);
});

const showHideCheckbox = document.querySelector("#showHide");
showHideCheckbox.addEventListener("change", myFunction);
