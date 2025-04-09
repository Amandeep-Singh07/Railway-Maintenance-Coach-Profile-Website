document.addEventListener("DOMContentLoaded", function () {
  // Mobile menu toggle
  const menuButton = document.querySelector("nav button");
  const mobileMenu = document.querySelector("nav .md\\:flex");

  menuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
    mobileMenu.classList.toggle("flex");
    mobileMenu.classList.toggle("flex-col");
    mobileMenu.classList.toggle("absolute");
    mobileMenu.classList.toggle("top-16");
    mobileMenu.classList.toggle("left-0");
    mobileMenu.classList.toggle("right-0");
    mobileMenu.classList.toggle("bg-blue-800");
    mobileMenu.classList.toggle("p-4");
  });

  // Form submission
  const contactForm = document.querySelector("form");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData();
      formData.append("name", document.getElementById("name").value);
      formData.append("email", document.getElementById("email").value);
      formData.append("message", document.getElementById("message").value);

      // Show loading state
      const submitButton = contactForm.querySelector('button[type="submit"]');
      const originalButtonText = submitButton.innerHTML;
      submitButton.innerHTML =
        '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
      submitButton.disabled = true;

      // Send data to PHP backend
      fetch("process_contact.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          // Reset button state
          submitButton.innerHTML = originalButtonText;
          submitButton.disabled = false;

          if (data.status === "success") {
            // Show success message
            alert(data.message);
            contactForm.reset();
          } else {
            // Show error message
            alert(
              data.message || "Something went wrong. Please try again later."
            );
          }
        })
        .catch((error) => {
          // Reset button state
          submitButton.innerHTML = originalButtonText;
          submitButton.disabled = false;

          // Show error message
          console.error("Error:", error);
          alert("An error occurred. Please try again later.");
        });
    });
  }

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
        });
      }
    });
  });

  // Add click event listeners to coach detail buttons
  document.querySelectorAll(".coach-detail-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const coachId = this.getAttribute("data-coach-id");
      window.location.href = `coach_details.php?id=${coachId}`;
    });
  });
});
