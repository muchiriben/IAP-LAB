const fname = document.getElementById("first_name");
const lname = document.getElementById("last_name");
const city = document.getElementById("city_name");
const myForm = document.querySelector(".myForm");
const errorElement = document.getElementById("error_msg");

myForm.addEventListener("submit", (e) => {
  let messages = [];
  if (fname.value === "" || fname.value == null) {
    messages.push("First Name is Required");
    console.log("First name");
  }

  if (lname.value === "" || lname.value == null) {
    messages.push("Last Name is Required");
  }

  if (city.value === "" || city.value == null) {
    messages.push("City name is Required");
  }

  if (messages.length > 0) {
    errorElement.innerText = messages.join(" -- ");
    e.preventDefault();
  }
});
