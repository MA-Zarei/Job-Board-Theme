// Displays a Bootstrap-styled error toast message
window.showToastError = function(message) {
  // Set toast message text
  document.getElementById('toastErrorText').innerText = message;

  // Get toast element and initialize Bootstrap toast instance
  const toastElement = document.getElementById('toastError');
  const toast = new bootstrap.Toast(toastElement);

  // Show the toast notification
  toast.show();
};