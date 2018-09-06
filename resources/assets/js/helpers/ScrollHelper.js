const ScrollHelper = {
  scrollTo: false,
  oldHeight: 0,

  setOldHeight(oldHeight) {
    this.oldHeight = oldHeight;
  },

  initHomepageScrolls() {
    $('[data-scroll]').click((e) => {
      this.scrollTo = e.currentTarget.attributes['data-scroll'].value;
    });
  },

  performScroll() {
    window.scrollTo(0, 0);

    if (this.scrollTo !== false) {
      // I have to manually calculate the current height in order
      // to scroll to the right position.
      // Please keep in mind that the current elements positions
      // aren't correct since they will include the old container's height
      const c = document.getElementById(this.scrollTo).getBoundingClientRect().top
        - this.oldHeight
        + window.scrollY;

      $('html, body').animate({
        scrollTop: c,
      }, 1000);

      this.scrollTo = false;
    }
  },
};

export default ScrollHelper;
