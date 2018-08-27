$(document).ready(function () {
    /*
     * Scroll Reveal
     */

    let sr = ScrollReveal({
        origin: 'top',
        distance: '2rem',
        duration: 500,
        delay: 100,
        easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)',
        viewFactor: 0.2,
        viewOffset: {top: 100, right: 0, bottom: 0, left: 0},
        mobile: false
    });

    /*
     * Manage progress bar
     */

    let pBar = $('#progress');

    function resetProgress() {
        pBar.stop();
        pBar.attr('value', 0);
    }

    function setProgress(percentage, duration = 200) {
        pBar.stop();
        pBar.animate(
            {value: percentage},
            {
                duration: duration,
                step: function (now) {
                    $(this).attr("value", now);
                }
            }
        );
    }

    function enableProgressScroll()
    {
        $(window).scroll(function () {
            let s = $(this).scrollTop(),
                d = $(document).height() - $(window).height(),
                scrollPercent = (s / d) * 100;
            setProgress(scrollPercent);
        });
    }

    function disableProgressScroll()
    {
        $(window).off('scroll');
    }

    /*
     * Manage navigation and mobile menu
     */

    let navMenu = $("#navigation .navbar-menu");
    let navBurgher = $("#navigation .navbar-burger");
    let navLinks = $("a[id^='nav-']");

    navBurgher.click(function (e) {
        navMenu.toggle();
    });

    function setActive(navigationId) {
        navigationId = navigationId.replace(/ .*/,''); // Remove extra words
        navLinks.removeClass('is-active');

        let current = jQuery.grep(navLinks, function (element) {
            return element.id === 'nav-' + navigationId;
        });

        $(current).addClass('is-active');
    }

    Barba.Dispatcher.on('linkClicked', function (element, mouseEvent) {
        resetProgress();
        disableProgressScroll();
    });

    Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, container) {
        gtag('config', 'UA-107667698-1', {
            'page_title' : document.title,
            'page_path': location.pathname,
            'page_location' : location.href
        });

        setActive(currentStatus.namespace);
        navMenu.hide();

        // won't automatically scroll to top
        window.scrollTo(0, 0);
    });

    Barba.Dispatcher.on('transitionCompleted', function (currentStatus, oldStatus, container) {
        resetProgress();

        if (currentStatus.namespace.indexOf('article') !== -1){
            enableProgressScroll();
        }else{
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

    new Typed('#typed', {
        stringsElement: '#typed-strings',
        typeSpeed: 50,
        startDelay: 500,
        backSpeed: 80,
        backDelay: 1000,
        loop: true
    });
});