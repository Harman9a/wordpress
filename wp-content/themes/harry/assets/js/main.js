
(function ($) {
	"use strict";

	var windowOn = $(window);

	////////////////////////////////////////////////////
	// 01. PreLoader Js

	$('.preloader__logo img').addClass('logo-blink');

	(function(){
		function the_id(v){ return document.getElementById(v); }
		function tp_loadbar(isChecking) {
		  if(isChecking){
			var ovrl = the_id("loading"),
			  
			  img = document.images,
			  c = 0,
			  tot = img.length;
			  if ($("#tp-loading-line").length > 0) {
				var prog = the_id("tp-loading-line");
			  }
		  if(tot == 0) return doneLoading();
	  
		  function imgLoaded(){
			c += 1;
			var perc = ((100/tot*c) << 0) +"%";
			if ($("#tp-loading-line").length > 0) {
				prog.style.width = perc;
			}

			if(c===tot) return doneLoading();
		  }
		  function doneLoading(){
			
			setTimeout(function(){ 
				$("#loading").fadeOut(500);
			}, 100);
		  }
		  for(var i=0; i<tot; i++) {
			var tImg     = new Image();
			tImg.onload  = imgLoaded;
			tImg.onerror = imgLoaded;
			tImg.src     = img[i].src;
		  }
		  }    
		}
		document.addEventListener('load', tp_loadbar(true));
		document.addEventListener('DOMContentLoaded', tp_loadbar(false));
		
	  }());
	


	  $('.main-menu nav > ul > li').slice(-4).addClass('menu-last');

	  $(".has-mega-menu > ul").addClass("mega-menu");
	  $(".has-mega-menu ul").removeClass("submenu");
	  $(".has-mega-menu > ul > li > a").addClass("mega-menu-title");


	  var breadcrumb_icon = `
	  	<span class="breadcrumb-icon">
			<svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.8125 7.90625L3 6.9375V14C3 14.2708 3.09375 14.5 3.28125 14.6875C3.48958 14.8958 3.72917 15 4 15H7C7.27083 15 7.5 14.8958 7.6875 14.6875C7.89583 14.5 8 14.2708 8 14V10H10V14C10 14.2708 10.0938 14.5 10.2812 14.6875C10.4896 14.8958 10.7292 15 11 15H14C14.2708 15 14.5 14.8958 14.6875 14.6875C14.8958 14.5 15 14.2708 15 14V6.9375L16.1875 7.90625C16.2708 7.96875 16.375 8 16.5 8C16.6667 8 16.8021 7.9375 16.9062 7.8125C17.0938 7.54167 17.0625 7.30208 16.8125 7.09375L9.3125 1.09375C9.10417 0.947917 8.89583 0.947917 8.6875 1.09375L6 3.25V2C6 1.72917 5.89583 1.5 5.6875 1.3125C5.5 1.10417 5.27083 1 5 1C4.72917 1 4.48958 1.10417 4.28125 1.3125C4.09375 1.5 4 1.72917 4 2V4.84375L1.1875 7.09375C0.9375 7.30208 0.90625 7.54167 1.09375 7.8125C1.30208 8.0625 1.54167 8.09375 1.8125 7.90625ZM9 2.125L14 6.125V14H11V9H7V14H4V6.15625L9 2.125Z" fill="currentColor"></path>
			</svg>                                 
		</span>
	  `;

	  $(breadcrumb_icon).insertBefore('.tp-woo-breadcrumb__list');
	  // add class to widget ul

	  if($('div').hasClass('tp-page-content')) {
		$('.postbox__comment-wrapper').addClass('postbox__comment-style-2');
		$('blockquote').css({"box-shadow": "none", "border" : "1px solid #ddd"});
		$('.postbox__comment-box').css({"box-shadow": "none", "border-bottom" : "1px solid #ddd"});
	} 


	////////////////////////////////////////////////////
	// 02. Mobile Menu Js
	$('#mobile-menu').meanmenu({
		meanMenuContainer: '.mobile-menu',
		meanScreenWidth: "991",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});

	// home 2 activation
	$('#mobile-menu-2').meanmenu({
		meanMenuContainer: '.mobile-menu-2',
		meanScreenWidth: "999999",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});

	////////////////////////////////////////////////////
	// 02. Mobile Menu Js
	$('#mobile-menu-3').meanmenu({
		meanMenuContainer: '.mobile-menu-3',
		meanScreenWidth: "1199",
		meanExpand: ['<i class="fal fa-plus"></i>'],
	});


	$('.newsletter-popup, .newsletter-overlay').addClass('opened');

	$(".newsletter-close-btn").on("click", function () {
		$(".newsletter-popup").removeClass("opened");
		$(".newsletter-overlay").removeClass("opened");
	});

	////////////////////////////////////////////////////
	// 03. Offcanvas Js
	$(".offcanvas-open-btn").on("click", function () {
		$(".offcanvas__area").addClass("offcanvas-opened");
		$(".offcanvas__full").addClass("offcanvas-full-opened");
		$(".body-overlay").addClass("opened");
	});

	$(".offcanvas-close-btn").on("click", function () {
		$(".offcanvas__area").removeClass("offcanvas-opened");
		$(".offcanvas__full").removeClass("offcanvas-full-opened");
		$(".body-overlay").removeClass("opened");
	});

	////////////////////////////////////////////////////
	// 03. Offcanvas Js
	$(".cartmini-open-btn").on("click", function () {
		$(".cartmini__area").addClass("cartmini-opened");
		$(".body-overlay").addClass("opened");
	});

	
	$(".cartmini-close-btn").on("click", function () {
		$(".cartmini__area").removeClass("cartmini-opened");
		$(".body-overlay").removeClass("opened");
	});


	

	////////////////////////////////////////////////////
	// 03. Search Js
	$(".search-open-btn").on("click", function () {
		$(".search__popup").addClass("search-opened");
	});

	
	$(".search-close-btn").on("click", function () {
		$(".search__popup").removeClass("search-opened");
	});
	
	$(".job-form-open-btn").on("click", function () {
		$(".job__form").slideToggle("job__form");
	});
	

	// for header
	if ($("#tp-header-lang-toggle").length > 0) {
		window.addEventListener('click', function(e){
	
			if (document.getElementById('tp-header-lang-toggle').contains(e.target)){
				$(".tp-lang-list").toggleClass("tp-lang-list-open");
			}
			else{
				$(".tp-lang-list").removeClass("tp-lang-list-open");
			}
		});
	}

	// for footer
	if ($("#tp-footer-lang-toggle").length > 0) {
		window.addEventListener('click', function(e){
		
			if (document.getElementById('tp-footer-lang-toggle').contains(e.target)){
				$(".tp-lang-list-2").toggleClass("tp-lang-list-open-2");
			}
			else{
				$(".tp-lang-list-2").removeClass("tp-lang-list-open-2");
			}
		});
	}

	////////////////////////////////////////////////////
	// 04. Body overlay Js
	$(".body-overlay").on("click", function () {
		$(".offcanvas__area").removeClass("offcanvas-opened");
		$(".offcanvas__full").removeClass("offcanvas-full-opened");
		$(".cartmini__area").removeClass("cartmini-opened");
		$(".body-overlay").removeClass("opened");
	});



	function smoothSctollTop() {
		$('.smooth a').on('click', function (event) {
			var target = $(this.getAttribute('href'));
			if (target.length) {
				event.preventDefault();
				$('html, body').stop().animate({
					scrollTop: target.offset().top - 150
				}, 1000);
			}
		});
	}
	smoothSctollTop();

    

	////////////////////////////////////////////////////
	// 06. Sticky Header Js
	windowOn.on('scroll', function () {
		var scroll = $(window).scrollTop();
		if (scroll < 200) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});

	var btn = $('#back_to_top');
	var btn_wrapper = $('.back-to-top-wrapper');

	windowOn.scroll(function() {
	if (windowOn.scrollTop() > 300) {
		btn_wrapper.addClass('back-to-top-btn-show');
	} else {
		btn_wrapper.removeClass('back-to-top-btn-show');
	}
	});

	btn.on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop:0}, '300');
	});




	////////////////////////////////////////////////////
	// 07. Data CSS Js
	$("[data-background").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-background") + "  )");
	});
	$("[data-background-gradient").each(function () {
		$(this).css("background-image", $(this).attr("data-background-gradient"));
	});
	
	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});
	
	$("[data-height]").each(function () {
		$(this).css("height", $(this).attr("data-height"));
	});

	$("[data-bg-color]").each(function () {
        $(this).css("background-color", $(this).attr("data-bg-color"));
    });

	$("[data-bg]").each(function () {
        $(this).css("background", $(this).attr("data-bg"));
    });

	$("[data-padding-top]").each(function () {
        $(this).css("padding-top", $(this).attr("data-padding-top"));
    });

	$("[data-padding-bottom]").each(function () {
        $(this).css("padding-bottom", $(this).attr("data-padding-bottom"));
    });

	////////////////////////////////////////////////////
	// 07. Nice Select Js
	$('.tp-blog-area select, .tp-shop-area select, .tp-blog-area select, .slider__area select, .job__input select, .contact__area select, .footer__area select').niceSelect();


	var tp_rtl = localStorage.getItem('tp_dir');
	let rtl_setting = tp_rtl == 'rtl' ? true : false;


	////////////////////////////////////////////////////
	// 08. slider__active Slider Js
	function tp_main_slider(){
		if ($(".slider__nav-active").length > 0) {
			var slidernav = new Swiper(".slider__nav-active", {
				spaceBetween: 0,
				slidesPerView: 1,
				loop: true,
				freeMode: false,
				watchSlidesProgress: true,
				effect: 'fade',
				allowTouchMove: false,
				rtl: rtl_setting,
				navigation: {
					nextEl: ".slider-8-button-next",
					prevEl: ".slider-8-button-prev",
				},
				breakpoints: {
					'576': {
						slidesPerView: 1,
					},
					'0': {
						slidesPerView: 1,
					},
				},
			});
		}
		
		if ($(".slider__active").length > 0) {
			let sliderActive1 = ".slider__active";
			let sliderInit1 = new Swiper(sliderActive1, {
				slidesPerView: 1,
				slidesPerColumn: 1,
				paginationClickable: true,
				loop: true,
				effect: 'fade',

				// If we need pagination
				pagination: {
					el: ".main-slider-dot, .main-slider-dot-8",
					clickable: true,
					renderBullet: function (index, className) {
					
						if(index < 9){
							return '<span class="' + className + '">' + '<button>'+ '0' +(  index + 1)+'</button>' + "</span>";
						}else{
							return '<span class="' + className + '">' + '<button>'+(  index + 1)+'</button>' + "</span>";
						}
					},
				},

				// Navigation arrows
				navigation: {
					nextEl: ".slider-button-next, .slider-button-8-next",
					prevEl: ".slider-button-prev, .slider-button-8-prev",
				},

				a11y: false,
				thumbs: {
					swiper: slidernav,
				},
				rtl: rtl_setting,
			});

			function animated_swiper(selector, init) {
				let animated = function animated() {
					$(selector + " [data-animation]").each(function () {
						let anim = $(this).data("animation");
						let delay = $(this).data("delay");
						let duration = $(this).data("duration");

						$(this)
							.removeClass("anim" + anim)
							.addClass(anim + " animated")
							.css({
								webkitAnimationDelay: delay,
								animationDelay: delay,
								webkitAnimationDuration: duration,
								animationDuration: duration,
							})
							.one(
								"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
								function () {
									$(this).removeClass(anim + " animated");
								}
							);
					});
				};
				animated();
				// Make animated when slide change
				init.on("slideChange", function () {
					$(sliderActive1 + " [data-animation]").removeClass("animated");
				});
				init.on("slideChange", animated);
			}

			animated_swiper(sliderActive1, sliderInit1);
		}
	}

	function tp_architech_sllider(){
		if ($(".slider__nav-active").length > 0) {
			var slidernav = new Swiper(".slider__nav-active", {
				spaceBetween: 0,
				slidesPerView: 1,
				loop: true,
				freeMode: false,
				watchSlidesProgress: true,
				effect: 'fade',
				allowTouchMove: false,
				rtl: rtl_setting,
				navigation: {
					nextEl: ".slider-8-button-next",
					prevEl: ".slider-8-button-prev",
				},
				breakpoints: {
					'576': {
						slidesPerView: 1,
					},
					'0': {
						slidesPerView: 1,
					},
				},
			});
		}
		
		if ($(".slider__active").length > 0) {
			let sliderActive1 = ".slider__active";
			let sliderInit1 = new Swiper(sliderActive1, {
				slidesPerView: 1,
				slidesPerColumn: 1,
				paginationClickable: true,
				loop: true,
				effect: 'fade',

				// If we need pagination
				pagination: {
					el: ".main-slider-dot, .main-slider-dot-8",
					clickable: true,
					renderBullet: function (index, className) {
					
						if(index < 9){
							return '<span class="' + className + '">' + '<button>'+ '0' +(  index + 1)+'</button>' + "</span>";
						}else{
							return '<span class="' + className + '">' + '<button>'+(  index + 1)+'</button>' + "</span>";
						}
					},
				},

				// Navigation arrows
				navigation: {
					nextEl: ".slider-button-next, .slider-button-8-next",
					prevEl: ".slider-button-prev, .slider-button-8-prev",
				},

				a11y: false,
				thumbs: {
					swiper: slidernav,
				},
				rtl: rtl_setting,
			});

			function animated_swiper(selector, init) {
				let animated = function animated() {
					$(selector + " [data-animation]").each(function () {
						let anim = $(this).data("animation");
						let delay = $(this).data("delay");
						let duration = $(this).data("duration");

						$(this)
							.removeClass("anim" + anim)
							.addClass(anim + " animated")
							.css({
								webkitAnimationDelay: delay,
								animationDelay: delay,
								webkitAnimationDuration: duration,
								animationDuration: duration,
							})
							.one(
								"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
								function () {
									$(this).removeClass(anim + " animated");
								}
							);
					});
				};
				animated();
				// Make animated when slide change
				init.on("slideChange", function () {
					$(sliderActive1 + " [data-animation]").removeClass("animated");
				});
				init.on("slideChange", animated);
			}

			animated_swiper(sliderActive1, sliderInit1);
		}
	}

	var verticalslider1 = new Swiper('.slider__active-11', {
		direction: "vertical",
		slidesPerView: 1,
		spaceBetween: 0,
		effect: 'fade',
		loop: false,
		mousewheel: true,
		rtl: rtl_setting,
		pagination: {
			el: ".slider-pagination-11",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
	});
	verticalslider1.on('slideChangeTransitionStart', function (realIndex) {
        if ($('.swiper-slide.swiper-slide-active, .slider-pagination-11-light').hasClass('slider__item-11-dark')) {
            $('.header__white, .slider-pagination-11').addClass('header__white-slider slider-pagination-11-white')
        } else {
            $('.header__white, .slider-pagination-11').removeClass('header__white-slider slider-pagination-11-white');
        }
    });

	function tp_swiper_slider(){
		var verticalslider2 = new Swiper('.slider__active-12', {
			direction: "vertical",
			slidesPerView: 1,
			spaceBetween: 0,
			effect: 'fade',
			loop: true,
			mousewheel: true,
			rtl: rtl_setting,
			pagination: {
				el: '.slider-pagination-12',
				type: 'fraction',
				renderFraction: function (currentClass, totalClass) {
					return '<span class="' + currentClass + '"></span>' + ' <span class="tp-swiper-fraction-divide"></span> ' + '<span class="' + totalClass + '"></span>'; }
				},
	
			// Navigation arrows
			navigation: {
				nextEl: ".slider-button-12-next",
				prevEl: ".slider-button-12-prev",
			},
		});
		verticalslider2.on('slideChangeTransitionStart', function (realIndex) {
			if ($('.swiper-slide.swiper-slide-active').hasClass('slider__item-12-dark')) {
				$('.header__bottom-12').addClass('header__white-slider')
			} else {
				$('.header__bottom-12').removeClass('header__white-slider');
			}
		});
	}

	function tp_team(){

		var slider = new Swiper('.team__slider-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".team-slider-dot",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 3,
				},
				'576': {
					slidesPerView: 2,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});

		var slider = new Swiper('.team__slider-active-10', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".team-slider-dot-10",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});

	}

	function tp_testimonial(){

	var slider = new Swiper('.testimonial__slider-active', {
		slidesPerView: 1,
		spaceBetween: 30,
		loop: true,
		rtl: rtl_setting,
		pagination: {
			el: ".testimonial-slider-dot",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		breakpoints: {
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
	});

	if ($(".testimonial__slider-active-2").length > 0) {
		$('.testimonial__slider-active-2').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			centerMode: false,
			cssEase: 'linear',
			asNavFor: '.testimonial__slider-nav',
			rtl: rtl_setting,
		});
	}

	if ($(".testimonial__slider-nav").length > 0) {
		$('.testimonial__slider-nav').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			arrows: true,
			asNavFor: '.testimonial__slider-active-2',
			dots: false,
			centerMode: false,
			focusOnSelect: true,
			autoplay: true,
			speed: 100,
			autoplaySpeed: 8000,
			cssEase: 'linear',
			loop: true,
			prevArrow: '<button type="button" class="slick-prev testimonial-2-button-prev"><i class="fa-solid fa-arrow-left"></i></button>',
			nextArrow: '<button type="button" class="slick-next testimonial-2-button-next"><i class="fa-solid fa-arrow-right"></i></button>',
			appendArrows: $('.testimonial__slider-arrow-2'),
			rtl: rtl_setting,
			responsive: [
				{
					breakpoint: 1400,
					settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 1200,
					settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					},
				},
				],
		});

	}

	if ($(".testimonial__slider-active-9").length > 0) {
		$('.testimonial__slider-active-9').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			centerMode: false,
			cssEase: 'linear',
			asNavFor: '.testimonial__slider-nav-9',
			rtl: rtl_setting,
		});
	}

	if ($(".testimonial__slider-nav-9").length > 0) {
		$('.testimonial__slider-nav-9').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			asNavFor: '.testimonial__slider-active-9',
			dots: false,
			centerMode: false,
			focusOnSelect: true,
			autoplay: false,
			speed: 100,
			autoplaySpeed: 8000,
			cssEase: 'linear',
			loop: true,
			prevArrow: '<button type="button" class="slick-prev testimonial-9-button-prev"><i class="fa-regular fa-arrow-left"></i><span>Preview</span></button>',
			nextArrow: '<button type="button" class="slick-next testimonial-9-button-next"><span>Next</span><i class="fa-regular fa-arrow-right"></i></button>',
			appendArrows: $('.testimonial__slider-arrow-9'),
			rtl: rtl_setting,
		});

	}

	var slider = new Swiper('.testimonial__slider-active-4', {
		slidesPerView: 1,
		spaceBetween: 0,
		loop: true,
		rtl: rtl_setting,
		pagination: {
			el: ".testimonial-slider-dot-4",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		breakpoints: {
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			nextEl: ".testimonial-4-button-next",
			prevEl: ".testimonial-4-button-prev",
		},
	});

	if ($(".testimonial__slider-active-5").length > 0) {
		$('.testimonial__slider-active-5').slick({
			autoplay: false,
			autoplaySpeed: 4000,
			dots: false,
			fade: false,
			arrows: true,
			centeredSlides: true,
			prevArrow: '<button type="button" class="testimonial-5-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
			nextArrow: '<button type="button" class="testimonial-5-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
			appendArrows: $('.testimonial-slider-5-arrow'),
			infinite: true,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 1,
			rtl: rtl_setting,
			responsive: [
			{
				breakpoint: 992,
				settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				}
			},
			{
				breakpoint: 768,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			},
			{
				breakpoint: 576,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			},
			{
				breakpoint: 0,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1
				}
			}
			]
		});
	}


	var slider = new Swiper('.testimonial__slider-active-6', {
		slidesPerView: 4,
		spaceBetween: 20,
		loop: true,
		rtl: rtl_setting,
		pagination: {
			el: ".testimonial-slider-dot-6",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		breakpoints: {
			'1200': {
				slidesPerView: 4,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			nextEl: ".testimonial-6-button-next",
			prevEl: ".testimonial-6-button-prev",
		},
	});

	var slider = new Swiper('.testimonial__active-7', {
		centeredSlides: false,
		slidesPerView: 3,
		spaceBetween: 30,
		loop: true,
		rtl: rtl_setting,
		pagination: {
			el: ".testimonial-slider-dot-7",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		breakpoints: {
			'1200': {
				slidesPerView: 3,
			},
			'992': {
				slidesPerView: 2,
			},
			'768': {
				slidesPerView: 2,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
		navigation: {
			nextEl: ".testimonial-7-button-next",
			prevEl: ".testimonial-7-button-prev",
		},
	});

	var testiswiper = new Swiper(".testimonial__slider-8-thumb", {
        spaceBetween: 20,
        slidesPerView: 3,
		loop: true,
        freeMode: false,
        watchSlidesProgress: true,
		centeredSlides: true,
		rtl: rtl_setting,
		navigation: {
			nextEl: ".testimonial-8-button-next",
			prevEl: ".testimonial-8-button-prev",
		},
		breakpoints: {
			'576': {
				slidesPerView: 3,
			},
			'0': {
				slidesPerView: 1,
			},
		},
    });

    var testiswiper2 = new Swiper(".testimonial__slider-active-8", {
        slidesPerView: 1,
		spaceBetween: 0,
		loop: true,
		pagination: {
			el: ".testimonial-slider-dot-8",
			clickable: true,
			renderBullet: function (index, className) {
			  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		breakpoints: {
			'1200': {
				slidesPerView: 1,
			},
			'992': {
				slidesPerView: 1,
			},
			'768': {
				slidesPerView: 1,
			},
			'576': {
				slidesPerView: 1,
			},
			'0': {
				slidesPerView: 1,
			},
		},
        navigation: {
          nextEl: ".testimonial-8-button-next",
          prevEl: ".testimonial-8-button-prev",
        },
        thumbs: {
          swiper: testiswiper,
        },
		rtl: rtl_setting,
    });

	// main home testimonial brand
	var slider = new Swiper('.brand__slider-active', {
		slidesPerView: 5,
		spaceBetween: 0,
		loop: true,
		rtl: rtl_setting,
		pagination: {
			el: ".brand-slider-dot",
			clickable: true,
			renderBullet: function (index, className) {
			return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
			},
		},
		breakpoints: {
			'1200': {
				slidesPerView: 5,
			},
			'992': {
				slidesPerView: 3,
			},
			'768': {
				slidesPerView: 3,
			},
			'576': {
				slidesPerView: 2,
			},
			'0': {
				slidesPerView: 2,
			},
		},
	});

	}

	function tp_testimonial_2(){

		var slider = new Swiper('.testimonial__slider-active-14', {
			centeredSlides: true,
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".testimonial-slider-dot-14",
				clickable: true,
				renderBullet: function (index, className) {
				  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			navigation: {
				nextEl: ".testimonial-14-button-next",
				prevEl: ".testimonial-14-button-prev",
			},
		});

		if ($(".testimonial__slider-active-5").length > 0) {
			$('.testimonial__slider-active-5').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: false,
				fade: false,
				arrows: true,
				centeredSlides: true,
				prevArrow: '<button type="button" class="testimonial-5-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="testimonial-5-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.testimonial-slider-5-arrow'),
				infinite: true,
				speed: 300,
				slidesToShow: 3,
				slidesToScroll: 1,
				rtl: rtl_setting,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}

		if ($(".testimonial__slider-active-5-2").length > 0) {
			$('.testimonial__slider-active-5-2').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: false,
				fade: false,
				arrows: false,
				centeredSlides: true,
				prevArrow: '<button type="button" class="testimonial-5-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="testimonial-5-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.testimonial-slider-5-arrow'),
				infinite: true,
				speed: 300,
				slidesToShow: 3,
				slidesToScroll: 1,
				rtl: rtl_setting,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}

		var slider = new Swiper('.testimonial__slider-active-15', {
			slidesPerView: 4,
			spaceBetween: 20,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".testimonial-slider-dot-15",
				clickable: true,
				renderBullet: function (index, className) {
				  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
			navigation: {
				nextEl: ".testimonial-15-button-next",
				prevEl: ".testimonial-15-button-prev",
			},
		});

		var slider = new Swiper('.brand__slider-active-7', {
			slidesPerView: 5,
			spaceBetween: 0,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".brand-slider-dot-7",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1200': {
					slidesPerView: 5,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 4,
				},
				'576': {
					slidesPerView: 3,
				},
				'0': {
					slidesPerView: 2,
				},
			},
		});
	}

	
	function tp_social_slider(){
		var slider = new Swiper('.testimonial__slider-active-10', {
			centeredSlides: true,
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".testimonial-slider-dot-10",
				clickable: true,
				renderBullet: function (index, className) {
				  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			navigation: {
				nextEl: ".testimonial-10-button-next",
				prevEl: ".testimonial-10-button-prev",
			},
		});
	}

	function tp_product(){
		var slider = new Swiper('.product__related-slider-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".product-related-slider-dot",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
			navigation: {
				nextEl: ".product-related-button-next",
				prevEl: ".product-related-button-prev",
			},
		});

		
	}

	function tp_product_2(){
		var slider = new Swiper('.product__category-slider-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".product-slider-dot",
				clickable: true,
				renderBullet: function (index, className) {
				  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".product-button-next",
				prevEl: ".product-button-prev",
			},
	
			scrollbar: {
				el: ".tp-scrollbar",
				clickable: true,
			},
	
			breakpoints: {
				'1601': {
					slidesPerView: 4,
				},
				'1400': {
					slidesPerView: 4,
				},
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				'0': {
					slidesPerView: 1,
					spaceBetween: 0,
				},
			},
		});
	}


	function tp_biography(){
		$('.biography__slider-content-active').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.biography__slider-nav',
			rtl: rtl_setting,
		});
		$('.biography__slider-nav').slick({
			slidesToShow: 6,
			slidesToScroll: 1,
			asNavFor: '.biography__slider-content-active',
			dots: false,
			centerMode: false,
			focusOnSelect: true,
			arrows: false,
			rtl: rtl_setting,
			responsive: [
				{
					breakpoint: 1400,
					settings: {
					slidesToShow: 6,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 1200,
					settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 4,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					},
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					},
				},
				],
		});
	}

	function tp_brand(){
		
		var slider = new Swiper('.award__slider-active', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".about-slider-dot",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".about-button-next",
				prevEl: ".about-button-prev",
			},
			breakpoints: {  
				'1400': {
					slidesPerView: 4,
				},
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 4,
				},
				'768': {
					slidesPerView: 4,
				},
				'576': {
					slidesPerView: 4,
				},
				'0': {
					slidesPerView: 3,
				},
			},
		});

		var slider = new Swiper('.brand__slider-active-2', {
			slidesPerView: 6,
			spaceBetween: 0,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".brand-slider-dot",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1200': {
					slidesPerView: 6,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 3,
				},
				'576': {
					slidesPerView: 2,
				},
				'0': {
					slidesPerView: 2,
				},
			},
		});

	}



	if ($(".brand__slider-active-5").length > 0) {
		$('.brand__slider-active-5').slick({
			speed: 3000,
			autoplay: true,
			autoplaySpeed: 0,
			cssEase: 'linear',
			slidesToShow: 1,
			slidesToScroll: 1,
			variableWidth: true,
			infinite: true,
			initialSlide: 1,
			arrows: false,
			buttons: false,
			pauseOnFocus: false,
			pauseOnHover: true,
			rtl: rtl_setting,
		  });

	}

	if ($(".brand__slider-active-5-1").length > 0) {
		var autoplaySpeed = 0;
		var autoplayOn    = true;
	
		var $slickRoot = $('.brand__slider-active-5-1');
	
		$slickRoot.on('init', function() {
			var $slickList = $slickRoot.find('.slick-list');
	
			$slickList.mouseenter(function() {
				autoplayOn = false;
			});
			$slickList.mouseleave(function() {
				autoplayOn = true;
			});
	
			window.setInterval(function() {
				if (!autoplayOn) return;
				$slickRoot.slick('slickPrev');
			}, autoplaySpeed);
		});
	
		$slickRoot.slick({
			speed: 3000,
			cssEase: 'linear',
			slidesToShow: 1,
			slidesToScroll: 1,
			variableWidth: true,
			infinite: true,
			arrows:false,
			buttons: false,
			rtl: rtl_setting,
		});

	};


	function tp_portfolio(){

		var slider = new Swiper('.portfolio__slider-active-5', {
			slidesPerView: 4,
			spaceBetween: 15,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".portfolio-slider-dot-5",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".portfolio-button-next-5",
				prevEl: ".portfolio-button-prev-5",
			},

			breakpoints: {
				'1600': {
					slidesPerView: 4,
				},
				'1200': {
					slidesPerView: 3,
				},
				'992': {
					slidesPerView: 2,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});

		var slider = new Swiper('.portfolio__slider-active-6', {
			slidesPerView: 5,
			spaceBetween: 20,
			loop: true,
			speed: 3000,
			autoplay: {
			delay: 3000, 
			},
			rtl: rtl_setting,
			pagination: {
				el: ".portfolio-slider-dot-6",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".portfolio-button-next-6",
				prevEl: ".portfolio-button-prev-6",
			},

			breakpoints: {
				'1600': {
					slidesPerView: 5,
				},
				'1200': {
					slidesPerView: 4,
				},
				'992': {
					slidesPerView: 3,
				},
				'768': {
					slidesPerView: 3,
				},
				'576': {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				'0': {
					slidesPerView: 1,
					spaceBetween: 0,
				},
			},
		});

		var slider = new Swiper('.portfolio__slider-active-9', {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".portfolio-slider-dot-9",
				clickable: true,
				renderBullet: function (index, className) {
				  return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".portfolio-button-next-9",
				prevEl: ".portfolio-button-prev-9",
			},
	
			scrollbar: {
				el: ".tp-scrollbar",
				draggable: true,
				snapOnRelease: true,
			},
	
			breakpoints: {
				'1601': {
					slidesPerView: 4,
				},
				'1400': {
					slidesPerView: 3,
				},
				'1200': {
					slidesPerView: 2,
				},
				'992': {
					slidesPerView: 2,
				},
				'768': {
					slidesPerView: 1,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
					spaceBetween: 0,
				},
			},
		});
	
	}

	function tp_portfolio_2(){
		if ($(".portfolio__slider-active").length > 0) {
			$('.portfolio__slider-active').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: false,
				fade: false,
				arrows: false,
				centeredSlides: false,
				prevArrow: '<button type="button" class="slick-prev"><i class="far fa-arrow-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="far fa-arrow-right"></i></button>',
				appendArrow: 'the-arrow',
				infinite: true,
				speed: 300,
				slidesToShow: 2,
				slidesToScroll: 1,
				rtl: rtl_setting,
				responsive: [
				{
					breakpoint: 1024,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true,
					}
				},
				{
					breakpoint: 600,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}
	}

	function tp_portfolio_3(){
		var portfoliohorizontal = new Swiper('.portfolio__horizontal-active', {
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			mousewheel: true,
			rtl: rtl_setting,
			// If we need pagination
			pagination: {
				el: ".portfolio-horizontal-dot",
				clickable: true,
				renderBullet: function (index, className) {
					return '<span class="' + className + '">' + '<button>'+ '0' +(  index + 1)+'</button>' + "</span>";
				},
			},
	
			// Navigation arrows
			navigation: {
				nextEl: ".portfolio-horizontal-button-next",
				prevEl: ".portfolio-horizontal-button-prev",
			},
		});
	}

	function tp_portfolio_architech(){
		var slider = new Swiper('.portfolio__slider-active-8', {
			slidesPerView: 4,
			spaceBetween: 0,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".portfolio-slider-dot-8",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".portfolio-button-next-8",
				prevEl: ".portfolio-button-prev-8",
			},

			breakpoints: {
				'1600': {
					slidesPerView: 4,
				},
				'1200': {
					slidesPerView: 3,
				},
				'992': {
					slidesPerView: 2,
				},
				'768': {
					slidesPerView: 2,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
					spaceBetween: 0,
				},
			},
		});
	}

	function tp_elements(){
		if ($(".elements__carousel-active").length > 0) {
			$('.elements__carousel-active').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: true,
				fade: false,
				arrows: true,
				centeredSlides: false,
				prevArrow: '<button type="button" class="elements-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="elements-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.elements-arrow'),
				infinite: true,
				speed: 300,
				rtl: rtl_setting,
				slidesToShow: 3,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}

		if ($(".elements__carousel-img-active").length > 0) {
			$('.elements__carousel-img-active').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: false,
				fade: false,
				arrows: true,
				centeredSlides: false,
				prevArrow: '<button type="button" class="elements-img-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="elements-img-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.elements-img-arrow'),
				infinite: true,
				speed: 300,
				rtl: rtl_setting,
				slidesToShow: 1,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}

		if ($(".elements__carousel-img-dot-active").length > 0) {
			$('.elements__carousel-img-dot-active').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: true,
				fade: false,
				arrows: false,
				centeredSlides: false,
				prevArrow: '<button type="button" class="elements-img-dot-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="elements-img-dot-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.elements-img-dot-arrow'),
				infinite: true,
				speed: 300,
				rtl: rtl_setting,
				slidesToShow: 1,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}
	}


	function tp_instagram(){
		var slider = new Swiper('.instagram__slider-active-swiper', {
			slidesPerView: 6,
			spaceBetween: 12,
			loop: true,
			rtl: rtl_setting,
			pagination: {
				el: ".portfolio-slider-dot",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			breakpoints: {
				'1400': {
					slidesPerView: 6,
				},
				'1200': {
					slidesPerView: 5,
				},
				'992': {
					slidesPerView: 4,
				},
				'768': {
					slidesPerView: 3,
				},
				'576': {
					slidesPerView: 2,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});

		if ($(".instagram__slider-active").length > 0) {
			$('.instagram__slider-active .zoom-instagram-widget__items').slick({
				autoplay: false,
				autoplaySpeed: 400,
				dots: false,
				fade: false,
				arrows: false,
				centeredSlides: true,
				prevArrow: '<button type="button" class="testimonial-5-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="testimonial-5-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.sa'),
				infinite: true,
				speed: 300,
				slidesToShow: 6,
				slidesToScroll: 1,
				rtl: rtl_setting,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 6,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}
	}

	function tp_blog(){
		var postboxSlider = new Swiper('.postbox__slider', {
			slidesPerView: 1,
			spaceBetween: 0,
			loop: true,
			rtl: rtl_setting,
			autoplay: {
			delay: 3000,
			},
			// Navigation arrows
			navigation: {
				nextEl: ".postbox-slider-button-next",
				prevEl: ".postbox-slider-button-prev",
			},
			breakpoints: {  
				'1200': {
					slidesPerView: 1,
				},
				'992': {
					slidesPerView: 1,
				},
				'768': {
					slidesPerView: 1,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});

		var slider = new Swiper('.blog__slider-active', {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: true,
			rtl: rtl_setting,
			centeredSlides: true,
			pagination: {
				el: ".blog-slider-4",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// autoplay: {
			//   delay: 3000,
			// },
			// Navigation arrows
			navigation: {
				nextEl: ".blog-slider-button-next",
				prevEl: ".blog-slider-button-prev",
			},
			breakpoints: {  
				'1400': {
					slidesPerView: 3,
				},
				'1200': {
					slidesPerView: 2,
					centeredSlides: false,
				},
				'992': {
					slidesPerView: 2,
					centeredSlides: false,
				},
				'768': {
					slidesPerView: 2,
					centeredSlides: false,
				},
				'576': {
					slidesPerView: 1,
					centeredSlides: false,
				},
				'0': {
					slidesPerView: 1,
					centeredSlides: false,
				},
			},
		});

		var slider = new Swiper('.blog__slider-active-8', {
			loop: true,
			slidesPerView: 2,
			centeredSlides: false,
			spaceBetween: 0,
			rtl: rtl_setting,
			slidesPerGroup: 2,
			pagination: {
				el: ".blog-slider-dot-8",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".blog-8-button-next",
				prevEl: ".blog-8-button-prev",
			},
			breakpoints: {  
				'992': {
					slidesPerView: 2,
					centeredSlides: false,
				},
				'768': {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				'576': {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				'0': {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
			},
		});


	}

	function tp_blog_2(){
		var slider = new Swiper('.blog__breadcrumb-slider-active', {
			loop: true,
			slidesPerView: 1,
			effect: 'fade',
			spaceBetween: 0,
			rtl: rtl_setting,
			pagination: {
				el: ".blog-slider-dot-breadcrumb",
				clickable: true,
				renderBullet: function (index, className) {
				return '<span class="' + className + '">' + '<button>'+(index + 1)+'</button>' + "</span>";
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: ".blog-breadcrumb-button-next",
				prevEl: ".blog-breadcrumb-button-prev",
			},
			breakpoints: {  
				'992': {
					slidesPerView: 1,
				},
				'768': {
					slidesPerView: 1,
				},
				'576': {
					slidesPerView: 1,
				},
				'0': {
					slidesPerView: 1,
				},
			},
		});
	}

	function tp_about_gallery(){
		if ($(".about__gallery-slider-active").length > 0) {
			$('.about__gallery-slider-active').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: false,
				fade: false,
				arrows: true,
				centeredSlides: false,
				prevArrow: '<button type="button" class="about-button-prev slick-prev"><span><i class="fa-regular fa-arrow-left"></i></span></button>',
				nextArrow: '<button type="button" class="about-button-next slick-next"><span><i class="fa-regular fa-arrow-right"></i></span></button>',
				appendArrows: $('.about__gallery-arrow'),
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				slidesToScroll: 1,
				rtl: rtl_setting,
			});
		}

		if ($(".portfolio__details-slider-active").length > 0) {
			$('.portfolio__details-slider-active').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: true,
				fade: false,
				arrows: false,
				centeredSlides: false,
				prevArrow: '<button type="button" class="portfolio-details-button-prev slick-prev"><i class="fa-solid fa-angle-left"></i></button>',
				nextArrow: '<button type="button" class="portfolio-details-button-next slick-next"><i class="fa-solid fa-angle-right"></i></button>',
				appendArrows: $('.portfolio-details-slider-arrow'),
				infinite: true,
				speed: 300,
				rtl: rtl_setting,
				slidesToShow: 1,
				slidesToScroll: 1,
				responsive: [
				{
					breakpoint: 992,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 576,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				},
				{
					breakpoint: 0,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1
					}
				}
				]
			});
		}

		if ($(".portfolio__details-slider-active-2").length > 0) {
			$('.portfolio__details-slider-active-2').slick({
				autoplay: false,
				autoplaySpeed: 4000,
				dots: false,
				fade: false,
				arrows: true,
				centeredSlides: false,
				prevArrow: '<button type="button" class="portfolio-details-2-button-prev slick-prev"><i class="fa-regular fa-arrow-left"></i></button>',
				nextArrow: '<button type="button" class="portfolio-details-2-button-next slick-next"><i class="fa-regular fa-arrow-right"></i></button>',
				appendArrows: $('.portfolio-details-slider-arrow-2'),
				infinite: true,
				speed: 300,
				rtl: rtl_setting,
				slidesToShow: 1,
				slidesToScroll: 1,
				responsive: [
				  {
					breakpoint: 992,
					settings: {
					  slidesToShow: 1,
					  slidesToScroll: 1,
					}
				  },
				  {
					breakpoint: 768,
					settings: {
					  slidesToShow: 1,
					  slidesToScroll: 1,
					  dots: true,
					}
				  },
				  {
					breakpoint: 576,
					settings: {
					  slidesToShow: 1,
					  slidesToScroll: 1,
					  dots: true,
					}
				  },
				  {
					breakpoint: 0,
					settings: {
					  slidesToShow: 1,
					  slidesToScroll: 1,
					  dots: true,
					}
				  }
				]
			});
		}


	}


	////////////////////////////////////////////////////
	// 13. Masonary Js
	if ($('.tp-portfolio-load-more').length > 0) {
		$('.grid').imagesLoaded(function () {
			// init Isotope
			var $grid = $('.grid').isotope({
				itemSelector: '.grid-item',
				percentPosition: true,
				masonry: {
					// use outer width of grid-sizer for columnWidth
					columnWidth: '.grid-item',
				}
			});


			// filter items on button click
			$('.masonary-menu').on('click', 'button', function () {
				var filterValue = $(this).attr('data-filter');
				$grid.isotope({ filter: filterValue });
			});

			//for menu active class
			$('.masonary-menu button').on('click', function (event) {
				$(this).siblings('.active').removeClass('active');
				$(this).addClass('active');
				event.preventDefault();
			});

			var show_item = $('.tp-portfolio-load-more').attr('data-show'); 
			var count_item = show_item;
			var isotop_call = $grid.data('isotope');

			loadMore(show_item);
	
			function loadMore(showing) {
				$grid.find(".hidden").removeClass("hidden");
				
				var hidden = isotop_call.filteredItems.slice(showing, isotop_call.filteredItems.length).map(function(item) {
					return item.element;
				});
				
				$(hidden).addClass('hidden');
				$grid.isotope('layout');
				
				
				if (hidden.length == 0) {
					$("#tp-load-more").hide();
				} else {
					$("#tp-load-more").show();
				};
				
			}
			
			$("#tp-load-more").on('click', function() {
				
				if ($('.masonary-menu').data('clicked')) {
						count_item = show_item;
						$('.masonary-menu').data('clicked', false);
						
					} else {
						count_item = count_item;
					};
		
					count_item = count_item + show_item;

				loadMore(count_item);
			});

			$(".masonary-menu").on('click', function() {
				$(this).data('clicked', true);
	
				loadMore(show_item);
			});

		});
	}else{
		$('.grid').imagesLoaded(function () {
			// init Isotope
			var $grid = $('.grid').isotope({
				itemSelector: '.grid-item',
				percentPosition: true,
				masonry: {
					// use outer width of grid-sizer for columnWidth
					columnWidth: '.grid-item',
				}
			});
	
	
			// filter items on button click
			$('.masonary-menu').on('click', 'button', function () {
				var filterValue = $(this).attr('data-filter');
				$grid.isotope({ filter: filterValue });
			});
	
			//for menu active class
			$('.masonary-menu button').on('click', function (event) {
				$(this).siblings('.active').removeClass('active');
				$(this).addClass('active');
				event.preventDefault();
			});
	
		});

		var show_item_2 = $('.tp-load-item-count').attr('data-show'); 
		$(".tp-load-item").hide();
		$(".tp-load-item").slice(0, show_item_2).show();
		$("body").on('click touchstart', '.load-more', function (e) {
			e.preventDefault();
			$(".tp-load-item:hidden").slice(0, show_item_2).slideDown();
			if ($(".tp-load-item:hidden").length == 0) {
				$(".load-more").css('display', 'none');
			}
	
		});
	}
	





	/* magnificPopup img view */
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		},
		mainClass: 'mfp-with-zoom',
		removalDelay: 500,
	});

	/* magnificPopup video view */
	$(".popup-video").magnificPopup({
		type: "iframe",
		mainClass: 'mfp-with-zoom',
		removalDelay: 500,
	});

	////////////////////////////////////////////////////
	// 14. Wow Js
	new WOW().init();


	////////////////////////////////////////////////////
	// 17. Show Login Toggle Js
	$('#showlogin').on('click', function () {
		$('#checkout-login').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 18. Show Coupon Toggle Js
	$('#showcoupon').on('click', function () {
		$('#checkout_coupon').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 19. Create An Account Toggle Js
	$('#cbox').on('click', function () {
		$('#cbox_info').slideToggle(900);
	});

	////////////////////////////////////////////////////
	// 20. Shipping Box Toggle Js
	$('#ship-box').on('click', function () {
		$('#ship-box-info').slideToggle(1000);
	});


	////////////////////////////////////////////////////
	// 21. Counter Js
	new PureCounter();
	new PureCounter({
		filesizing: true,
		selector: ".filesizecount",
		pulse: 2,
	});


	////////////////////////////////////////////////////
	// 22. Parallax Js
	if ($('.scene').length > 0) {
		$('.scene').parallax({
			scalarX: 10.0,
			scalarY: 15.0,
		});
	};
	
	if ($('.scene-2').length > 0) {
		$('.scene-2').parallax({
			scalarX: 15.0,
			scalarY: 15.0,
		});
	};

	


	////////////////////////////////////////////////////
	// 23. InHover Active Js
	$('.hover__active').on('mouseenter', function () {
		$(this).addClass('test__active').parent().find('.hover__active').removeClass('test__active');
	});

	// product countdown
	if ($('countdown').length > 0) {
		$(".countdown").countdown();
	}

	if ($('#nft-slider').length > 0) {
		var stepsSlider = document.getElementById('nft-slider');
		var input0 = document.getElementById('input-with-keypress-0');
		var input1 = document.getElementById('input-with-keypress-1');
		var inputs = [input0, input1];
	
		noUiSlider.create(stepsSlider, {
			start: [0, 4],
			connect: true,
			range: {
				'min': [0],
				'max': 10
			}
		});
	
		stepsSlider.noUiSlider.on('update', function (values, handle) {
			inputs[handle].value = values[handle];
		});

	}


	$('.portfolio__item-8').on("mouseenter", function(){
		$(this).addClass('active').siblings().removeClass('active');
		$('#portfolio-bg-img').removeClass().addClass($(this).attr('rel'));
	});   


	$('.services-item-link').on("click", function(){
		$('#services-item-thumb').removeClass().addClass($(this).attr('rel'));
		$(this).addClass('active').siblings().removeClass('active');
	});   

	$('.features-item-content').on("click", function(){
		$('#features-item-thumb').removeClass().addClass($(this).attr('rel'));
		$(this).addClass('active').siblings().removeClass('active');
	});   

	$('.portfolio__item-6').on("mouseenter", function(){
		$(this).addClass('active').siblings().removeClass('active');
	});   
	
	$('.portfolio__item-6').on("mouseleave", function(){
		$('.portfolio__item-6').removeClass('active').addClass('active');
	});   


	$('.slider__product-thumb-sm').on("click", function(){
		$('#product_wrapper').removeClass().addClass($(this).attr('rel'));
		$(this).addClass('active').siblings().removeClass('active');
	});   

	$('.yith-wcan-filter .filter-title').on('click', function() {
		$(this).siblings('.filter-content').slideToggle('300') ;
	});

	$('.product__widget .product__widget-title').on('click', function() {
		$(this).toggleClass('tp-widget-active') ;
		$(this).siblings('form, ul, div').slideToggle('300') ;
	});

	if ($('.jarallax').length > 0) {
		$('.jarallax').jarallax({
			speed: 0.2,
			imgWidth: 1366,
			imgHeight: 768
		});
	};

	if ($('#marker').length > 0) {
		function tp_tab_line(){
			var marker = document.querySelector('#marker');
			var item = document.querySelectorAll('.tp-tab-menu button');
			var itemActive = document.querySelector('.tp-tab-menu .nav-link.active');

			// rtl settings
			var tp_rtl = localStorage.getItem('tp_dir');
			let rtl_setting = tp_rtl == 'rtl' ? 'right' : 'left';

			function indicator(e){
				marker.style.left = e.offsetLeft+"px";
				marker.style.width = e.offsetWidth+"px";
			}
				
		
			item.forEach(link => {
				link.addEventListener('click', (e)=>{
					indicator(e.target);
				});
			});
			
			var activeNav = $('.nav-link.active');
			var activewidth = $(activeNav).width();
			var activePadLeft = parseFloat($(activeNav).css('padding-left'));
			var activePadRight = parseFloat($(activeNav).css('padding-right'));
			var totalWidth = activewidth + activePadLeft + activePadRight;
			
			var precedingAnchorWidth = anchorWidthCounter();
		
		
			$(marker).css('display','block');
			
			$(marker).css('width', totalWidth);
		
			function anchorWidthCounter() {
				var anchorWidths = 0;
				var a;
				var aWidth;
				var aPadLeft;
				var aPadRight;
				var aTotalWidth;
				$('.tp-tab-menu button').each(function(index, elem) {
					var activeTest = $(elem).hasClass('active');
					marker.style.left = elem.offsetLeft+"px";
					if(activeTest) {
					// Break out of the each function.
					return false;
					}
			
					a = $(elem).find('button');
					aWidth = a.width();
					aPadLeft = parseFloat(a.css('padding-left'));
					aPadRight = parseFloat(a.css('padding-right'));
					aTotalWidth = aWidth + aPadLeft + aPadRight;
			
					anchorWidths = anchorWidths + aTotalWidth;
	
				});
		
				return anchorWidths;
			}
		}
		tp_tab_line();
	}

	if ($('#marker-vertical').length > 0) {
		function tp_tab_line_2(){
				var marker = document.querySelector('#marker-vertical');
				var item = document.querySelectorAll('.tp-tab-menu button');
				var itemActive = document.querySelector('.tp-tab-menu .nav-link.active');
			
				
			
				function indicator(e){
					marker.style.top = e.offsetTop+"px";
					marker.style.height = e.offsetHeight+"px";
				}
			
			
				item.forEach(link => {
					link.addEventListener('click', (e)=>{
						indicator(e.target);
					});
				});
				var activeNav = $('.nav-link.active');
				var activewidth = $(activeNav).height();
				var activePadLeft = parseFloat($(activeNav).css('padding-top'));
				var activePadRight = parseFloat($(activeNav).css('padding-bottom'));
				var totalWidth = activewidth + activePadLeft + activePadRight;
				
				var precedingAnchorWidth = anchorWidthCounter();
			
			
				$(marker).css('display','block');
				
				$(marker).css('height', totalWidth);
			
				function anchorWidthCounter() {
					var anchorWidths = 0;
					var a;
					var aWidth;
					var aPadLeft;
					var aPadRight;
					var aTotalWidth;
					$('.tp-tab-menu button').each(function(index, elem) {
					  var activeTest = $(elem).hasClass('active');
					  marker.style.top = elem.offsetTop+"px";
					  if(activeTest) {
						// Break out of the each function.
						return false;
					  }
				
					  a = $(elem).find('button');
					  aWidth = a.width();
					  aPadLeft = parseFloat(a.css('padding-top'));
					  aPadRight = parseFloat(a.css('padding-bottom'));
					  aTotalWidth = aWidth + aPadLeft + aPadRight;
				
					  anchorWidths = anchorWidths + aTotalWidth;
			
					});
				
					return anchorWidths;
				  }
	
		}
		tp_tab_line_2();
	}


	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-slider.default",tp_main_slider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-slider-architech.default",tp_architech_sllider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-swiper-slider.default",tp_swiper_slider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-team.default",tp_team
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-testimonial-slider.default",tp_testimonial_2
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-testimonial.default",tp_testimonial
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-slider-social.default",tp_social_slider
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-product.default",tp_product
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/product-category-slider.default",tp_product_2
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-slider-timeline.default",tp_biography
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-brand.default",tp_brand
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-portfolio.default",tp_portfolio
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-portfolio-photo.default",tp_portfolio_2
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-portfolio-slider.default",tp_portfolio_3
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-portfolio-architech.default",tp_portfolio_architech
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-elements.default",tp_elements
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-instagram.default",tp_instagram
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/blogpost.default",tp_blog
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/blogpost-grid.default",tp_blog_2
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tp-gallery-slider.default",tp_about_gallery
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/tpel-carousel.default",tp_elements
		);
	});


	// product details thumb slider
	$(document).ready(function() {
		$(".flex-control-thumbs").addClass("product-thumbnails");
		if ($(".woocommerce-product-gallery").hasClass("vertical") && $(window).width() > 992) {
			var verti = true;
		} else {
			var verti = false;
		}

		$('.product-thumbnails').slick({
		  dots: false,
		  arrows: false,
		  prevArrow: '<div class="prev"><i class="far fa-angle-left"></i></div>',
		  nextArrow: '<div class="next"><i class="far fa-angle-right"></i></div>',
		  autoplay: false,
		  Speed: 2000,
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  focusOnSelect: true,
		  vertical: false,
		});
	});

	var comp = $(".product-action-btn [class='fa fa-square-o'], .product__details-wrapper .br_compare_button [class='fa fa-square-o']");
	$(comp).attr("class", "fa-regular fa-arrow-right-arrow-left");

	var comp2 = $(".product-action-btn [class='fa fa-check-square-o'], .product__details-wrapper .br_compare_button [class='fa fa-check-square-o']");
	$(comp2).attr("class", "fa-regular fa-check");


})(jQuery);