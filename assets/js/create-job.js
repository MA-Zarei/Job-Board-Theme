document.addEventListener("DOMContentLoaded", function () {
  const jobForm = document.getElementById("createJobForm");

  jobForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(jobForm);
    formData.append("action", "submit_job_post"); // Ajax hook در PHP

    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          showToast("✅ آگهی با موفقیت ثبت شد");

          // ⏳ چند ثانیه بعد ریفرش انجام شود
          setTimeout(() => {
            location.reload();
          }, 2000); // مثلاً 2 ثانیه مهلت نمایش پیام
        } else {
          showToast(data?.data?.message || "❌ خطا در ثبت آگهی", "error");
        }
      })
      .catch(() => {
        showToast("❌ ارتباط با سرور برقرار نشد", "error");
      });
  });

  // تابع toast حرفه‌ای
  window.showToast = function (message, type = "success") {
    const toast = document.createElement("div");
    toast.className =
      "position-fixed bottom-0 end-0 m-3 px-3 py-2 text-white rounded shadow";
    toast.style.backgroundColor = type === "success" ? "#198754" : "#dc3545";
    toast.style.zIndex = "9999";
    toast.style.fontSize = "0.9rem";
    toast.innerHTML = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
  };
});