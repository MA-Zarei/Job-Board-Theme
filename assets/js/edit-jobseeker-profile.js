document.addEventListener("DOMContentLoaded", function () {
  const editBtn = document.querySelector(".btn-outline-primary");
  const nameSpan = document.getElementById("companyNameDisplay");
  const nameInput = document.getElementById("companyNameInput");
  const phoneSpan = document.getElementById("contactNumberDisplay");
  const phoneInput = document.getElementById("contactNumberInput");
  const emailSpan = document.getElementById("companyEmailDisplay"); // نمایش فقط، readonly
  const emailInput = document.getElementById("companyEmailInput");

  editBtn.addEventListener("click", function (e) {
    e.preventDefault();

    nameSpan.classList.add("d-none");
    nameInput.classList.remove("d-none");

    phoneSpan.classList.add("d-none");
    phoneInput.classList.remove("d-none");

    emailSpan.classList.add("d-none");
    emailInput.classList.remove("d-none");

    editBtn.classList.add("d-none");

    // ساخت دکمه «ثبت تغییرات»
    const submitBtn = document.createElement("button");
    submitBtn.textContent = "ثبت تغییرات";
    submitBtn.className = "btn btn-success btn-sm w-100 mt-3";
    submitBtn.id = "submitJobseekerEdit";

    document.querySelector(".card-body").appendChild(submitBtn);

    submitBtn.addEventListener("click", function () {
      const nameVal = nameInput.value;
      const phoneVal = phoneInput.value;

      const formData = new FormData();
      formData.append("action", "update_jobseeker_profile");
      formData.append("display_name", nameVal);
      formData.append("contact_number", phoneVal);

      fetch("/wp-admin/admin-ajax.php", {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            nameSpan.textContent = nameVal;
            phoneSpan.textContent = phoneVal;
            nameInput.classList.add("d-none");
            phoneInput.classList.add("d-none");
            emailInput.classList.add("d-none");

            nameSpan.classList.remove("d-none");
            phoneSpan.classList.remove("d-none");
            emailSpan.classList.remove("d-none");

            submitBtn.remove();
            editBtn.classList.remove("d-none");

            showToast("✅ اطلاعات شما بروزرسانی شد");
          } else {
            showToast(data?.data?.message || "❌ خطا در بروزرسانی", "error");
          }
        })
        .catch(() => {
          showToast("❌ ارتباط با سرور برقرار نشد", "error");
        });
    });
  });

  // تابع toast
  function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className =
      "position-fixed bottom-0 end-0 m-3 px-3 py-2 text-white rounded shadow";
    toast.style.backgroundColor = type === "success" ? "#198754" : "#dc3545";
    toast.style.zIndex = "9999";
    toast.style.fontSize = "0.9rem";
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
  }
});