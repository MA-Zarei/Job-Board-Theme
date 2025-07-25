// Wait for the DOM to load before initializing sliders
document.addEventListener("DOMContentLoaded", function () {
  const desktopSlider = document.getElementById('price-slider');
  const mobileSlider = document.getElementById('price-slider-mobile');

  /**
   * Create noUiSlider for desktop view
   */
  if (desktopSlider) {
    noUiSlider.create(desktopSlider, {
      start: [2000000, 6000000],     // Initial range selection
      connect: true,                 // Show filled area between handles
      step: 500000,                  // Snap values in increments
      range: {
        min: 0,
        max: 10000000
      },
      format: {
        // Display formatted Persian number (e.g. 6,000,000)
        to: value => Math.round(value).toLocaleString('fa-IR'),
        // Parse formatted string back to number (e.g. "6,000,000" → 6000000)
        from: value => Number(value.replace(/,/g, ''))
      }
    });
  }

  /**
   * Create noUiSlider for mobile view
   */
  if (mobileSlider) {
    noUiSlider.create(mobileSlider, {
      start: [2000000, 6000000],
      connect: true,
      step: 500000,
      range: {
        min: 0,
        max: 10000000
      },
      format: {
        to: value => Math.round(value).toLocaleString('fa-IR'),
        from: value => Number(value.replace(/,/g, ''))
      }
    });
  }
});