// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
  const editBtnContainer = document.getElementById("profileButtons");
  const editButton = document.getElementById("editProfileBtn");

  // Define pairs of display and input field IDs
  const fields = [
    { display: "companyNameDisplay", input: "companyNameInput" },
    { display: "companyEmailDisplay", input: "companyEmailInput" }, // read-only visual
    { display: "contactNumberDisplay", input: "contactNumberInput" },
    { display: "companyAddressDisplay", input: "companyAddressInput" },
  ];

  const logoPreview = document.getElementById("companyLogoPreview");
  const logoInput = document.getElementById("companyLogoInput");

  let initialState = {};

  // Activate edit mode when "Edit Profile" button is clicked
  editButton.addEventListener("click", function () {
    initialState = {
      name: document.getElementById("companyNameInput").value.trim(),
      number: document.getElementById("contactNumberInput").value.trim(),
      address: document.getElementById("companyAddressInput").value.trim(),
      logoHash: logoPreview.src,
    };

    // Hide display spans and show input fields
    fields.forEach(({ display, input }) => {
      document.getElementById(display).classList.add("d-none");
      document.getElementById(input).classList.remove("d-none");
    });

    logoInput.classList.remove("d-none");

    // Replace button container with "Save Changes" button
    editBtnContainer.innerHTML = "";
    const saveBtn = document.createElement("button");
    saveBtn.className = "btn btn-success btn-sm w-100";
    saveBtn.textContent = "ثبت تغییرات";
    saveBtn.addEventListener("click", submitChanges);
    editBtnContainer.appendChild(saveBtn);
  });

  // Update logo preview when a new image is selected
  logoInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (e) {
        logoPreview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  // Handle form submission and data saving
  function submitChanges() {
    const formData = new FormData();
    const nameVal = document.getElementById("companyNameInput").value.trim();
    const numberVal = document.getElementById("contactNumberInput").value.trim();
    const addressVal = document.getElementById("companyAddressInput").value.trim();
    const logoFile = logoInput.files[0] || null;

    // Check whether any changes have been made
    const noChanges =
      nameVal === initialState.name &&
      numberVal === initialState.number &&
      addressVal === initialState.address &&
      !logoFile;

    if (noChanges) {
      showToast("هیچ تغییری نسبت به اطلاعات قبلی داده نشده", "error");

      // Reset view to non-editable state
      fields.forEach(({ display, input }) => {
        document.getElementById(display).classList.remove("d-none");
        document.getElementById(input).classList.add("d-none");
      });

      logoInput.value = "";
      logoInput.classList.add("d-none");

      // Restore original "Edit Profile" button
      editBtnContainer.innerHTML = "";
      const editBtnNew = document.createElement("button");
      editBtnNew.className = "btn btn-outline-primary btn-sm w-100";
      editBtnNew.textContent = "ویرایش اطلاعات";
      editBtnNew.addEventListener("click", () => editButton.click());
      editBtnContainer.appendChild(editBtnNew);

      return;
    }

    // Restore edit button before validation
    editBtnContainer.innerHTML = "";
    const editBtnNew = document.createElement("button");
    editBtnNew.className = "btn btn-outline-primary btn-sm w-100";
    editBtnNew.textContent = "ویرایش اطلاعات";
    editBtnNew.addEventListener("click", () => editButton.click());
    editBtnContainer.appendChild(editBtnNew);

    // Basic form validation
    const errors = [];
    if (!nameVal) errors.push("نام شرکت نمی‌تواند خالی باشد");
    if (!numberVal) errors.push("شماره تماس باید وارد شود");
    if (!addressVal) errors.push("آدرس شرکت نمی‌تواند خالی باشد");

    if (errors.length > 0) {
      showToast(errors.join("، "), "error");
      return;
    }

    // Append validated data to FormData
    formData.append("action", "update_user_profile");
    formData.append("company_name", nameVal);
    formData.append("contact_number", numberVal);
    formData.append("company_address", addressVal);
    if (logoFile) formData.append("company_logo", logoFile);

    // Send AJAX request to WordPress backend
    fetch("/wp-admin/admin-ajax.php", {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          const updated = data.updated || {};

          // Update displayed content after save
          document.getElementById("companyNameDisplay").textContent = nameVal;
          document.getElementById("contactNumberDisplay").textContent = numberVal;
          document.getElementById("companyAddressDisplay").textContent = addressVal;

          if (updated.company_logo_url && updated.company_logo_url !== "") {
            logoPreview.src = updated.company_logo_url;
          }

          // Reset form to read-only state
          fields.forEach(({ display, input }) => {
            document.getElementById(display).classList.remove("d-none");
            document.getElementById(input).classList.add("d-none");
          });

          logoInput.value = "";
          logoInput.classList.add("d-none");

          editBtnContainer.innerHTML = "";
          const editBtnFinal = document.createElement("button");
          editBtnFinal.className = "btn btn-outline-primary btn-sm w-100";
          editBtnFinal.textContent = "ویرایش اطلاعات";
          editBtnFinal.addEventListener("click", () => editButton.click());
          editBtnContainer.appendChild(editBtnFinal);

          showToast("اطلاعات با موفقیت ذخیره شد");
        } else {
          showToast(
            data?.data?.message || "خطا در ذخیره‌سازی اطلاعات",
            "error"
          );
        }
      })
      .catch(() => {
        showToast("مشکلی در ارتباط با سرور رخ داد", "error");
      });
  }

  // Generic toast display function
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