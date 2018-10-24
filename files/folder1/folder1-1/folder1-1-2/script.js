$(window).scroll(function () {
    if ($(window).scrollTop() > 10) {
        $('.navbar').css('background','rgba(0,0,0,85%)');
        $('.navbar').css('margin-top', '0px');
    } else {
        $('.navbar').css('background','transparent');
        $('.navbar').css('margin-top', '20px');
    }
});