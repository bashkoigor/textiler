// Debug
$.request('Cart::onGetCartData', {
    complete: ({responseJSON}) => {
        //console.log( responseJSON );
    }
});

// For product page
productCarousel();
function productCarousel() {
    if (document.querySelector(".product")) {
        // Product Carousel
        const productCarousel = new Carousel(document.querySelector("#product-carousel"), {
            Dots: false,
        });
        const thumbCarousel = new Carousel(document.querySelector("#product-thumb-carousel"), {
            Sync: {
                target: productCarousel,
                friction: 0,
            },
            Dots: false,
            Navigation: false,
            center: true,
            slidesPerPage: 1,
            infinite: false,
        });
    }
}

// Show gallery
window.onload = function (e) {
    document.getElementById("product-gallery").classList.remove('invisible-block');
    document.getElementById("product-gallery").classList.add('visible-block');
}

// Event set offer id for color picker
$(document).on('click', '.field-color-picker li span', (e) => {
    let offerId = $(e.currentTarget).data("offerid");
    setOffer(offerId);
});

// Event set offer id for select
$(document).on('change', '.field-select', (e) => {
    let offerId = $(e.currentTarget).val();
    setOffer(offerId);
});

// Set offer id
function setOffer(offerId) {
    $.request('onInit', {
        data: {'offerId': offerId},
        update: {
            'product/card': '.product-wrapper'
        }
    });
    setTimeout(function(){
        productCarousel();
        document.getElementById("product-gallery").classList.remove('invisible-block');
        document.getElementById("product-gallery").classList.add('visible-block');
    }, 500);
}


