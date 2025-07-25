// Wait until the DOM is ready before initializing edit logic
document.addEventListener("DOMContentLoaded", function () {
  // Select UI elements used for toggling between display/edit modes
  const editBtn     = document.querySelector(".btn-outline-primary");
  const nameSpan    = document.getElementById("companyNameDisplay");
  const nameInput   = document.getElementById("companyNameInput");
  const phoneSpan   = document.getElementById("contactNumberDisplay");
  const phoneInput  = document.getElementById("contactNumberInput");
  const emailSpan   = document.getElementById("companyEmailDisplay"); // readonly display
  const emailInput  = document.getElementById("companyEmailInput");

  // Toggle form into editable mode when "Edit" button is clicked
  editBtn.addEventListener("click", function (e) {
    e.preventDefault();

    // Hide text spans and reveal input fields
    nameSpan.classList.add("d-none");
    nameInput.classList.remove("d-none");

    phoneSpan.classList.add("d-none");
    phoneInput.classList.remove("d-none");

    emailSpan.classList.add("d-none");
    emailInput.classList.remove("d-none");

    editBtn.classList.add("d-none"); // Hide edit button

    // Create "Save Changes" button dynamically
    const submitBtn = document.createElement("button");
    submitBtn.textContent = "ثبت تغییرات";
    submitBtn.className = "btn btn-success btn-sm w-100 mt-3";
    submitBtn.id = "submitJobseekerEdit";

    // Append button to card body container
    document.querySelector(".card-body").appendChild(submitBtn);

    // Handle form submission via AJAX
    submitBtn.addEventListener("click", function () {
      const nameVal  = nameInput.value;
      const phoneVal = phoneInput.value;

      // Prepare form data for AJAX request
      const formData = new FormData();
      formData.append("action", "update_jobseeker_profile");
      formData.append("display_name", nameVal);
      formData.append("contact_number", phoneVal);

      // Send update request to WordPress backend
      fetch("/wp-admin/admin-ajax.php", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            // Reflect new values in display elements
            nameSpan.textContent = nameVal;
            phoneSpan.textContent = phoneVal;

            // Hide inputs and show updated spans
            nameInput.classList.add("d-none");
            phoneInput.classList.add("d-none");
            emailInput.classList.add("d-none");

            nameSpan.classList.remove("d-none");
            phoneSpan.classList.remove("d-none");
            emailSpan.classList.remove("d-none");

            submitBtn.remove();              // Remove save button
            editBtn.classList.remove("d-none"); // Show edit button again

            showToast("اطلاعات شما بروزرسانی شد");
          } else {
            showToast(data?.data?.message || "خطا در بروزرسانی", "error");
          }
        })
        .catch(() => {
          showToast("ارتباط با سرور برقرار نشد", "error");
        });
    });
  });

  /**
   * Displays a toast notification on screen
   *
   * @param {string} message - Message text to show
   * @param {string} [type="success"] - Either "success" or "error"
   */
  function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className =
      "position-fixed bottom-0 end-0 m-3 px-3 py-2 text-white rounded shadow";

    toast.style.backgroundColor = type === "success" ? "#198754" : "#dc3545";
    toast.style.zIndex = "9999";
    toast.style.fontSize = "0.9rem";
    toast.textContent = message;

    // Inject toast into DOM and remove after delay
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
  }
});