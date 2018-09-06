/* globals Typed */

const TypedComponent = {
  typed: null,

  settings: {
    stringsElement: '#typed-strings',
    typeSpeed: 50,
    startDelay: 500,
    backSpeed: 80,
    backDelay: 1000,
    loop: true,
  },

  init() {
    if (this.typed === null) {
      this.typed = new Typed('#typed', this.settings);
    }
  },

  destroy() {
    if (this.typed !== null) {
      this.typed.destroy();
      this.typed = null;
    }
  },
};

export default TypedComponent;
