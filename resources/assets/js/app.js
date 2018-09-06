import ScrollRevealComponent from './components/ScrollRevealComponent';
import TypedComponent from './components/TypedComponent';
import ProgressBarComponent from './components/ProgressBarComponent';
import MenuHelper from './helpers/MenuHelper';
import ScrollHelper from './helpers/ScrollHelper';

/* globals Barba */

$(document).ready(() => {
  Barba.Dispatcher.on('newPageReady', (currentStatus, oldStatus, container) => {
    MenuHelper.setActive(currentStatus.namespace);

    if (currentStatus.namespace === 'home') {
      TypedComponent.init();

      ScrollHelper.initHomepageScrolls();
    } else {
      TypedComponent.destroy();
    }

    ScrollHelper.performScroll();

    ScrollHelper.setOldHeight(container.getBoundingClientRect().height);
  });

  Barba.Dispatcher.on('transitionCompleted', (currentStatus) => {
    if (currentStatus.namespace.includes('article')) {
      ProgressBarComponent.enable();
    } else {
      ProgressBarComponent.disable();
    }

    ScrollRevealComponent.sync();
  });

  Barba.Pjax.start();

  ScrollRevealComponent.init();
});
