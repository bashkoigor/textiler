// Debug
$.request('Cart::onGetCartData', {
    complete: ({responseJSON}) => {
        //console.log( responseJSON );
    }
});

// Event set offer id
$(document).on('click', '.field-color-picker li span', (e) => {
    let offerId = $(e.currentTarget).data("offerid");
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
}


