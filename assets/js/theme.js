jQuery(document).ready(function ($) {
   /*-----------------------------------------------------------------------
      Calculate notice height and update CSS variable
   -----------------------------------------------------------------------*/

   $(window).on('load resize', function () {
      var root = document.querySelector(':root');
      var notice_height = $('header .site-notice').outerHeight();
      if (notice_height > 0) {
         root.style.setProperty('--notice-height', notice_height + 'px');
      } else {
         root.style.setProperty('--notice-height', '0px');
      }
   });

   /*-----------------------------------------------------------------------
      Init header scripts
   -----------------------------------------------------------------------*/

   /* Toggle fixed header on scroll */

   $(window).scroll(function () {
      if ($(window).scrollTop() >= 100) {
         $('body').addClass('is-scrolled');
      } else {
         $('body').removeClass('is-scrolled');
      }
   });

   /* Toggle responsive menu on hamburger click */

   $('.trigger-menu').on('click', function () {
      $('body').toggleClass('menu-active');
   });

   /* Toggle responsive submenus on click */

   $('.site-responsive-menu li.menu-item-has-children > a > .trigger-sub-menu').on('click', function (e) {
      if ($(this).next('.sub-menu-').is(':visible')) {
         $(this).parent().parent().removeClass('sub-menu-active');
      } else {
         $(this).parent().parent().toggleClass('sub-menu-active');
      }
      e.stopPropagation();
      e.preventDefault();
   });

   /* Toggle search form on click */

   $('.trigger-search, .site-search .close-search').click(function () {
      $('.site-search').slideToggle(200);
   });

   /*-----------------------------------------------------------------------
      Init popups
   -----------------------------------------------------------------------*/

   function initPopups() {
      $('.trigger-popup').each(function (i) {
         let trigger = $(this).attr('data-popup-id');
         let modal = $('#' + trigger);

         $(modal).appendTo('.site-popups');

         $(this).click(function () {
            $(modal).show();
         });

         $(modal)
            .find('.close-popup')
            .click(function (e) {
               $(modal).hide();
            });

         $(modal)
            .find('.popup-overlay')
            .click(function () {
               if (event.target !== this) return;
               $(modal).hide();
            });

         $(document).keydown(function (e) {
            if (e.key === 'Escape') {
               $(modal).hide();
            }
         });
      });
   }
   initPopups();

   /*-----------------------------------------------------------------------
      Init accordions
   -----------------------------------------------------------------------*/

   function initAccordions() {
      $('.entry-accordion').on('click', '.trigger-accordion', function (e) {
         e.preventDefault();
         $(this).parent().toggleClass('is-active');
         $(this).next('.wysiwyg-content').not(':animated').slideToggle();
      });
   }
   initAccordions();

   /*-----------------------------------------------------------------------
      Copy to clipboard on click
   -----------------------------------------------------------------------*/

   let clipboard = $('.copy-to-clipboard');
   let tooltip = $('.copy-to-clipboard .tooltip');

   clipboard.on('click', function (e) {
      e.preventDefault();
      let value = clipboard.attr('data-url');
      tooltip.html('Copied!');
      navigator.clipboard.writeText(value);
   });

   clipboard.on('mouseleave', function (e) {
      e.preventDefault();
      setTimeout(function () {
         if (!clipboard.is(':hover')) {
            tooltip.html('Copy to clipboard');
         }
      }, 250);
   });

   /*---------------------------------------------------------------------------
      Toggle read more content on click
   ---------------------------------------------------------------------------*/

   $('.toggle-read-more').on('click', function (e) {
      e.preventDefault();

      var toggle = $(this);
      var $container = toggle.closest('.has-read-more');
      var $short = $container.find('.short-content');
      var $full = $container.find('.full-content');

      $short.toggle();
      $full.toggle();

      var toggleText = toggle.attr('data-text');
      toggle.attr('data-text', toggle.text());
      toggle.text(toggleText);
   });

   /*---------------------------------------------------------------------------
      Toggle tab content on click
   ---------------------------------------------------------------------------*/

   $('.tab-title:not(.tab-link)').click(function (e) {
      e.preventDefault();
      let tab_id = $(this).attr('data-tab');
      $('.tab-title').removeClass('tab-active');
      $('.tab-content').removeClass('tab-active');
      $(this).addClass('tab-active');
      $('.tab-content[data-tab="' + tab_id + '"]').addClass('tab-active');
   });

   let first_tab_id = $('.tab-titles-wrap .tab-title:first').attr('data-tab');
   $('.tab-title[data-tab="' + first_tab_id + '"]').addClass('tab-active');
   $('.tab-content[data-tab="' + first_tab_id + '"]').addClass('tab-active');

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

   /*-----------------------------------------------------------------------
      Init AOS
   -----------------------------------------------------------------------*/

   // AOS.init({
   //   duration: 600,
   //   easing: 'ease',
   // });
});
