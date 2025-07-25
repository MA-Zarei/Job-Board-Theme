// Listen for resume file selection by the user
document.getElementById('resumeUpload').addEventListener('change', function () {
  const file = this.files[0]; // Get the selected file

  if (file) {
    // Calculate file size in kilobytes (rounded to one decimal)
    const sizeKB = (file.size / 1024).toFixed(1);

    // Display file name and size in the UI
    document.getElementById('resumeInfo').textContent = `${file.name} (${sizeKB} KB)`;
  } else {
    // No file selected – show default prompt
    document.getElementById('resumeInfo').textContent = 'ارسال رزومه (با فرمت PDF)';
  }
});