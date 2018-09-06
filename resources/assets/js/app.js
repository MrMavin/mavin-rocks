/* globals ScrollReveal Typed Barba */

$(document).ready(() => {
  /*
     * Scroll Reveal
     */

  const sr = ScrollReveal({
    origin: 'top',
    distance: '2rem',
    duration: 500,
    delay: 100,
    easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)',
    viewFactor: 0.2,
    viewOffset: {
      top: 50,
      right: 0,
      bottom: 0,
      left: 0,
    },
    mobile: false,
  });

  /*
     * Typed
     */

  const typedSettings = {
    stringsElement: '#typed-strings',
    typeSpeed: 50,
    startDelay: 500,
    backSpeed: 80,
    backDelay: 1000,
    loop: true,
  };

  let typed = null;

  /*
     * Manage progress bar
     */

  const pBar = $('#progress');

  function resetProgress() {
    pBar.stop();
    pBar.attr('value', 0);
  }

  function setProgress(percentage, duration = 200) {
    pBar.stop();
    pBar.animate(
      { value: percentage },
      {
        duration,
        step(now) {
          $(this).attr('value', now);
        },
      },
    );
  }

  function enableProgressScroll() {
    $(window).scroll(() => {
      const s = $(this).scrollTop();


      const d = $(document).height() - $(window).height();


      const scrollPercent = (s / d) * 100;
      setProgress(scrollPercent);
    });
  }

  function disableProgressScroll() {
    $(window).off('scroll');
  }

  /*
     * Manage navigation and mobile menu
     */

  const navMenu = $('#navigation .navbar-menu');
  const navBurgher = $('#navigation .navbar-burger');
  const navLinks = $("a[id^='nav-']");

  navBurgher.click(() => {
    navMenu.toggle();
  });

  function setActive(navigationId) {
    const navWithoutWords = navigationId.replace(/ .*/, ''); // Remove extra words
    navLinks.removeClass('is-active');

    const current = jQuery.grep(navLinks, element => element.id === `nav-${navWithoutWords}`);

    $(current).addClass('is-active');
  }

  Barba.Dispatcher.on('linkClicked', () => {
    resetProgress();
    disableProgressScroll();
  });

  let scrollTo = false;
  let oldHeight = 0;

  Barba.Dispatcher.on('newPageReady', (currentStatus, oldStatus, container) => {
    setActive(currentStatus.namespace);
    navMenu.hide();

    if (currentStatus.namespace === 'home') {
      typed = new Typed('#typed', typedSettings);

      $('[data-scroll]').click((e) => {
        scrollTo = e.currentTarget.attributes['data-scroll'].value;
      });
    } else if (typed !== null) {
      typed.destroy();
    } else {
      typed = null;
    }

    // let elem = container.getElementById("#hobbies");
    // console.log(elem);

    // won't automatically scroll to top
    if (scrollTo === false) {
      window.scrollTo(0, 0);
    } else {
      // I have to manually calculate the current height in order
      // to scroll to the right position.
      // Please keep in mind that the current elements positions
      // aren't correct since they will include the old container's height
      const c = document.getElementById(scrollTo).getBoundingClientRect().top
        - oldHeight
        + window.scrollY;

      $('html, body').animate({
        scrollTop: c,
      }, 1000);

      scrollTo = false;
    }

    oldHeight = container.getBoundingClientRect().height;
  });

  Barba.Dispatcher.on('transitionCompleted', (currentStatus, oldStatus, container) => {
    resetProgress();

    if (currentStatus.namespace.includes('article')) {
      enableProgressScroll();
    } else {
      disableProgressScroll();
    }

    sr.sync();
  });

  /*
     * Start Everything
     */

  Barba.Pjax.start();

  sr.reveal('.sr .section');
  sr.reveal('.sr .card');
  sr.reveal('.sr-p *');
  sr.reveal('.sr-c .container');
  sr.reveal('.sr-col .column');
});
