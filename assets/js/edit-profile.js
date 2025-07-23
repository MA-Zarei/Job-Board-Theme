document.addEventListener("DOMContentLoaded", function () {
    const editBtnContainer = document.getElementById("profileButtons");
    const editButton = document.getElementById("editProfileBtn");

    const fields = [
        { display: "companyNameDisplay", input: "companyNameInput" },
        { display: "companyEmailDisplay", input: "companyEmailInput" }, // فقط نمایش
        { display: "contactNumberDisplay", input: "contactNumberInput" },
        { display: "companyAddressDisplay", input: "companyAddressInput" },
    ];

    const logoPreview = document.getElementById("companyLogoPreview");
    const logoInput = document.getElementById("companyLogoInput");

    let initialState = {};

    // فعال کردن حالت ویرایش
    editButton.addEventListener("click", function () {
        initialState = {
            name: document.getElementById("companyNameInput").value.trim(),
            number: document.getElementById("contactNumberInput").value.trim(),
            address: document
                .getElementById("companyAddressInput")
                .value.trim(),
            logoHash: logoPreview.src,
        };

        fields.forEach(({ display, input }) => {
            document.getElementById(display).classList.add("d-none");
            document.getElementById(input).classList.remove("d-none");
        });

        logoInput.classList.remove("d-none");

        editBtnContainer.innerHTML = "";
        const saveBtn = document.createElement("button");
        saveBtn.className = "btn btn-success btn-sm w-100";
        saveBtn.textContent = "ثبت تغییرات";
        saveBtn.addEventListener("click", submitChanges);
        editBtnContainer.appendChild(saveBtn);
    });

    // پیش‌نمایش لوگوی جدید
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

    // ارسال تغییرات
    function submitChanges() {
        const formData = new FormData();
        const nameVal = document
            .getElementById("companyNameInput")
            .value.trim();
        const numberVal = document
            .getElementById("contactNumberInput")
            .value.trim();
        const addressVal = document
            .getElementById("companyAddressInput")
            .value.trim();
        const logoFile = logoInput.files[0] || null;

        // بررسی عدم تغییر
        const noChanges =
            nameVal === initialState.name &&
            numberVal === initialState.number &&
            addressVal === initialState.address &&
            !logoFile;

        if (noChanges) {
            showToast("🔄 هیچ تغییری نسبت به اطلاعات قبلی داده نشده", "error");

            // 🔁 فرم را به حالت اولیه برگردانیم
            fields.forEach(({ display, input }) => {
                document.getElementById(display).classList.remove("d-none");
                document.getElementById(input).classList.add("d-none");
            });

            logoInput.value = "";
            logoInput.classList.add("d-none");

            // بازگرداندن دکمه ویرایش
            editBtnContainer.innerHTML = "";
            const editBtnNew = document.createElement("button");
            editBtnNew.className = "btn btn-outline-primary btn-sm w-100";
            editBtnNew.textContent = "ویرایش اطلاعات";
            editBtnNew.addEventListener("click", () => editButton.click());
            editBtnContainer.appendChild(editBtnNew);

            return;
        }

        // بازگرداندن دکمه ویرایش
        editBtnContainer.innerHTML = "";
        const editBtnNew = document.createElement("button");
        editBtnNew.className = "btn btn-outline-primary btn-sm w-100";
        editBtnNew.textContent = "ویرایش اطلاعات";
        editBtnNew.addEventListener("click", () => editButton.click());
        editBtnContainer.appendChild(editBtnNew);

        // اعتبارسنجی مقدماتی
        const errors = [];
        if (!nameVal) errors.push("نام شرکت نمی‌تواند خالی باشد");
        if (!numberVal) errors.push("شماره تماس باید وارد شود");
        if (!addressVal) errors.push("آدرس شرکت نمی‌تواند خالی باشد");

        if (errors.length > 0) {
            showToast(errors.join("، "), "error");
            return;
        }

        formData.append("action", "update_user_profile");
        formData.append("company_name", nameVal);
        formData.append("contact_number", numberVal);
        formData.append("company_address", addressVal);
        if (logoFile) formData.append("company_logo", logoFile);

        fetch("/wp-admin/admin-ajax.php", {
            method: "POST",
            body: formData,
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    const updated = data.updated || {};

                    document.getElementById("companyNameDisplay").textContent =
                        nameVal;
                    document.getElementById(
                        "contactNumberDisplay"
                    ).textContent = numberVal;
                    document.getElementById(
                        "companyAddressDisplay"
                    ).textContent = addressVal;

                    if (
                        updated.company_logo_url &&
                        updated.company_logo_url !== ""
                    ) {
                        logoPreview.src = updated.company_logo_url;
                    }

                    // ریست فرم و نمایش‌ها
                    fields.forEach(({ display, input }) => {
                        document
                            .getElementById(display)
                            .classList.remove("d-none");
                        document.getElementById(input).classList.add("d-none");
                    });

                    logoInput.value = "";
                    logoInput.classList.add("d-none");

                    editBtnContainer.innerHTML = "";
                    const editBtnNew = document.createElement("button");
                    editBtnNew.className =
                        "btn btn-outline-primary btn-sm w-100";
                    editBtnNew.textContent = "ویرایش اطلاعات";
                    editBtnNew.addEventListener("click", () =>
                        editButton.click()
                    );
                    editBtnContainer.appendChild(editBtnNew);

                    showToast("✅ اطلاعات با موفقیت ذخیره شد");
                } else {
                    showToast(
                        data?.data?.message || "❌ خطا در ذخیره‌سازی اطلاعات",
                        "error"
                    );
                }
            })
            .catch(() => {
                showToast("❌ مشکلی در ارتباط با سرور رخ داد", "error");
            });
    }

    // تابع Toast قابل استفاده عمومی
    window.showToast = function (message, type = "success") {
        const toast = document.createElement("div");
        toast.className =
            "position-fixed bottom-0 end-0 m-3 px-3 py-2 text-white rounded shadow";
        toast.style.backgroundColor =
            type === "success" ? "#198754" : "#dc3545";
        toast.style.zIndex = "9999";
        toast.style.fontSize = "0.9rem";
        toast.innerHTML = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 5000);
    };
});
