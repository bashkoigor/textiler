// Open category menu
$(document).on('click', '.vertical-menu', (e) => {
    $( e.currentTarget ).find(".menu").toggleClass("show-menu");
});

// Catalog sort
$(document).on({
    mouseenter: function () {
        if ($( this ).find(".dropdown-menu ul").length) {
            $( this ).find("a").addClass('active');
        }
        $( this ).find(".dropdown-menu").css("visibility", "visible");
        $( this ).find(".dropdown-menu").css("opacity", 1);
    },
    mouseleave: function () {
        $( this ).find("a").removeClass('active');
        $( this ).find(".dropdown-menu").css("visibility", "hidden");
        $( this ).find(".dropdown-menu").css("opacity", 0);
    }
}, ".vertical-menu .menu .item");

// Recommended product carousel
const obRecommended1 = document.querySelector("#recommended1");
if (obRecommended1) {
    const recommended1 = new Carousel(obRecommended1, {
        slidesPerPage: 1,
        center: false
    });
}
const obRecommended2 = document.querySelector("#recommended2");
if (obRecommended2) {
    const recommended2 = new Carousel(obRecommended2, {
        slidesPerPage: 1,
        center: false
    });
}
const obRecommended3 = document.querySelector("#recommended3");
if (obRecommended3) {
    const recommended3 = new Carousel(obRecommended3, {
        slidesPerPage: 1,
        center: false
    });
}
const obBlog = document.querySelector("#blog-carousel");
if (obBlog) {
    const blog = new Carousel(obBlog, {
        slidesPerPage: 1,
        center: false
    });
}
// Scroll to top
window.onscroll = function() {
    if (window.pageYOffset == 0) {
        document.getElementById("to-top").style.display = "none";
    } else {
        document.getElementById("to-top").style.display = "block";
    }
}
document.getElementById("to-top").onclick = function() { scrollToTop() };
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// For product page
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

// Catalog List Grid view switcher
$("#list-view").click(function(){
    $("#grid-view").removeClass("active");
    $("#list-view").addClass("active");
    $("#grid-list").removeClass("grid");
    $("#grid-list").addClass("list");
});
$("#grid-view").click(function(){
    $("#list-view").removeClass("active");
    $("#grid-view").addClass("active");
    $("#grid-list").removeClass("list");
    $("#grid-list").addClass("grid");
});

// Decrease, increase product amount
$(document).on('click', '.product-amount-increase', (e) => {
    let x = $( e.currentTarget ).siblings(".product-amount input").val();
    $( e.currentTarget ).siblings(".product-amount input").attr('value', ++x);
});
$(document).on('click', '.product-amount-decrease', (e) => {
    let x = $( e.currentTarget ).siblings(".product-amount input").val();
    if (x > 1) {
        $( e.currentTarget ).siblings(".product-amount input").attr('value', --x);
    }
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})();

// Hide and show password
const togglePassword = document.querySelector('#togglePassword');
if (togglePassword) {
    const password = document.querySelector('#field-password');
    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        if (togglePassword.classList.contains('fa-eye-slash')) {
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        } else {
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        }
    });
}

const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
if (toggleConfirmPassword) {
    const confirmPassword = document.querySelector('#field-confirm-password');
    toggleConfirmPassword.addEventListener('click', () => {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        if (toggleConfirmPassword.classList.contains('fa-eye-slash')) {
            toggleConfirmPassword.classList.remove('fa-eye-slash');
            toggleConfirmPassword.classList.add('fa-eye');
        } else {
            toggleConfirmPassword.classList.remove('fa-eye');
            toggleConfirmPassword.classList.add('fa-eye-slash');
        }
    });
}
// Modal menu by Ajax, show categorys.
$.request('onAjax', {
    update: {
        'site/menu': '.menu-wrapper',
        'site/mobile/menu': '.mobile-menu-wrapper',
        'site/mobile/top-menu': '.mobile-page-menu-wrapper'
    }
});
