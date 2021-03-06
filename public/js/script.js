new Swiper(".main-slider__section", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  grabCursor: true,
  slideToClikeSlide: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
    pageUpDown: true,
  },
  loop: true,
  effect: "fade",
  fadeEffect: {
    crossFade: true,
  },
  speed: 1500,
  slidesPerView: 1,
});

new Swiper(".section-new__slider", {
  navigation: {
    nextEl: ".section-new__slider__button-next",
    prevEl: ".section-new__slider__button-prev",
  },
  grabCursor: true,
  slideToClikeSlide: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
    pageUpDown: true,
  },
  loop: true,
  speed: 1000,
  spaceBetween: 20,
  slidesPerView: "auto",
});

new Swiper(".section-recommended__slider", {
  navigation: {
    nextEl: ".section-recommended__slider__button-next",
    prevEl: ".section-recommended__slider__button-prev",
  },
  grabCursor: true,
  slideToClikeSlide: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
    pageUpDown: true,
  },
  loop: true,
  speed: 1000,
  spaceBetween: 20,
  slidesPerView: "auto",
});

new Swiper(".section-sellers__slider", {
  navigation: {
    nextEl: ".section-sellers__slider__button-next",
    prevEl: ".section-sellers__slider__button-prev",
  },
  grabCursor: true,
  slideToClikeSlide: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
    pageUpDown: true,
  },
  loop: true,
  speed: 1000,
  spaceBetween: 20,
  slidesPerView: 'auto',
});
new Swiper(".section-museums__slider", {
  navigation: {
    nextEl: ".section-museums__slider__button-next",
    prevEl: ".section-museums__slider__button-prev",
  },
  grabCursor: true,
  slideToClikeSlide: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
    pageUpDown: true,
  },
  loop: true,
  speed: 1000,
  spaceBetween: 20,
  slidesPerView: 'auto',
});

new Swiper(".section-exhibit__slider", {
  navigation: {
    nextEl: ".section-exhibit__slider__button-next",
    prevEl: ".section-exhibit__slider__button-prev",
  },
  grabCursor: true,
  slideToClikeSlide: true,
  keyboard: {
    enabled: true,
    onlyInViewport: true,
    pageUpDown: true,
  },
  loop: true,
  speed: 1000,
  spaceBetween: 20,
  slidesPerView: 'auto',
});

function toggleSearch(e) {
  const searchInput = document.getElementsByClassName("search-input")[0];
  const customerLink = document.getElementsByClassName("customers-link")[0];
  let btns = document.getElementsByClassName('search-btn');
  btns[0].classList.toggle("d-none");
  btns[1].classList.toggle("d-none");
  btns[2].classList.toggle("d-none");
  searchInput.classList.toggle("search-input_active");
  searchInput.classList.toggle("inputFocused");
  if(searchInput.classList.contains('inputFocused')){
    searchInput.focus();
  }else{
    searchInput.blur();
  }
  if (window.screen.width < 1800) {
    customerLink.classList.toggle("none");
  }
}


function toggleMenu(e) {
  const btn = document.getElementById("menu-btn");
  const linkMenu = document.getElementById("link-menu");
  if (linkMenu.classList.contains("active")) {
    e.target.innerHTML = '&#8801';
  } else {
    e.target.innerHTML = "&#88";
  }
  linkMenu.classList.toggle('active');
  btn.classList.toggle('link-menu-btn');
  btn.classList.toggle('link-menu-btn-close');
}
