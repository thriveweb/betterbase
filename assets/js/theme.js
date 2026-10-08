jQuery(document).ready(function ($) {
    /*-----------------------------------------------------------------------
        Calculate notice height and update CSS variable
    -----------------------------------------------------------------------*/

    $(window).on("load resize", function () {
        var root = document.querySelector(":root");
        var notice_height = $("header .site-notice").outerHeight();
        if (notice_height > 0) {
            root.style.setProperty("--notice-height", notice_height + "px");
        } else {
            root.style.setProperty("--notice-height", "0px");
        }
    });

    /*-----------------------------------------------------------------------
        Init header scripts
    -----------------------------------------------------------------------*/

    /* Toggle fixed header on scroll */

    $(window).scroll(function () {
        if ($(window).scrollTop() >= 100) {
            $("body").addClass("is-scrolled");
        } else {
            $("body").removeClass("is-scrolled");
        }
    });

    /* Toggle responsive menu on hamburger click */

    $(".trigger-menu").on("click", function () {
        var isOpen = $("body").toggleClass("has-active-menu").hasClass("has-active-menu");
        $(this).attr("aria-expanded", isOpen ? "true" : "false");
        $("#site-responsive-menu").attr("aria-hidden", isOpen ? "false" : "true");
    });

    /* Toggle responsive submenus on click */

    $(".site-responsive-menu li.menu-item-has-children > a").on("click", function (e) {
        var $link = $(this);
        var href = $link.attr("href");

        if (href !== "#" && !$(e.target).closest(".trigger-sub-menu").length) {
            return;
        }

        var $item = $link.parent();
        var isOpen = !$item.hasClass("has-active-sub-menu");
        $item.toggleClass("has-active-sub-menu", isOpen);
        $link.attr("aria-expanded", isOpen ? "true" : "false");
        $link.find(".trigger-sub-menu").attr("aria-expanded", isOpen ? "true" : "false");

        e.stopPropagation();
        e.preventDefault();
    });

    /* Toggle search form on click */

    $(".trigger-search, .site-search .close-search").on("click", function () {
        $(".site-search").slideToggle(200);
    });

    /*-----------------------------------------------------------------------
        Copy to clipboard on click
    -----------------------------------------------------------------------*/

    function clipboardCopy() {
        $(".copy-to-clipboard").on("click", function (e) {
            e.preventDefault();

            var $button = $(this);
            var $tooltip = $button.find(".tooltip");
            var value = $button.attr("data-url");

            if (!value || !navigator.clipboard) {
                return;
            }

            navigator.clipboard.writeText(value);
            $tooltip.html("Copied!");
        });

        $(".copy-to-clipboard").on("mouseleave", function () {
            var $tooltip = $(this).find(".tooltip");

            setTimeout(function () {
                $tooltip.html("Copy to clipboard");
            }, 250);
        });
    }
    clipboardCopy();

    /*-----------------------------------------------------------------------
        Init popups
    -----------------------------------------------------------------------*/

    function initPopups() {
        $(".trigger-popup").each(function () {
            var trigger = $(this).attr("data-popup-id");
            var $modal = $("#" + trigger);

            if (!$modal.length) {
                return;
            }

            $modal.appendTo(".site-popups");

            $(this).on("click", function () {
                $modal.show();
            });

            $modal.find(".close-popup").on("click", function () {
                $modal.hide();
            });

            $modal.find(".popup-overlay").on("click", function (e) {
                if (e.target !== this) {
                    return;
                }
                $modal.hide();
            });
        });

        $(document).on("keydown", function (e) {
            if (e.key === "Escape") {
                $(".site-popups .popup:visible, .site-popups [id]:visible").hide();
            }
        });
    }
    initPopups();

    /*-----------------------------------------------------------------------
        Init accordions
    -----------------------------------------------------------------------*/

    function toggleAccordion($trigger) {
        var $entry = $trigger.closest(".entry-accordion");
        var $panel = $entry.find(".inner-entry-content").first();
        var isOpen = !$entry.hasClass("is-active");

        $entry.toggleClass("is-active", isOpen);
        $trigger.attr("aria-expanded", isOpen ? "true" : "false");
        $panel.attr("aria-hidden", isOpen ? "false" : "true");
        $panel.not(":animated").slideToggle();
    }

    function initAccordions() {
        $(".entry-accordion").on("click", ".trigger-accordion", function (e) {
            e.preventDefault();
            toggleAccordion($(this));
        });

        $(".entry-accordion").on("keydown", ".trigger-accordion", function (e) {
            if (e.key !== "Enter" && e.key !== " ") {
                return;
            }
            e.preventDefault();
            toggleAccordion($(this));
        });
    }
    initAccordions();

    /*-----------------------------------------------------------------------
        Init video embed
    -----------------------------------------------------------------------*/

    function initVideoEmbed() {
        $(".video-wrapper").each(function () {
            var $wrapper = $(this);
            var video = $wrapper.find("video").get(0);

            if (!video) {
                return;
            }

            $wrapper.on("click", function () {
                if (!$wrapper.hasClass("is-paused")) {
                    return;
                }

                $wrapper.removeClass("is-paused");
                video.controls = true;
                video.play();
            });
        });
    }
    initVideoEmbed();

    /*-----------------------------------------------------------------------
        Init read more content
    -----------------------------------------------------------------------*/

    function initReadMore() {
        $(".toggle-read-more").on("click", function (e) {
            e.preventDefault();

            var $toggle = $(this);
            var $container = $toggle.closest(".has-read-more");
            var $short = $container.find(".short-content");
            var $full = $container.find(".full-content");

            $container.toggleClass("is-expanded");

            if ($short.length && $full.length) {
                $short.toggle();
                $full.toggle();
            }

            var toggleText = $toggle.attr("data-text");
            $toggle.attr("data-text", $toggle.text());
            $toggle.text(toggleText);
        });
    }
    initReadMore();

    /*-----------------------------------------------------------------------
        Init Swiper
    -----------------------------------------------------------------------*/

    if (typeof Swiper !== "undefined") {
        $(".carousel-gallery").each(function (index, element) {
            if (element.swiper) {
                return;
            }

            var $slider = $(element);

            new Swiper(element, {
                loop: false,
                spaceBetween: 10,
                slidesPerView: "auto",
                pagination: {
                    el: $slider.find(".swiper-pagination")[0],
                    clickable: true,
                    type: "progressbar",
                },
                navigation: {
                    prevEl: $slider.find(".swiper-nav-prev")[0],
                    nextEl: $slider.find(".swiper-nav-next")[0],
                },
            });
        });

        $(".carousel-split-gallery").each(function (index, element) {
            if (element.swiper) {
                return;
            }

            var $slider = $(element);

            new Swiper(element, {
                loop: false,
                slidesPerView: 1,
                pagination: {
                    el: $slider.find(".swiper-pagination")[0],
                    clickable: true,
                    type: "bullets",
                },
            });
        });

        $(".carousel-testimonials").each(function (index, element) {
            if (element.swiper) {
                return;
            }

            var $slider = $(element);

            new Swiper(element, {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 20,
                navigation: {
                    prevEl: $slider.find(".swiper-nav-prev")[0],
                    nextEl: $slider.find(".swiper-nav-next")[0],
                },
            });
        });

        $(".carousel-logo-slider").each(function (index, element) {
            if (element.swiper) {
                return;
            }

            var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

            new Swiper(element, {
                loop: true,
                slidesPerView: 2,
                spaceBetween: 32,
                speed: reduceMotion ? 600 : 5000,
                allowTouchMove: true,
                autoplay: reduceMotion
                    ? false
                    : {
                          delay: 0,
                          disableOnInteraction: false,
                          pauseOnMouseEnter: true,
                      },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                    782: {
                        slidesPerView: 4,
                        spaceBetween: 48,
                    },
                    1200: {
                        slidesPerView: 6,
                        spaceBetween: 56,
                    },
                },
            });
        });
    }

    /*-----------------------------------------------------------------------
        Init AOS
    -----------------------------------------------------------------------*/

    if (typeof AOS !== "undefined") {
        var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        AOS.init({
            duration: reduceMotion ? 0 : 600,
            easing: "ease",
            disable: reduceMotion,
        });
    }
});
