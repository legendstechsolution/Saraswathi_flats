/*------------------------------------------------------------------------------------
    
JS INDEX
=============

01 - Main Slider JS
02 - Testimonial JS
03 - Partner Slider JS
04 - Project Slider JS
05 - Responsive Menu
06 - Site Preloader
07 - Back To Top


-------------------------------------------------------------------------------------*/


(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {

		/* 
		=================================================================
		01 - Main Slider JS
		=================================================================	
		*/

		$(".construct-slide").owlCarousel({
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			items: 1,
			nav: true,
			dots: false,
			autoplay: true,
			loop: true,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			mouseDrag: false,
			touchDrag: false
		});

		$(".construct-slide").on("translate.owl.carousel", function () {
			$(".construct-main-slide h2, .construct-main-slide p").removeClass("animated fadeInUp").css("opacity", "0");
			$(".construct-main-slide .construct-btn").removeClass("animated fadeInDown").css("opacity", "0");
		});
		$(".construct-slide").on("translated.owl.carousel", function () {
			$(".construct-main-slide h2, .construct-main-slide p").addClass("animated fadeInUp").css("opacity", "1");
			$(".construct-main-slide .construct-btn").addClass("animated fadeInDown").css("opacity", "1");
		});


		/* 
		=================================================================
		02 - Testimonial JS
		=================================================================	
		*/

		$(".testimonial-slide").owlCarousel({
			autoplay: true,
			loop: true,
			margin: 20,
			touchDrag: false,
			mouseDrag: false,
			items: 1,
			nav: false,
			dots: true,
			autoplayTimeout: 6000,
			autoplaySpeed: 1200,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});

		/* 
		=================================================================
		03 - Partner Slider JS
		=================================================================	
		*/
		$(".partners-slider").owlCarousel({
			autoplay: true,
			loop: true,
			margin: 20,
			touchDrag: true,
			mouseDrag: true,
			nav: false,
			dots: false,
			autoplayTimeout: 6000,
			autoplaySpeed: 1200,
			autoplayHoverPause: true,
			responsive: {
				0: {
					items: 2
				},
				480: {
					items: 2
				},
				600: {
					items: 4
				},
				1000: {
					items: 5
				},
				1200: {
					items: 5
				}
			}
		});


		/* 
		=================================================================
		04 - Project Slider JS
		=================================================================	
		*/

		$(".project-slider").owlCarousel({
			autoplay: true,
			loop: true,
			touchDrag: false,
			mouseDrag: false,
			items: 1,
			nav: true,
			dots: false,
			autoplayTimeout: 6000,
			autoplaySpeed: 1200,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
		});


		/* 
		=================================================================
		05 - Responsive Menu
		=================================================================	
		*/
		$("ul#construct_navigation").slicknav({
			prependTo: ".construct-responsive-menu"
		});

		/* 
		=================================================================
		06 - Site Preloader
		=================================================================	
		*/

		if ($("#preloader").length) {
			(function () {
				var myDiv = document.getElementById("preloader"),
					show = function () {
						myDiv.style.opacity = "1";
						setTimeout(hide, 3000); // 3 seconds
					},
					hide = function () {
						jQuery(".construct-site-preloader").fadeOut(1000);
					};
				show();
			})();
		}

		/* 
		=================================================================
		07 - Back To Top
		=================================================================	
		*/
		if ($("body").length) {
			var btnUp = $('<div/>', {
				'class': 'btntoTop'
			});
			btnUp.appendTo('body');
			$(document).on('click', '.btntoTop', function () {
				$('html, body').animate({
					scrollTop: 0
				}, 700);
			});
			$(window).on('scroll', function () {
				if ($(this).scrollTop() > 200) $('.btntoTop').addClass('active');
				else $('.btntoTop').removeClass('active');
			});
		}

	});
}(jQuery));
