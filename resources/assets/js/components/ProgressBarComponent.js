const ProgressBarComponent = {
  progressBar: jQuery('#progress'),
  progressScrollEnabled: false,

  reset() {
    this.progressBar.stop();
    this.progressBar.attr('value', 0);
  },

  setValue(percentage, duration = 200) {
    this.progressBar.stop();
    this.progressBar.animate(
      { value: percentage },
      {
        duration,
        step(now) {
          $(this).attr('value', now);
        },
      },
    );

  },

  enable() {
    if (this.progressScrollEnabled) {
      return;
    }

    this.progressScrollEnabled = true;

    this.reset();

    jQuery(window).scroll(() => {
      const s = jQuery(document).scrollTop();
      const d = jQuery(document).height() - jQuery(window).height();
      let scrollPercent = (s / d) * 100;

      // When document height and window height coincide (no scrolling)
      // d will result as 0. in scrollPercent a division by zero will be performed
      // resulting in NaN value. I preferred to write a catch all NaN.
      if (Number.isNaN(scrollPercent)) {
        scrollPercent = 0;
      }

      this.setValue(scrollPercent);
    });
  },

  disable() {
    if (!this.progressScrollEnabled) {
      return;
    }

    this.progressScrollEnabled = false;

    this.reset();

    jQuery(window).off('scroll');
  },
};

export default ProgressBarComponent;
