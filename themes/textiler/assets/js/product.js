// Debug

$.request('Cart::onGetCartData', {
    complete: ({responseJSON}) => {
        console.log( responseJSON );
    }
});


// Event add product to cart
$(document).on('click', '.btn-add-to-cart', (e) => {
    const button = $(e.currentTarget),
        form = button.parents('.product-wrapper');
    let data = {
        'cart': [
            {
                'offer_id': form.find('input[name="offer_id"]').val(),
                'quantity': form.find('input[name="quantity"]').val(),
            },
        ]
    };
    addOfferToCart(form, button, data);
});

// Add product to cart
function addOfferToCart(form, button, data) {
    $.request('Cart::onAdd', {
        'data': data,
        'update': {'cart/count': '.header-cart'},
    });
}
