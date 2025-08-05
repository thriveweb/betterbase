jQuery(document).ready(function ($) {
   var initializeBlock = function ($block) {
      /*-----------------------------------------------------------------------
         Init Swiper
      -----------------------------------------------------------------------*/

      $('.carousel-gallery').each(function (index, element) {
         const $slider = $(element);
         const $pagination = $slider.find('.swiper-pagination');
         const $navPrev = $slider.find('.swiper-nav-prev');
         const $navNext = $slider.find('.swiper-nav-next');
         new Swiper(element, {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 'auto',
            centeredSlides: true,
            pagination: {
               el: $pagination[0],
               clickable: true,
            },
            navigation: {
               prevEl: $navPrev[0],
               nextEl: $navNext[0],
            },
         });
      });

      $('.carousel-reviews').each(function (index, element) {
         const $slider = $(element);
         const $navPrev = $slider.find('.swiper-nav-prev');
         const $navNext = $slider.find('.swiper-nav-next');
         new Swiper(element, {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
               prevEl: $navPrev[0],
               nextEl: $navNext[0],
            },
         });
      });
   };

   if (window.acf) {
      window.acf.addAction('render_block_preview', initializeBlock);
   } else {
      initializeBlock();
   }
});

/*-----------------------------------------------------------------------
Init Global Block Settings
-----------------------------------------------------------------------*/

(function (wp) {
   const { addFilter } = wp.hooks;
   const { createHigherOrderComponent } = wp.compose;
   const { createElement, Fragment } = wp.element;
   const { InspectorControls } = wp.blockEditor;
   const { PanelBody, SelectControl, RangeControl, TextControl, ButtonGroup, Button } = wp.components;

   const allowedBlocks = [
      'acf/block-content',
      'acf/block-multicolumn',
      'acf/block-buttons',
      'acf/block-accordion',
      'acf/block-image-gallery',
      'acf/block-video',
      'acf/block-separator',
      'acf/block-hero-banner',
      'acf/block-page-banner',
      'acf/block-split-content',
      'acf/block-reviews',
      'acf/block-post-feed',
      'acf/block-contact-form',
   ];

   const globalBlockFields = createHigherOrderComponent(function (BlockEdit) {
      return function (props) {
         const { attributes, setAttributes, isSelected, name } = props;

         if (!allowedBlocks.includes(name)) {
            return createElement(BlockEdit, props);
         }

         if (!isSelected) {
            return createElement(BlockEdit, props);
         }

         return createElement(
            Fragment,
            null,
            createElement(
               InspectorControls,
               null,
               // Create fields for all blocks
               createElement(
                  PanelBody,
                  { title: 'Block Settings' },
                  createElement(SelectControl, {
                     label: 'Background Colour',
                     value: attributes.settings_background_colour || '',
                     options: [
                        { label: 'None', value: 'none' },
                        { label: 'Grey (#AAAAAA)', value: 'grey' },
                        { label: 'Black (#000000)', value: 'black' },
                     ],
                     onChange: function (value) {
                        setAttributes({ settings_background_colour: value });
                     },
                  }),
                  createElement(SelectControl, {
                     label: 'Container Size',
                     value: attributes.settings_container || '',
                     options: [
                        { label: 'Extra Small (620px)', value: 'xs' },
                        { label: 'Small (820px)', value: 'sm' },
                        { label: 'Default (1040px)', value: 'md' },
                        { label: 'Large (1240px)', value: 'lg' },
                        { label: 'Full Width', value: 'xl' },
                     ],
                     onChange: function (value) {
                        setAttributes({ settings_container: value });
                     },
                  }),
                  createElement(RangeControl, {
                     label: 'Padding Top',
                     value: attributes.settings_padding_top || 0,
                     onChange: function (value) {
                        setAttributes({ settings_padding_top: value });
                     },
                     min: 0,
                     max: 300,
                     step: 10,
                  }),
                  createElement(RangeControl, {
                     label: 'Padding Bottom',
                     value: attributes.settings_padding_bottom || 0,
                     onChange: function (value) {
                        setAttributes({ settings_padding_bottom: value });
                     },
                     min: 0,
                     max: 300,
                     step: 10,
                  })
               ),
               // Create fields specific to 'multicolumn' block
               name === 'acf/block-multicolumn' &&
                  createElement(
                     PanelBody,
                     { title: 'Multicolumn Settings', initialOpen: false },
                     createElement(RangeControl, {
                        label: 'Column Count',
                        value: attributes.multicolumn_count || 2,
                        onChange: function (value) {
                           setAttributes({ multicolumn_count: value });
                        },
                        min: 1,
                        max: 6,
                        step: 1,
                     }),
                     attributes.multicolumn_count === 2 &&
                        createElement(SelectControl, {
                           label: 'Column Style',
                           value: attributes.multicolumn_style || '',
                           options: [
                              { label: 'Equal Width', value: 'equal' },
                              { label: 'Sidebar Left', value: 'sidebar-left' },
                              { label: 'Sidebar Right', value: 'sidebar-right' },
                           ],
                           onChange: function (value) {
                              setAttributes({ multicolumn_style: value });
                           },
                        }),
                     createElement(SelectControl, {
                        label: 'Column Alignment',
                        value: attributes.multicolumn_alignment || '',
                        options: [
                           { label: 'Top', value: 'align-start' },
                           { label: 'Center', value: 'align-center' },
                           { label: 'Bottom', value: 'align-end' },
                        ],
                        onChange: function (value) {
                           setAttributes({ multicolumn_alignment: value });
                        },
                     })
                  )
            ),
            createElement(BlockEdit, props)
         );
      };
   }, 'globalBlockFields');

   const blockSettingDefaults = {
      'acf/block-hero-banner': {
         padding_top: 220,
         padding_bottom: 220,
      },
      'acf/block-image-gallery': {
         container: 'xl',
      },
      'acf/block-page-banner': {
         padding_top: 120,
         padding_bottom: 120,
      },
      'acf/block-reviews': {
         container: 'sm',
      },
      'acf/block-separator': {
         background: 'black',
         container: 'xl',
         padding_top: 0,
         padding_bottom: 0,
      },
      'acf/block-video': {
         container: 'sm',
      },
   };

   function addCustomAttributes(settings, name) {
      if (!allowedBlocks.includes(name)) {
         return settings;
      }

      const getDefault = (setting, standardDefault) => blockSettingDefaults[name]?.[setting] ?? standardDefault;

      if (typeof settings.attributes !== 'undefined') {
         settings.attributes = Object.assign(settings.attributes, {
            // Add default values to all blocks
            settings_background_colour: {
               type: 'string',
               default: getDefault('background', 'none'),
            },
            settings_container: {
               type: 'string',
               default: getDefault('container', 'md'),
            },
            settings_padding_top: {
               type: 'number',
               default: getDefault('padding_top', 80),
            },
            settings_padding_bottom: {
               type: 'number',
               default: getDefault('padding_bottom', 80),
            },
            // Add default values specific to 'multicolumn' block
            ...(name === 'acf/block-multicolumn' && {
               multicolumn_count: {
                  type: 'number',
                  default: 2,
               },
               multicolumn_alignment: {
                  type: 'string',
                  default: '',
               },
               multicolumn_style: {
                  type: 'string',
                  default: '',
               },
            }),
         });
      }
      return settings;
   }

   addFilter('blocks.registerBlockType', 'betterbase/custom-attributes', addCustomAttributes);
   addFilter('editor.BlockEdit', 'betterbase/custom-fields', globalBlockFields);
})(window.wp);
