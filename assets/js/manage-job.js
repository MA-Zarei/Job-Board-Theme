document.querySelectorAll(".job-status-toggle").forEach(toggle => {
  toggle.addEventListener("change", function () {
    const jobId = this.dataset.jobId;
    const newStatus = this.checked ? "فعال" : "غیرفعال";
    const label = this.nextElementSibling;

    const formData = new FormData();
    formData.append("action", "toggle_job_status");
    formData.append("job_id", jobId);
    formData.append("new_status", newStatus);

    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          label.textContent = newStatus;
          showToast("✅ وضعیت آگهی بروزرسانی شد");
        } else {
          showToast(data?.data?.message || "❌ خطا در بروزرسانی آگهی", "error");
          this.checked = !this.checked; // ریست سوییچ
        }
      })
      .catch(() => {
        showToast("❌ ارتباط با سرور برقرار نشد", "error");
        this.checked = !this.checked;
      });
  });
});