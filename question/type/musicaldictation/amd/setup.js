function resizeForDictation() {
    console.log("running resizeForDictation")

    var body = document.querySelector('body');
    var bodyClasses = body.classList;
    console.log("bodyClasses", bodyClasses)

    if (window.innerWidth <= 1366) {
        bodyClasses.remove('sidebar-open');
        bodyClasses.remove('sidebar-pinned');

        var navDraw = document.querySelector('#nav-drawer');
        var navDrawClasses = navDraw.classList;
        bodyClasses.remove('drawer-open-left');
        navDrawClasses.remove('closed');
        navDrawClasses.add('closed');
        navDraw.setAttribute('aria-hidden', true);
        console.log("navDrawClasses", navDrawClasses)
    }

    setTimeout(() => {
        document.querySelector("div[role=main]").scrollLeft = 10000;
        document.querySelector("html").scrollTop = 160;
    }, 150);
}

window.addEventListener("load", resizeForDictation, false);

