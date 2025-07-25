// Loop over all buttons used to trigger application status updates
document.querySelectorAll(".apply-status-btn").forEach(btn => {
  btn.addEventListener("click", function () {
    // Extract application ID from button dataset
    const appId = this.dataset.applicationId;

    // Find the associated select element for this application
    const select = document.querySelector(`select[data-application-id="${appId}"]`);
    const newStatus = select.value;

    // Prepare form data for AJAX submission
    const formData = new FormData();
    formData.append("action", "update_application_status");
    formData.append("application_id", appId);
    formData.append("new_status", newStatus);

    // Send request to WordPress AJAX handler
    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        // Handle successful response
        if (data.success) {
          showToast("Application status has been updated"); // success toast
        } else {
          // Handle failure with message fallback
          showToast(data?.data?.message || "Error saving application status", "error");
        }
      })
      .catch(() => {
        // Network/server error
        showToast("Server communication issue", "error");
      });
  });
});