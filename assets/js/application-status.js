document.querySelectorAll(".apply-status-btn").forEach(btn => {
  btn.addEventListener("click", function () {
    const appId = this.dataset.applicationId;
    const select = document.querySelector(`select[data-application-id="${appId}"]`);
    const newStatus = select.value;

    const formData = new FormData();
    formData.append("action", "update_application_status");
    formData.append("application_id", appId);
    formData.append("new_status", newStatus);

    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          showToast("✅ وضعیت درخواست بروزرسانی شد");
        } else {
          showToast(data?.data?.message || "❌ خطا در ذخیره وضعیت درخواست", "error");
        }
      })
      .catch(() => {
        showToast("❌ مشکل در ارتباط با سرور", "error");
      });
  });
});