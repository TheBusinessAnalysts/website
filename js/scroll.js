$(window).scroll(function () {
    if ($(document).scrollTop() > 650) {
        $('nav').addClass('shrink');
    } else {
        $('nav').removeClass('shrink');
    }
});