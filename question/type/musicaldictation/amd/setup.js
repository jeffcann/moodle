console.log("loaded dictation setup")

var body = document.querySelector('body');
var bodyClasses = body.classList;

if(bodyClasses.contains('tablettheme')) {
    bodyClasses.remove('sidebar-open');
    bodyClasses.remove('sidebar-pinned');

    if(window.innerWidth <= 1366) {
        var navDraw = document.querySelector('#nav-drawer');
        var navDrawClasses = navDraw.classList;
        bodyClasses.remove('drawer-open-left');
        navDrawClasses.remove('closed');
        navDrawClasses.add('closed');
        navDraw.setAttribute('aria-hidden', true);
    }
}