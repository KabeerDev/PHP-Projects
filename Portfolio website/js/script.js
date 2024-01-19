var typed = new Typed(".text", {
  strings: ["Frontend Developer", "Backend Developer", "Web Developer"],
  typeSpeed: 100,
  backSpeed: 100,
  backDelay: 1000,
  loop: true,
});

const form = document.querySelector(".msgForm"),
  statusTxt = form.querySelector("span");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  statusTxt.style.display = "block";
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "message.php", true);
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = xhr.response;
      if (
        response.indexOf("Please fill all the required fields!") != -1 ||
        response.indexOf("Enter a valid email address!") != -1 ||
        response.indexOf("Sorry, failed to send your message!")
      ) {
        statusTxt.style.color = "red";
      } else {
        form.reset();
        setTimeout(() => {
          statusTxt.style.display = "none";
        }, 3000);
      }
      statusTxt.innerText = response;
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
});
