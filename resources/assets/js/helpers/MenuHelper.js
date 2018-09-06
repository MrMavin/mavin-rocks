const MenuHelper = {
  navigationMenu: $('#navigation .navbar-menu'),
  navigationBurger: $('#navigation .navbar-burger'),
  navigationLinks: $("a[id^='nav-']"),

  setActive(navigationId) {
    const navWithoutExtraWords = navigationId.replace(/ .*/, ''); // Remove extra words
    this.navigationLinks.removeClass('is-active');

    const current = jQuery.grep(this.navigationLinks, element => element.id === `nav-${navWithoutExtraWords}`);

    $(current).addClass('is-active');

    this.navigationMenu.hide();
  },
};

MenuHelper.navigationBurger.click(() => {
  MenuHelper.navigationMenu.toggle();
});

export default MenuHelper;
