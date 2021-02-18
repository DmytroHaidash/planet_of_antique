module.exports = ($) => {
  const $submenu = $('.submenu');

  $('a[href^="#"]').on('click', function (e) {
    e.preventDefault();
  });

  $('.link a').on('click', function () {
    console.log('work-2');
    const parent = $(this).parent();

    if (parent.find($submenu).length) {
      parent.toggleClass('is-opened');
      parent.find($submenu).fadeToggle().focus();
    }
  });

  $('.close').on('click', function() {
    $submenu.parent().removeClass('is-opened');
    $submenu.fadeOut();
  });

  $(document).on('click', e => {
    if (!$submenu.parent().is(e.target) && !$submenu.parent().has(e.target).length) {
      $submenu.parent().removeClass('is-opened');
      $submenu.fadeOut();
    }
  });


  $('[data-toggle-nav]').on('click', function() {
    $('.app-nav').fadeIn().css({display: 'flex'});
  });

  $('[data-close-nav]').on('click', function() {
    $('.app-nav').fadeOut();
  })
};