jQuery(document).ready(function ($) {
    /*-----------------------------------------------------------------------
        Customise AJAX 'Add to cart' buttons
    -----------------------------------------------------------------------*/

    $(document.body).on("added_to_cart", function (event, fragments, cart_hash, $button) {
        $(".wc-forward.added_to_cart").addClass("button");
    });

    /*-----------------------------------------------------------------------
        Customise default quantity selectors
    -----------------------------------------------------------------------*/

    function updateQuantityInput($input, operation) {
        var currentValue = parseInt($input.val(), 10);
        var minValue = parseInt($input.attr("min"), 10);
        var maxValue = parseInt($input.attr("max"), 10);

        if (operation === "increment" && (isNaN(maxValue) || currentValue < maxValue)) {
            $input.val(currentValue + 1);
        } else if (operation === "decrement" && (isNaN(minValue) || currentValue > minValue)) {
            $input.val(currentValue - 1);
        }

        $input.trigger("change");
    }

    $(document).on("click", ".increment", function () {
        updateQuantityInput($(this).siblings("input.qty"), "increment");
    });

    $(document).on("click", ".decrement", function () {
        updateQuantityInput($(this).siblings("input.qty"), "decrement");
    });

    var $quantityInput = $(".woocommerce-page form input.qty");
    if ($quantityInput.is(":hidden")) {
        $quantityInput.parent().addClass("quantity-hidden");
    }

    /*-----------------------------------------------------------------------
        Init Swiper
    -----------------------------------------------------------------------*/

    if (typeof Swiper === "undefined") {
        return;
    }

    $(".carousel-product-gallery").each(function (index, element) {
        if (element.swiper) {
            return;
        }

        var $slider = $(element);
        var thumbsEl = $slider.siblings(".carousel-product-gallery-thumbs")[0];
        var thumbs = null;

        if (thumbsEl && !thumbsEl.swiper) {
            thumbs = new Swiper(thumbsEl, {
                slidesPerView: "auto",
                spaceBetween: 4,
                watchSlidesProgress: true,
                observer: true,
                observeParents: true,
            });
        } else if (thumbsEl) {
            thumbs = thumbsEl.swiper;
        }

        var mainOptions = {
            slidesPerView: 1,
            watchOverflow: true,
            observer: true,
            observeParents: true,
        };

        if (thumbs) {
            mainOptions.thumbs = {
                swiper: thumbs,
            };
        }

        new Swiper(element, mainOptions);
    });

    $(".carousel-products").each(function (index, element) {
        if (element.swiper) {
            return;
        }

        var $slider = $(element);

        new Swiper(element, {
            loop: false,
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: {
                el: $slider.find(".swiper-pagination")[0],
                clickable: true,
                type: "progressbar",
            },
            navigation: {
                prevEl: $slider.find(".swiper-nav-prev")[0],
                nextEl: $slider.find(".swiper-nav-next")[0],
            },
            breakpoints: {
                0: {
                    slidesPerView: 1.25,
                    centeredSlides: true,
                },
                640: {
                    slidesPerView: 2,
                    centeredSlides: false,
                },
                860: {
                    slidesPerView: 3,
                    centeredSlides: false,
                },
            },
        });
    });
});
