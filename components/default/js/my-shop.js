$(document).ready(function () {
    $("#owl-demo").owlCarousel({
        autoPlay: 10000,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        pagination: false
    });
    
    $("#owl-discount").owlCarousel({
        autoPlay: 10000,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        pagination: false
    });

    $("#owl-cat-product").owlCarousel({
        autoPlay: false,
        items: 8,
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [979, 5],
        itemsTablet: [768, 4],
        itemsMobile: [600, 3],
        pagination: false,
        navigation: true
    });

    $('.owl-prev').html("");
    $('.owl-prev').append("<i class='fa fa-angle-left' aria-hidden='true'></i>");
    $('.owl-next').html("");
    $('.owl-next').append("<i class='fa fa-angle-right' aria-hidden='true'></i>");
});

