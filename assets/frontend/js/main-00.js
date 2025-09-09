$(function () {
    $('.hero-carousel').owlCarousel({
        items: 1,
        margin: 20,
        nav: false,
        dots: true,
        rtl: true 
    });


    $('.testimonials-carousel').owlCarousel({
        items: 1,
        margin: 25,
        nav: false,
        dots: true,
        rtl: true,
        responsive : {
            768: {
                items: 2,
            },
            1350: {
                items: 3,
                nav: true,
            }
        }
    });
    
});