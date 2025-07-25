// Register change event for each job status toggle switch
document.querySelectorAll(".job-status-toggle").forEach(toggle => {
  toggle.addEventListener("change", function () {
    const jobId     = this.dataset.jobId;                   // Job ID from data attribute
    const newStatus = this.checked ? "فعال" : "غیرفعال";    // Determine new status based on toggle
    const label     = this.nextElementSibling;              // Text label beside switch

    // Prepare form data to send via AJAX
    const formData = new FormData();
    formData.append("action", "toggle_job_status");         // Matches PHP handler
    formData.append("job_id", jobId);
    formData.append("new_status", newStatus);

    // Send request to WordPress AJAX endpoint
    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          // Update label text if status change was successful
          label.textContent = newStatus;
          showToast("وضعیت آگهی بروزرسانی شد");
        } else {
          // Show error toast and revert toggle switch
          showToast(data?.data?.message || "خطا در بروزرسانی آگهی", "error");
          this.checked = !this.checked;
        }
      })
      .catch(() => {
        // Handle network/server error and revert switch
        showToast("ارتباط با سرور برقرار نشد", "error");
        this.checked = !this.checked;
      });
  });
});