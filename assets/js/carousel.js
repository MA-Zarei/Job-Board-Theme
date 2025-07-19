document.getElementById('resumeUpload').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const sizeKB = (file.size / 1024).toFixed(1);
      document.getElementById('resumeInfo').textContent = `${file.name} (${sizeKB} KB)`;
    } else {
      document.getElementById('resumeInfo').textContent = 'ارسال رزومه (با فرمت PDF)';
    }
  });
