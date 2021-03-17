$(document).ready(function() {

    // top sale owl carousel
    $("#top-sale .owl-carousel").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        autoplay:true,
        margin: 20,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
    $('.banner1  .owl-carousel').owlCarousel({


        autoplay: true,
        loop:true,
        items:1


    });
    $('.banner2  .owl-carousel').owlCarousel({
        nav: false,
        loop: true,
        autoplay: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 4
            }
        }
    });
    $('.tech  .owl-carousel').owlCarousel({
        nav: false,
        loop: true,
        autoplay: true,
        margin: 10,
        border_radius: 10,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    });
    // isotope filter
    var $grid = $(".grid").isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    });

    // filter items on button click
    $(".button-group").on("click", "button", function() {
        var filterValue = $(this).attr('data-filter');
        
        $grid.isotope({ filter: filterValue });
    })
});


