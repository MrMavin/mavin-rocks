/* globals ScrollReveal */

const ScrollRevealComponent = {
  scrollReveal: ScrollReveal({
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
  }),

  init() {
    this.scrollReveal.reveal('.sr .section');
    this.scrollReveal.reveal('.sr .card');
    this.scrollReveal.reveal('.sr-p *');
    this.scrollReveal.reveal('.sr-c .container');
    this.scrollReveal.reveal('.sr-col .column');
  },

  sync() {
    this.scrollReveal.sync();
  },
};

export default ScrollRevealComponent;
