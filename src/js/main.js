'use strict';

window.initialize = function () {

  window.loadScript();
  window.initMenu();
  window.checkContactFormResize();


  $('.owl-carousel').owlCarousel({
    items:1,
    loop:true,
    //lazyload: true,
    autoplay: true,
    autoplaySpeed: 500,
    autoplayTimeout: 2000,
    animateOut: 'fadeOut'
  });
  
  $('.parallax-window').parallax({naturalWidth: 2048, naturalHeight: 1367});

  $('#got-questions .close-button, .contact-form .contact-form-button').click(function() {
    var info = $('#got-questions');
    info.attr("id","got-questions-dismissed");
    info.hide();
  });

  $('.page-message-box .close-button').click(function() {
    $('.page-message-box').animate({ height: '0'}, { duration: 500, complete: function() {
      $(this).hide();
    }});
  });

  $(window).scroll(checkContactFormScroll);
  $(window).resize(checkContactFormResize);

};

window.checkContactFormResize = function() {
  var docHeight = $(document).height();
  var winHeight = $(window).height();
  var contactMaxBottom = docHeight - $('footer').height();

  var top = $(window).scrollTop();
  var bottom = top + winHeight;

  var contact = $('.contact-form-container');

  if (bottom > contactMaxBottom) {
    contact.css({position: 'absolute', bottom: -(contactMaxBottom - winHeight)});
  }
  else if (bottom < contactMaxBottom) {
    contact.css({position: '', bottom: ''}); 
  }
}

window.checkContactFormScroll = function() {
  var docHeight = $(document).height();
  var winHeight = $(window).height();

  var top = $(window).scrollTop();
  var bottom = top + winHeight;

  var contact = $('.contact-form-container');
  var info = $('#got-questions');
  var contactMaxBottom = docHeight - $('footer').height();

  var down = top > lastScrollTop;

  if(down && docHeight > 1300 && info.is(':hidden') > 0 && top > docHeight / 2) {
    if (!info.prop("animating")) {
      info.prop("animating", true);
      info.show().animate({ opacity: "1", bottom: "-=50" }, { duration: 500, easing: 'easeOutBounce', complete: function() {
        $(this).prop("animating", false);
      }});
    }
  }
  else if(!down && info.is(':visible') > 0 && top < docHeight / 2) {
    if (!info.prop("animating")) {
      info.prop("animating", true);
      info.animate({ opacity: "0", bottom: "+=50" }, { duration: 500, easing: 'easeInQuad', complete: function() {
        var t = $(this);
        t.hide();
        t.prop("animating", false);
      }}); 
    }
  }

  if (down && bottom > contactMaxBottom && (contact.css('position') == 'fixed' || contact.css('position') == 'static')) {
    contact.css({position: 'absolute', bottom: -(contactMaxBottom - winHeight)});
  }
  else if (!down && bottom < contactMaxBottom && contact.css('position') == 'absolute') {
    contact.css({position: '', bottom: ''}); 
  }
};

window.loadScript = function () {
  var sheet = document.createElement('link');
  sheet.rel = 'stylesheet';

  if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i))
    sheet.href = '/css/client_touch.css';
  else
    sheet.href = '/css/client_pointer.css';

  document.body.appendChild(sheet);
};

window.initMenu = function () {
  $('.menu-toggle').click($('.menu'), function (e) {
    var m = e.data;
    m.animate({
      height: "toggle"
    }, 300);
    m.toggleClass('expanded'); // add expanded
    m.toggleClass('right'); // remove right (on mobile)
    e.stopPropagation();
  });

  $('.dropdown-toggle').click(function (e) {
    var t = $(this);
    var td = t.next('.dropdown');
    var isExpanded = t.hasClass('expanded');

    if (isExpanded) {
      td.animate({
        height: "toggle"
      }, 300);
    }

    // close other dropdowns
    $('.dropdown-toggle').removeClass('expanded');
    $('.dropdown').removeClass('expanded');

    if (!isExpanded) {
      // expand parents (again)
      var p = t.parents('.dropdown');
      p.addClass('expanded');
      p.prev('.dropdown-toggle').addClass('expanded');

      // expand current element
      t.addClass('expanded');
      td.animate({
        height: "toggle"
      }, 300);
      td.addClass('expanded');
    }
    else {

    }
    e.stopPropagation();
  });

  /* Clicks within the dropdown won't make
  it past the dropdown itself */
  $(".dropdown").click(function (e) {
    e.stopPropagation();
  });

  $(".menu").click(function (e) {
    e.stopPropagation();
  });

  /* Anything that gets to the document
  will hide the dropdown */
  $(document).click(function () {
    $('.menu').removeClass('expanded');
    $(".dropdown-toggle").removeClass('expanded');
    $(".dropdown").removeClass('expanded');
  });


  // Hide Header on on scroll down
  $(window).scroll(function (event) {
    didScroll = true;
  });

  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 200);
};


var didScroll;
var lastScrollTop = 0;
var delta = 10;
var navbarHeight = $('.nav-bar').outerHeight();

window.hasScrolled = function () {
  var st = $(window).scrollTop();

  // Make sure they scroll more than delta
  if (Math.abs(lastScrollTop - st) <= delta)
    return;

  // If they scrolled down and are past the navbar, add class .nav-up.
  // This is necessary so you never see what is "behind" the navbar.
  if (st > lastScrollTop && st > navbarHeight) {
    // Scroll Down
    $('.nav-bar').removeClass('nav-down').addClass('nav-up');
  }
  else {
    // Scroll Up
    if (st + $(window).height() < $(document).height()) {
      $('.nav-bar').removeClass('nav-up').addClass('nav-down');
    }
  }

  lastScrollTop = st;
};

window.onload = initialize;