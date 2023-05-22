$(window).scroll(function () {
    $('nav').toggleClass('shadow-sm', $(this).scrollTop() > 10);
});