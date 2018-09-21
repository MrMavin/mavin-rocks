const MenuHelper = {
    navigation: document.querySelector('#navigation'),
    navigationMenu: document.querySelector('#navigation .navbar-menu'),
    navigationBurger: $('#navigation .navbar-burger'),
    navigationLinks: $("a[id^='nav-']"),

    setActive(navigationId) {
        const navWithoutExtraWords = navigationId.replace(/ .*/, ''); // Remove extra words
        this.navigationLinks.removeClass('is-active');

        const current = jQuery.grep(this.navigationLinks, element => element.id === `nav-${navWithoutExtraWords}`);

        $(current).addClass('is-active');

        this.closeMenu();
    },

    closeMenu() {
        if (this.navigation.classList.contains('closed')){
            return;
        }

        this.navigation.classList.remove('open');
        this.navigation.classList.add('closing');

        setTimeout(() => {
            this.navigation.classList.remove('closing');
            this.navigation.classList.add('closed')
        }, 300)
    },

    openMenu() {
        this.navigation.classList.remove('closed');
        this.navigation.classList.add('open');
    }
};

MenuHelper.navigationBurger.click(() => {
    MenuHelper.navigation.classList.contains('closed') ? MenuHelper.openMenu() : MenuHelper.closeMenu();
});

export default MenuHelper;
