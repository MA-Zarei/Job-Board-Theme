// Initialize resume upload logic after DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  const resumeInput       = document.getElementById("resumeUpload");       // Hidden file input
  const resumeInfo        = document.getElementById("resumeInfo");         // File info display element
  const resumeButton      = document.getElementById("resumeUploadButton"); // Visible button that triggers file input
  const resumeButtonArea  = document.getElementById("resumeButtonArea");   // Container for upload/submit buttons

  let selectedFile = null;

  // Open file selector when upload button is clicked
  resumeButton.addEventListener("click", function () {
    resumeInput.click();
  });

  // Handle file selection and UI update
  resumeInput.addEventListener("change", function () {
    selectedFile = this.files[0];

    if (selectedFile) {
      const sizeKB = (selectedFile.size / 1024).toFixed(1);
      resumeInfo.textContent = `${selectedFile.name} (${sizeKB} KB)`;

      // Remove initial upload button and show "Submit" button instead
      resumeButtonArea.innerHTML = "";

      const submitBtn = document.createElement("button");
      submitBtn.type = "button";
      submitBtn.className = "btn btn-success btn-sm";
      submitBtn.textContent = "ارسال درخواست به کارفرما";

      // Send application when button is clicked
      submitBtn.addEventListener("click", function () {
        submitApplication(selectedFile);
      });

      resumeButtonArea.appendChild(submitBtn);
    } else {
      resumeInfo.textContent = "ارسال رزومه (با فرمت PDF)";
    }
  });

  // Sends job application and resume file to backend via AJAX
  function submitApplication(file) {
    const jobID = window.jobPostID || 0;

    const formData = new FormData();
    formData.append("action", "submit_job_application");
    formData.append("job_id", jobID);
    formData.append("resume", file);

    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          showToast(data.message || "درخواست شما با موفقیت ارسال شد");
          resumeButtonArea.innerHTML = "";
        } else {
          showToast(
            data.data.message || "خطا در ارسال درخواست",
            "error"
          );
        }
      })
      .catch(() => {
        showToast("مشکل در ارتباط با سرور", "error");
      });
  }

  // Display toast message at bottom corner
  function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className =
      "position-fixed bottom-0 end-0 m-3 px-3 py-2 text-white rounded shadow";
    toast.style.backgroundColor = type === "success" ? "#198754" : "#dc3545";
    toast.style.zIndex = "9999";
    toast.style.fontSize = "0.9rem";
    toast.textContent = message;

    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
  }
});