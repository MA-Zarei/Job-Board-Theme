document.addEventListener("DOMContentLoaded", function () {
  const desktopSlider = document.getElementById('price-slider');
  const mobileSlider = document.getElementById('price-slider-mobile');

  if (desktopSlider) {
    noUiSlider.create(desktopSlider, {
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