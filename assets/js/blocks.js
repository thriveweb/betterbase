/*-----------------------------------------------------------------------
    Init global block setting fields
-----------------------------------------------------------------------*/

(function (wp) {
    const { addFilter } = wp.hooks;
    const { createHigherOrderComponent } = wp.compose;
    const { createElement, Fragment } = wp.element;
    const { InspectorControls } = wp.blockEditor;
    const { PanelBody, SelectControl, RangeControl, BaseControl, ColorPalette } = wp.components;

    const config = window.betterbaseBlocks || {};
    const allowedBlocks = config.allowedBlocks || [];
    const backgroundColors = config.backgroundColors || [];

    const containerOptions = [
        { label: "Extra Small", value: "xs" },
        { label: "Small", value: "sm" },
        { label: "Medium", value: "md" },
        { label: "Large", value: "lg" },
        { label: "Full Width", value: "xl" },
    ];

    function getBackgroundHex(slug) {
        const match = backgroundColors.find(function (color) {
            return color.slug === (slug || "none");
        });

        return match ? match.color : backgroundColors[0] && backgroundColors[0].color;
    }

    function getBackgroundSlug(hex) {
        const match = backgroundColors.find(function (color) {
            return color.color && hex && color.color.toLowerCase() === hex.toLowerCase();
        });

        return match ? match.slug : "none";
    }

    const globalBlockFields = createHigherOrderComponent(function (BlockEdit) {
        return function (props) {
            const { attributes, setAttributes, name } = props;

            if (!allowedBlocks.includes(name)) {
                return createElement(BlockEdit, props);
            }

            return createElement(
                Fragment,
                null,

                createElement(
                    InspectorControls,
                    null,

                    createElement(
                        PanelBody,
                        {
                            title: "Block Settings",
                            initialOpen: false,
                        },

                        createElement(
                            BaseControl,
                            {
                                label: "Background Colour",
                                id: "betterbase-block-background-colour",
                            },
                            createElement(ColorPalette, {
                                colors: backgroundColors,
                                value: getBackgroundHex(attributes.settings_background_color),
                                disableCustomColors: true,
                                clearable: false,
                                onChange: function (hex) {
                                    setAttributes({
                                        settings_background_color: getBackgroundSlug(hex) || "none",
                                    });
                                },
                            }),
                        ),

                        createElement(SelectControl, {
                            label: "Container Size",
                            value: attributes.settings_container || "",
                            options: containerOptions,
                            onChange: function (value) {
                                setAttributes({
                                    settings_container: value,
                                });
                            },
                        }),

                        createElement(RangeControl, {
                            label: "Padding Top",
                            value: attributes.settings_padding_top ?? 0,
                            onChange: function (value) {
                                setAttributes({
                                    settings_padding_top: value,
                                });
                            },
                            min: 0,
                            max: 300,
                            step: 10,
                        }),

                        createElement(RangeControl, {
                            label: "Padding Bottom",
                            value: attributes.settings_padding_bottom ?? 0,
                            onChange: function (value) {
                                setAttributes({
                                    settings_padding_bottom: value,
                                });
                            },
                            min: 0,
                            max: 300,
                            step: 10,
                        }),
                    ),

                    name === "acf/block-multicolumn" &&
                        createElement(
                            PanelBody,
                            {
                                title: "Multicolumn Settings",
                                initialOpen: false,
                            },

                            createElement(RangeControl, {
                                label: "Column Count",
                                value: attributes.multicolumn_count || 2,
                                onChange: function (value) {
                                    setAttributes({
                                        multicolumn_count: value,
                                    });
                                },
                                min: 1,
                                max: 6,
                                step: 1,
                            }),

                            createElement(SelectControl, {
                                label: "Column Alignment",
                                value: attributes.multicolumn_alignment || "",
                                options: [
                                    { label: "Top", value: "align-start" },
                                    { label: "Centre", value: "align-center" },
                                    { label: "Bottom", value: "align-end" },
                                ],
                                onChange: function (value) {
                                    setAttributes({
                                        multicolumn_alignment: value,
                                    });
                                },
                            }),
                        ),
                ),

                createElement(BlockEdit, props),
            );
        };
    }, "globalBlockFields");

    addFilter("editor.BlockEdit", "betterbase/custom-fields", globalBlockFields);
})(window.wp);

/*-----------------------------------------------------------------------
    Init block preview Swipers (autoplay disabled in editor)
-----------------------------------------------------------------------*/

jQuery(document).ready(function ($) {
    function betterbaseInitBlockSwipers($scope) {
        if (typeof Swiper === "undefined") {
            return;
        }

        $scope = $scope && $scope.length ? $scope : $(document);

        $scope.find(".carousel-gallery").each(function (index, element) {
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

        $scope.find(".carousel-split-gallery").each(function (index, element) {
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

        $scope.find(".carousel-testimonials").each(function (index, element) {
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

        $scope.find(".carousel-logo-slider").each(function (index, element) {
            if (element.swiper) {
                return;
            }

            new Swiper(element, {
                loop: true,
                slidesPerView: 2,
                spaceBetween: 32,
                speed: 600,
                allowTouchMove: true,
                autoplay: false,
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

    betterbaseInitBlockSwipers($(document));

    if (window.acf) {
        window.acf.addAction("render_block_preview", function ($block) {
            betterbaseInitBlockSwipers($block);
        });
    }
});
