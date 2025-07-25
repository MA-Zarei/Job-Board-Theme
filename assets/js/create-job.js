// Wait for the DOM to fully load before initializing form logic
document.addEventListener("DOMContentLoaded", function () {
  const jobForm = document.getElementById("createJobForm");

  // Intercept form submission to handle via AJAX instead of native reload
  jobForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Prepare form data and specify WP AJAX action
    const formData = new FormData(jobForm);
    formData.append("action", "submit_job_post"); // Matches PHP hook name

    // Submit form data via AJAX to WordPress admin-ajax.php
    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        // Show success toast and refresh page after delay
        if (data.success) {
          showToast("آگهی با موفقیت ثبت شد");

          setTimeout(() => {
            location.reload();
          }, 2000); // Give time to read the toast before reloading
        } else {
          // Show error from server (if available)
          showToast(data?.data?.message || "خطا در ثبت آگهی", "error");
        }
      })
      .catch(() => {
        // Network or server failure
        showToast("ارتباط با سرور برقرار نشد", "error");
      });
  });

  /**
   * Global toast display function
   * Creates and auto-removes styled notification at bottom-right of screen
   *
   * @param {string} message - The message to show
   * @param {string} [type="success"] - Either 'success' or 'error'
   */
  window.showToast = function (message, type = "success") {
    const toast = document.createElement("div");
    toast.className =
      "position-fixed bottom-0 end-0 m-3 px-3 py-2 text-white rounded shadow";

    // Dynamically style toast color
    toast.style.backgroundColor = type === "success" ? "#198754" : "#dc3545";
    toast.style.zIndex = "9999";
    toast.style.fontSize = "0.9rem";
    toast.innerHTML = message;

    // Append and auto-remove toast
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
  };
});