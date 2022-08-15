// Debug
$.request('Cart::onGetCartData', {
    complete: ({responseJSON}) => {
        //console.log( responseJSON );
    }
});

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
    }, 500);
}


