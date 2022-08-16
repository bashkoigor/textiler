// Event remove product from cart
$(document).on('click', '.remove', (e) => {
    const button = $(e.currentTarget),
        form = button.parents('.cart-item');
    let data = {
        'cart': [
            form.find('input[name="offer_id"]').val()
        ]
    };
    $.request('Cart::onRemove', {
        'data': data,
        'update': {
            'cart/list': '.cart-items',
            'cart/summary': '.cart-summary',
            'cart/count': '.header-cart, .mobile-cart'
        },
    });
});

// Event update quantity in cart
$(document).on('click', '.product-amount-increase, .product-amount-decrease', (e) => {
    const button = $(e.currentTarget),
        form = button.parents('.cart-item');
    let data = {
        'cart': [
            {
                'offer_id': form.find('input[name="offer_id"]').val(),
                'quantity': form.find('input[name="quantity"]').val(),
            },
        ]
    };
    $.request('Cart::onUpdate', {
        'data': data,
        'update': {
            'cart/list': '.cart-items',
            'cart/summary': '.cart-summary',
            'cart/count': '.header-cart, .mobile-cart'
        },
    });
});
