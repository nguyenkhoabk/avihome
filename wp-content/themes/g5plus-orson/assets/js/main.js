var G5Plus = G5Plus || {};
(function ($) {
	"use strict";

	var $window = $(window),
		$body = $('body'),
		isRTL = $body.hasClass('rtl'),
		deviceAgent = navigator.userAgent.toLowerCase(),
		isMobile = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
		isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
		isAppleDevice = deviceAgent.match(/(iphone|ipod|ipad)/),
		isIEMobile = deviceAgent.match(/(iemobile)/);


	G5Plus.common = {
		init: function () {
			this.retinaLogo();
			this.owlCarousel();
			this.lightGallery();
			this.tooltip();
			this.counterUp();
			this.canvasSidebar();
			this.verticalProgressbar();
			setTimeout(G5Plus.common.owlCarouselRefresh,1000);
			setTimeout(G5Plus.common.owlCarouselCenter,1000);
			setTimeout(G5Plus.common.owlCarouselCenter,2000);
			this.initVCTab();
			this.adminBarProcess();
		},
		windowResized: function(){
			this.canvasSidebar();
			this.adminBarProcess();
			setTimeout(G5Plus.common.owlCarouselRefresh,1000);
			setTimeout(G5Plus.common.owlCarouselCenter,1000);
		},
		windowScroll: function () {
			this.canvasSidebar();
		},
		owlCarousel : function(){
			$('.owl-carousel:not(.manual):not(.owl-loaded)').each(function () {
				var $slider = $(this),
					defaults = {
						items: 3,
						nav:false,
						navText: [ '<i class="fa fa-arrow-left"></i> ' + g5plus_framework_constant.owl_prev, g5plus_framework_constant.owl_next +  ' <i class="fa fa-arrow-right"></i>' ],
						dots:true,
						loop: false,
						center: false,
						mouseDrag: true,
						touchDrag: true,
						pullDrag: true,
						freeDrag: false,

						margin: 0,
						stagePadding: 0,

						merge: false,
						mergeFit: true,
						autoWidth: false,

						startPosition: 0,
						rtl: isRTL,

						smartSpeed: 250,
						fluidSpeed: false,
						dragEndSpeed: false,

						autoplayHoverPause: true
					},
					config = $.extend({}, defaults, $slider.data("owl-config"));
				if ($slider.parent().parent().hasClass('product-split-screen')) {
					config = $.extend({},config, {
						responsive: {
							0: {
								items: 1
							},
							480: {
								items: 2
							},
							768: {
								items: 1
							},
							800: {
								items: 2
							},
							1200: {
								items: 3
							}
						}
					});
				}
				// Initialize Slider
				$slider.imagesLoaded({ background: true },function () {
					$slider.owlCarousel(config);
				});

				$slider.on('changed.owl.carousel',function(e){
					var $container = $('.archive-masonry .blog-wrap');
					setTimeout(function () {
						$container.isotope('layout');
					}, 500);
				});


			});
		},
		owlCarouselRefresh : function(){
			$('.owl-carousel.owl-loaded').each(function(){
				var $this = $(this),
					$slider = $this.data('owl.carousel');
				if (typeof ($slider) != 'undefined') {
					if ($slider.options.autoHeight) {
						var maxHeight = 0;
						$('.owl-item.active',$this).each(function(){
							if ($(this).outerHeight() > maxHeight) {
								maxHeight = $(this).outerHeight();
							}
						});

						$('.owl-height',$this).css('height', maxHeight + 'px');
					}
				}
			});
		},
		owlCarouselCenter: function(){
			$('.product-listing > .owl-nav-center').each(function(){
				var $this = $(this);
				$this.imagesLoaded({background: true},function(){
					var top = $('img',$this).height() / 2  ;
					if (window.matchMedia('(min-width: 1350px)').matches) {
						$('.owl-nav > div',$this).css('top', top +  'px');
					} else {
						$('.owl-nav > div',$this).css('top','');
					}
				});
			});
		},
		lightGallery: function () {
			$("[data-rel='lightGallery']").each(function () {
				var $this = $(this),
					$parent = $(this).parent().parent().parent(),
					galleryId = $this.data('gallery-id'),
					strGallery = '';
				$this.on('click', function (event) {
					event.preventDefault();
					var _data = [];
					$('[data-gallery-id="' + galleryId + '"]',$parent).each(function () {
						var src = $(this).attr('href'),
							thumb = $(this).data('thumb-src');
						if(strGallery.indexOf(src) == -1) {
							_data.push({
								'src': src,
								'thumb': thumb
							});
							strGallery += '|'+src;
						}
					});
					$this.lightGallery({
						hash : false,
						dynamic: true,
						dynamicEl: _data,
						thumbWidth: 80
					});
				});
			});
			$('a.view-video').on('click', function (event) {
				event.preventDefault();
				var $src = $(this).attr('data-src');
				$(this).lightGallery({
					dynamic: true,
					dynamicEl: [{
						'src': $src,
						'thumb': '',
						'subHtml': ''
					}]
				});
			});
		},
		isDesktop: function () {
			var responsive_breakpoint = 991;
			var $menu = $('.x-nav-menu');
			if (($menu.length > 0) && (typeof ($menu.attr('responsive-breakpoint')) != "undefined" ) && !isNaN(parseInt($menu.attr('responsive-breakpoint'), 10))) {
				responsive_breakpoint = parseInt($menu.attr('responsive-breakpoint'), 10);
			}
			return window.matchMedia('(min-width: ' + (responsive_breakpoint + 1) + 'px)').matches;
		},
		tooltip: function() {
			if ($().tooltip && !isMobileAlt) {
				if (!$body.hasClass('woocommerce-compare-page')) {
					$('[data-toggle="tooltip"]').tooltip();
				}

				$('.yith-wcwl-wishlistexistsbrowse,.yith-wcwl-add-button,.yith-wcwl-wishlistaddedbrowse', '.product-actions').each(function(){
					var title = $('a',$(this)).text().trim();
					$(this).tooltip({
						title: title
					});
				});

				$('.compare','.product-actions').each(function(){
					var title = $(this).text().trim();
					$(this).tooltip({
						title: title
					});
				});
			}
		},
		counterUp : function(){
			$('.counter').each(function(){
				var $counter = $(this);
				var defaults = {
					delay: 10,
					time: 1000
				};
				var config = $.extend({}, defaults, $counter.data("counter-config"));
				$counter.counterUp(config);
			});
		},
		canvasSidebar: function () {
			var canvas_sidebar_mobile = $('.sidebar-mobile-canvas');
			if(typeof(canvas_sidebar_mobile) != 'undefined') {
				if(!$('body').find('#wrapper').next().hasClass('overlay-canvas-sidebar')) {
					$('#wrapper').after('<div class="overlay-canvas-sidebar"></div>');
				}
				var adminBarHeight = $('#wpadminbar').height();
				if (!G5Plus.common.isDesktop()) {
					canvas_sidebar_mobile.css('margin-top', adminBarHeight + 'px');
					canvas_sidebar_mobile.css('height', $(window).height() + 'px');
					canvas_sidebar_mobile.css('overflow-y', 'auto');
					if(($('#wpadminbar').css('position')!='fixed') && ($(window).scrollTop() >= adminBarHeight)) {
						canvas_sidebar_mobile.css('margin-top', '0px');
					}
					if ($.isFunction($.fn.perfectScrollbar)) {
						canvas_sidebar_mobile.perfectScrollbar();
					}
				} else {
					canvas_sidebar_mobile.css('overflow-y', 'hidden');
					canvas_sidebar_mobile.css('height', 'auto');
					canvas_sidebar_mobile.scrollTop(0);
					if ($.isFunction($.fn.perfectScrollbar)) {
						canvas_sidebar_mobile.perfectScrollbar('destroy');
					}
					canvas_sidebar_mobile.removeAttr('style');
				}
				$('.sidebar-mobile-canvas-icon').on('click', function () {
					var $canvas_sidebar = $(this).parent().children('.sidebar-mobile-canvas');
					$(this).addClass('changed');
					$canvas_sidebar.addClass('changed');
					$('.overlay-canvas-sidebar').addClass('changed');
				});
				$('.sidebar-mobile-canvas-icon-close').on('click', function () {
					$(this).parent().prev('.sidebar-mobile-canvas-icon').removeClass('changed');
					$(this).parent().removeClass('changed');
					$('.overlay-canvas-sidebar').removeClass('changed');
				});
				$('.overlay-canvas-sidebar').on('click',function () {
					if($('.sidebar-mobile-canvas-icon').hasClass('changed')) {
						$('.sidebar-mobile-canvas-icon-close').click();
					}
				});
			}
		},
		verticalProgressbar : function() {
			if ( 'undefined' !== typeof($.fn.waypoint) ) {
				$( '.v-progress-bar' ).waypoint( function () {
					$( this ).find( '.vc_single_bar' ).each( function ( index ) {
						var $this = $( this ),
							bar = $this.find( '.vc_bar' ),
							val = bar.data( 'percentage-value' );

						setTimeout( function () {
							bar.css( { "height": val + '%' } );
						}, index * 200 );
					} );
				}, { offset: '85%' } );
			}
		},
		initVCTab:function(){
			/**
			 * process tab click
			 */
			var $is_handle_tab = 0;
			$('a','.vc_tta-tabs ul.vc_tta-tabs-list').off('click').each(function() {
				$(this).on('click',function (e) {
					if ($(this).parent().hasClass('vc_active')) {
						$is_handle_tab = 1;
					} else {
						$is_handle_tab = 0;
					}
					e.preventDefault();
					if ($is_handle_tab == 1) {
						return false;
					}
					$is_handle_tab = 1;
					var $ul = $(this).parent().parent();
					var $current_tab = $($(this).attr('href'), '.vc_tta-panels-container');
					var $tab_id = '';
					var $tab_active = '';
					if (typeof $ul != 'undefined') {
						$('li', $ul).removeClass('vc_active');
						$(this).parent().addClass('vc_active');
						$('li a', $ul).each(function () {
							$tab_id = $(this).attr('href');
							if ($($tab_id + '.vc_active', '.vc_tta-panels-container').length > 0) {
								$tab_active = $($tab_id + '.vc_active', '.vc_tta-panels-container');
							}
						});
						$tab_active.fadeOut(400, function () {
							$tab_active.removeClass('vc_active');
							$tab_active.fadeIn();
							$current_tab.fadeIn(0, function () {
								$current_tab.addClass('vc_active');
								$is_handle_tab = 0;
							});
						})
					}
					$(this).on('click');
					return false;
				});
			});
		},
		adminBarProcess: function() {
			if (window.matchMedia('(max-width: 600px)').matches) {
				$('#wpadminbar').css('top', '-46px');
			}
			else {
				$('#wpadminbar').css('top', '');
			}
		},
		retinaLogo: function () {
			if (window.matchMedia('only screen and (min--moz-device-pixel-ratio: 1.5)').matches
				|| window.matchMedia('only screen and (-o-min-device-pixel-ratio: 3/2)').matches
				|| window.matchMedia('only screen and (-webkit-min-device-pixel-ratio: 1.5)').matches
				|| window.matchMedia('only screen and (min-device-pixel-ratio: 1.5)').matches) {
				$('img[data-retina]').each(function() {
					$(this).attr('src', $(this).attr('data-retina'));
				});
			}
		}
	};


	G5Plus.page = {
		init: function () {
			this.parallax();
			this.parallaxDisable();
			this.pageTitle();
			this.button();
			this.footerParallax();
			this.footerWidgetCollapse();
			this.events();
			this.page404();
			this.pageTransition();
			this.backToTop();
		},
		events : function() {
			$(document).on('vc-full-width-row',function(){
				if ($body.hasClass('boxed')) {
					G5Plus.page.fullWidthRow();
				}

				if (isRTL) {
					G5Plus.page.fullWidthRowRTL();
				}

				$('.owl-carousel.owl-loaded',$('[data-vc-full-width="true"]')).each(function(){
					$(this).data('owl.carousel').onResize();
				});
			});
		},
		windowLoad : function() {
			this.fadePageIn();
		},
		windowResized: function() {
			this.parallaxDisable();
			this.pageTitle();
			this.button();
			this.footerParallax();
			this.footerWidgetCollapse();
			this.wpb_image_grid();
			this.page404();
		},
		parallax: function() {
			$.stellar({
				horizontalScrolling: false,
				scrollProperty: 'scroll',
				positionProperty: 'position',
				responsive: false
			});
		},
		parallaxDisable: function() {
			if (G5Plus.common.isDesktop()) {
				$('.parallax').removeClass('parallax-disabled');
			} else {
				$('.parallax').addClass('parallax-disabled');
			}
		},
		pageTitle : function() {
			var $this = $('.page-title-layout-normal'),
				$container = $('.container',$this),
				$pageTitle = $('h1',$this),
				$breadcrumbs = $('.breadcrumbs',$this);
			$this.removeClass('left');
			if (($pageTitle.width() + $breadcrumbs.width()) > $container.width()) {
				$this.addClass('left');
			}
		},
		button: function(){
			$('.btn.btn-block.btn-icon,.mc-style4 .btn.btn-icon').each(function(){
				var $width = $(this).width() - $('i',$(this)).width() - parseInt($('i',$(this)).css('margin-left').replace('px',''),10) - parseInt($('i',$(this)).css('margin-right').replace('px',''),10);
				$('span',$(this)).css({
					'width' : $width + 'px'
				});
				if ($(this).height() > $('span',$(this)).height()) {
					$('span',$(this)).css({
						'width' : ($width - 1) + 'px'
					});
				}
			});
		},
		footerParallax: function() {
			if( window.matchMedia('(max-width: 767px)').matches){
				$body.css('margin-bottom','');
			}
			else {
				setTimeout(function () {
					var $footer = $('footer.main-footer-wrapper');
					if ($footer.hasClass('enable-parallax')) {
						var headerSticky  = $('header.main-header .sticky-wrapper').length > 0 ? 55 : 0,
							$adminBar = $('#wpadminbar'),
							$adminBarHeight = $adminBar.length > 0 ?  $adminBar.outerHeight() : 0;
						if (($window.height() >= ($footer.outerHeight() + headerSticky + $adminBarHeight))) {
							$body.css('margin-bottom', ($footer.outerHeight()) + 'px');
							$footer.removeClass('static');
						} else {
							$body.css('margin-bottom','');
							$footer.addClass('static');
						}
					}
				}, 100);
			}

		},
		footerWidgetCollapse : function() {
			if( window.matchMedia('(max-width: 767px)').matches){
				$('footer.footer-collapse-able aside.widget').each(function(){
					var $title = $('h4.widget-title',this);
					var $content = $title.next();
					$title.addClass('title-collapse');
					if(($content != null) && (typeof($content) != 'undefined')) {
						$content.hide();
					}
					$title.off();
					$title.on('click', function(){
						var $content = $(this).next();

						if($(this).hasClass('title-expanded')){
							$(this).removeClass('title-expanded');
							$title.addClass('title-collapse');
							$content.slideUp();
						}
						else
						{
							$(this).addClass('title-expanded');
							$title.removeClass('title-collapse');
							$content.slideDown();
						}

					});

				});
			}else{
				$('footer aside.widget').each(function(){
					var $title = $('h4.widget-title',this);
					$title.off();
					var $content = $title.next();
					$title.removeClass('collapse');
					$title.removeClass('expanded');
					$content.show();
				});
			}
		},
		fullWidthRow : function() {
			$('[data-vc-full-width="true"]').each(function(){
				var $this = $(this),
					$wrapper = $('#wrapper');
				$this.addClass("vc_hidden");
				$this.attr('style','');
				if (!$body.hasClass('has-sidebar')) {
					var $el_full = $this.next(".vc_row-full-width");
					$el_full.length || ($el_full = $this.parent().next(".vc_row-full-width"));
					var el_margin_left = parseInt($this.css("margin-left"), 10),
						el_margin_right = parseInt($this.css("margin-right"), 10),
						offset = $wrapper.offset().left - $el_full.offset().left - el_margin_left,
						width = $wrapper.width();
					$this.css({
						position: "relative",
						left: offset,
						"box-sizing": "border-box",
						width: $wrapper.width()
					});

					if (!$this.data("vcStretchContent")) {
						var padding = -1 * offset;
						if (padding < 0) {
							padding = 0;
						}
						var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
						if (paddingRight < 0) {
							paddingRight = 0;
						}
						$this.css({
							"padding-left": padding + "px",
							"padding-right": paddingRight + "px"
						});
					}
				}
				$this.removeClass("vc_hidden");
			});
		},
		fullWidthRowRTL: function() {
			$('[data-vc-full-width="true"]').each(function(){
				var offset = $(this).css('left');
				$(this).css({
					left : 'auto',
					right : offset
				});
			});
		},
		wpb_image_grid : function() {
			$(".wpb_gallery_slides.wpb_image_grid .wpb_image_grid_ul").each(function(index) {
				var $imagesGrid = $(this);
				setTimeout(function(){
					$imagesGrid.isotope('layout');
				},1000);
			});
		},
		page404: function() {
			if (!$body.hasClass('error404')) return;
			var windowHeight = $window.outerHeight();
			var page404Height = 0;
			var $header = null;
			if (G5Plus.common.isDesktop()) {
				$header = $('header.main-header');
			}
			else {
				$header = $('header.header-mobile');
			}
			if ($header.length == 0) return;
			page404Height = windowHeight - $header.offset().top - $header.outerHeight() - $('body.error404 .content-wrap').outerHeight();
			if (page404Height < 200) {
				page404Height = 200;
			}
			page404Height /= 2;
			$('body.error404 .page404').css('padding', page404Height + 'px 0');
		},
		pageTransition : function() {
			if ($body.hasClass('page-transitions')) {
				var linkElement = '.animsition-link, a[href]:not([target="_blank"]):not([href^="#"]):not([href*="javascript"]):not([href*=".jpg"]):not([href*=".jpeg"]):not([href*=".gif"]):not([href*=".png"]):not([href*=".mov"]):not([href*=".swf"]):not([href*=".mp4"]):not([href*=".flv"]):not([href*=".avi"]):not([href*=".mp3"]):not([href^="mailto:"]):not([class*="no-animation"]):not([class*="prettyPhoto"]):not([class*="add_to_wishlist"]):not([class*="add_to_cart_button"]):not([class*="compare"])';
				$(linkElement).on('click', function(event) {
					if ($( event.target ).closest($('b.x-caret', this)).length > 0) {
						event.preventDefault();
						return;
					}
					event.preventDefault();
					var $self = $(this);
					var url = $self.attr('href');

					// middle mouse button issue #24
					// if(middle mouse button || command key || shift key || win control key)
					if (event.which === 2 || event.metaKey || event.shiftKey || navigator.platform.toUpperCase().indexOf('WIN') !== -1 && event.ctrlKey) {
						window.open(url, '_blank');
					} else {
						G5Plus.page.fadePageOut(url);
					}

				});
			}
		},
		fadePageIn : function() {
			if ($body.hasClass('page-loading')) {
				var preloadTime = 1000,
					$loading = $('.site-loading');
				$loading.css('opacity', '0');
				setTimeout(function() {
					$loading.css('display', 'none');
				}, preloadTime);
			}
		},
		fadePageOut: function(link) {

			$('.site-loading').css('display', 'block').animate({
				opacity: 1,
				delay: 200
			}, 600, "linear" );

			$('html,body').animate({scrollTop: '0px'},800);

			setTimeout(function() {
				window.location = link;
			}, 600);
		},
		backToTop : function() {
			var $backToTop = $('.back-to-top');
			if ($backToTop.length > 0) {
				$backToTop.on('click',function(event) {
					event.preventDefault();
					$('html,body').animate({scrollTop: '0px'},800);
				});
				$window.on('scroll', function (event) {
					var scrollPosition = $window.scrollTop();
					var windowHeight = $window.height() / 2;
					if (scrollPosition > windowHeight) {
						$backToTop.addClass('in');
					}
					else {
						$backToTop.removeClass('in');
					}
				});
			}
		}
	};

	G5Plus.blog = {
		init: function () {
			this.masonryLayout();
			setTimeout(this.masonryLayout,300);
			this.postMeta();
			this.loadMore();
			this.infiniteScroll();
			this.commentReplyTitle();

		},
		windowResized: function() {
			this.postMeta();
		},
		postMeta: function() {
			$('article.post-large-image .entry-meta-wrap,article.post-medium-image .entry-meta-wrap,article.post-masonry .entry-meta-wrap').each(function(){
				var $this = $(this),
					$moreLink = $('.read-more',$this),
					$meta = $('.entry-post-meta',$this);
				$this.removeClass('left');
				if (($moreLink.outerWidth() + $meta.outerWidth() + 10) > $this.outerWidth()) {
					$this.addClass('left');
				}
			});
		},
		loadMore: function() {
			$('.paging-navigation').on('click','.blog-load-more',function(event){
				event.preventDefault();
				var $this = $(this).button('loading'),
					link = $(this).attr('data-href'),
					contentWrapper = '.blog-wrap',
					element = '.blog-wrap article';

				$.get(link,function (data) {
					var next_href = $('.blog-load-more', data).attr('data-href'),
						$newElems = $(element, data).css({
							opacity: 0
						});
					$(contentWrapper).append($newElems);

					$newElems.imagesLoaded({ background: true },function () {
						G5Plus.common.owlCarousel();
						G5Plus.blog.postMeta();
						G5Plus.common.lightGallery();
						$newElems.animate({
							opacity: 1
						});

						if ($('.archive-wrap').hasClass('archive-masonry')) {
							$(contentWrapper).isotope('appended', $newElems);
							setTimeout(function() {
								$(contentWrapper).isotope('layout');
							}, 400);
						}
					});

					if (typeof(next_href) == 'undefined') {
						$this.parent().remove();
					} else {
						$this.button('reset');
						$this.attr('data-href', next_href);
					}
				});
			});

		},
		infiniteScroll: function() {
			var $container = $('.blog-wrap');
			$container.infinitescroll({
				navSelector  : '#infinite_scroll_button',    // selector for the paged navigation
				nextSelector : '#infinite_scroll_button a',  // selector for the NEXT link (to page 2)
				itemSelector : 'article',     // selector for all items you'll retrieve
				animate : true,
				loading: {
					finishedMsg: 'No more pages to load.',
					selector: '#infinite_scroll_loading',
					img: g5plus_app_variable.theme_url + 'assets/images/ajax-loader.gif',
					msgText: 'Loading...'
				}
			},function(newElements){
				var $newElems = $(newElements).css({
					opacity: 0
				});

				$newElems.imagesLoaded({ background: true },function () {
					G5Plus.common.owlCarousel();
					G5Plus.blog.postMeta();
					G5Plus.common.lightGallery();
					$newElems.animate({
						opacity: 1
					});
					if ($('.archive-wrap').hasClass('archive-masonry')) {
						$container.isotope('appended', $newElems);
						setTimeout(function() {
							$container.isotope('layout');
						}, 400);
					}
				});
			});

		},
		masonryLayout: function() {
			var $container = $('.archive-masonry .blog-wrap');
			$container.imagesLoaded({ background: true }, function() {
				$container.isotope({
					itemSelector : 'article',
					layoutMode: "masonry",
					isOriginLeft: !isRTL
				});
				setTimeout(function () {
					$container.isotope('layout');
				}, 500);
			});

		},
		commentReplyTitle: function() {
			var $replyTitle = $('h3#reply-title');
			$replyTitle.addClass('widget-title mg-top-40');
			var $smallTag = $('small', $replyTitle);
			$smallTag.remove();
			$replyTitle.html('<span>' + $replyTitle.text() + '</span> ');
			$replyTitle.append($smallTag);
		}
	};

	G5Plus.woocommerce = {
		init: function () {
			this.setCartScrollBar();
			this.addToWishlist();
			if (!$body.hasClass('woocommerce-compare-page')) {
				this.addToCart();
			}
			this.addCartQuantity();
			this.quickView();
			this.product_deal_width();
			setTimeout(G5Plus.woocommerce.product_deal_width,500);
			setTimeout(G5Plus.woocommerce.product_deal_width,1000);
			this.sale_countdown();
			this.processWidgetTitle();
			$body.on('updated_shipping_method', G5Plus.woocommerce.processWidgetTitle);
			$(document).on('yith-wcan-ajax-filtered', G5Plus.common.tooltip);
			this.categoryName();
			var $productImageWrap = $('#single-product-image');
			this.singleProductImage($productImageWrap);

		},
		windowResized : function () {
			setTimeout(function(){
				G5Plus.woocommerce.product_deal_width();
				G5Plus.woocommerce.sale_countdown_width();
			},500);
			this.categoryName();
			this.setCartScrollBar();
		},
		windowLoad : function() {
			this.setCartScrollBar();
		},
		setCartScrollBar: function () {
			setTimeout(function () {
				var $adminBar = $('#wpadminbar');
				var $adminBarHeight = $adminBar.outerHeight();
				var $site_top = $('.site-top').outerHeight();
				var $shopping_cart_wrapper = $('.shopping-cart-wrapper').outerHeight();

				var $windowHeight = $window.height();
				var $divCartWrapperHeight = 417;
				var $bufferBottom = 40;
				var $maxCartHeight = 287;
				var $heightScroll = '124px';
				var $max_item_product = 3;

				if ($windowHeight - $adminBarHeight - $site_top - $shopping_cart_wrapper - $bufferBottom < $divCartWrapperHeight) {
					$maxCartHeight = 200;
					$heightScroll = '100px';
					$max_item_product = 2;
				}

				$('ul.cart_list.product_list_widget').css('max-height', $maxCartHeight);
				$('ul.cart_list.product_list_widget').perfectScrollbar({
					wheelSpeed: 0.5,
					suppressScrollX: true
				});
				$('ul.cart_list.product_list_widget').perfectScrollbar('update');
				if ($("ul.cart_list.product_list_widget li").length > $max_item_product) {
					$('ul.cart_list.product_list_widget .ps-scrollbar-y').css('height', $heightScroll);
				}
			}, 1000);
		},
		addToWishlist : function() {
			$(document).on('click', '.add_to_wishlist', function () {
				var button = $(this),
					buttonWrap = button.parent().parent();

				if (!buttonWrap.parent().hasClass('single-product-function')) {
					button.addClass("added-spinner");
					var productWrap = buttonWrap.parent().parent().parent().parent();
					if (typeof(productWrap) == 'undefined') {
						return;
					}
					productWrap.addClass('active');
				}

			});

			$body.on("added_to_wishlist", function (event, fragments, cart_hash, $thisbutton) {
				var button = $('.added-spinner.add_to_wishlist'),
					buttonWrap = button.parent().parent();
				if (!buttonWrap.parent().hasClass('single-product-function')) {
					var productWrap = buttonWrap.parent().parent().parent().parent();
					if (typeof(productWrap) == 'undefined') {
						return;
					}
					setTimeout(function () {
						productWrap.removeClass('active');
						button.removeClass('added-spinner');
					}, 700);
				}

			});
		},
		addToCart: function() {
			$(document).on('click', '.add_to_cart_button', function () {
				var button = $(this);
				if (!button.hasClass('single_add_to_cart_button') && button.is( '.product_type_simple' )) {
					var productWrap = button.parent().parent().parent().parent();
					if (typeof(productWrap) == 'undefined') {
						return;
					}
					productWrap.addClass('active');
				}
			});

			$body.on("added_to_cart", function (event, fragments, cart_hash, $thisbutton) {
				G5Plus.woocommerce.setCartScrollBar();
				var is_single_product = $thisbutton.hasClass('single_add_to_cart_button');

				if (is_single_product) return;

				var button = $thisbutton,
					productWrap = button.parent().parent().parent().parent();

				setTimeout(function () {
					productWrap.removeClass('active');
				}, 700);


			});

		},
		singleProductImage: function($productImageWrap){
			var $sliderMain = $productImageWrap.find('.single-product-image-main'),
				$sliderThumb = $productImageWrap.find('.single-product-image-thumb');

			$sliderMain.owlCarousel({
				items: 1,
				nav:false,
				dots:false,
				loop: false,
				rtl: isRTL
			}).on('changed.owl.carousel', syncPosition);

			$sliderThumb.on('initialized.owl.carousel', function () {
				$sliderThumb.find(".owl-item").eq(0).addClass("current");
			}).owlCarousel({
				items : 4,
				nav: false,
				dots: false,
				rtl: isRTL,
				margin: 10,
				responsive: {
					992 : {
						items : 4
					},
					768 : {
						items : 3
					}
				}
			}).on('changed.owl.carousel', syncPosition2);

			function syncPosition(el){
				//if you set loop to false, you have to restore this next line
				var current = el.item.index;

				$sliderThumb
					.find(".owl-item")
					.removeClass("current")
					.eq(current)
					.addClass("current");
				var onscreen = $sliderThumb.find('.owl-item.active').length - 1;
				var start = $sliderThumb.find('.owl-item.active').first().index();
				var end = $sliderThumb.find('.owl-item.active').last().index();

				if (current > end) {
					$sliderThumb.data('owl.carousel').to(current, 100, true);
				}
				if (current < start) {
					$sliderThumb.data('owl.carousel').to(current - onscreen, 100, true);
				}
			}

			function syncPosition2(el) {
				var number = el.item.index;
				$sliderMain.data('owl.carousel').to(number, 100, true);
			}

			$sliderThumb.on("click", ".owl-item", function(e){
				e.preventDefault();
				if ($(this).hasClass('current')) return;
				var number = $(this).index();
				$sliderMain.data('owl.carousel').to(number, 300, true);
			});

			$(document).on('change', '.variations_form .variations select,.variations_form .variation_form_section select,div.select', function () {
				var variation_form = $(this).closest('.variations_form');
				var current_settings = {},
					reset_variations = variation_form.find('.reset_variations');
				variation_form.find('.variations select,.variation_form_section select').each(function () {
					// Encode entities
					var value = $(this).val();

					// Add to settings array
					current_settings[$(this).attr('name')] = $(this).val();
				});

				variation_form.find('.variation_form_section div.select input[type="hidden"]').each(function () {
					// Encode entities
					var value = $(this).val();

					// Add to settings array
					current_settings[$(this).attr('name')] = $(this).val();
				});

				var all_variations = variation_form.data('product_variations');

				var variation_id = 0;
				var match = true;

				for (var i = 0; i < all_variations.length; i++) {
					match = true;
					var variations_attributes = all_variations[i]['attributes'];
					for (var attr_name in variations_attributes) {
						var val1 = variations_attributes[attr_name];
						var val2 = current_settings[attr_name];
						if (val1 == undefined || val2 == undefined) {
							match = false;
							break;
						}
						if (val1.length == 0) {
							continue;
						}

						if (val1 != val2) {
							match = false;
							break;
						}
					}
					if (match) {
						variation_id = all_variations[i]['variation_id'];
						break;
					}
				}

				if (variation_id > 0) {
					var index = parseInt($('a[data-variation_id*="|' + variation_id + '|"]',$sliderMain).data('index'), 10);
					if (!isNaN(index)) {
						$sliderMain.data('owl.carousel').to(index, 300, true);
						setTimeout(function(){
							$sliderMain.data('owl.carousel').to(index, 300, true);
						},1000);
					}
				}
			});

		},
		addCartQuantity: function(){
			$(document).off('click', '.quantity .btn-number').on('click', '.quantity .btn-number', function (event) {
				event.preventDefault();
				var type = $(this).data('type'),
					input = $('input', $(this).parent()),
					current_value = parseFloat(input.val()),
					max  = parseFloat(input.attr('max')),
					min = parseFloat(input.attr('min')),
					step = parseFloat(input.attr('step')),
					stepLength = 0;
				if (input.attr('step').indexOf('.') > 0) {
					stepLength = input.attr('step').split('.')[1].length;
				}

				if (isNaN(max)) {
					max = 100;
				}
				if (isNaN(min)) {
					min = 0;
				}
				if (isNaN(step)) {
					step = 1;
					stepLength = 0;
				}

				if (!isNaN(current_value)) {
					if (type == 'minus') {
						if (current_value > min) {
							current_value = (current_value - step).toFixed(stepLength);
							input.val(current_value).change();
						}

						if (parseFloat(input.val()) <= min) {
							input.val(min).change();
							$(this).attr('disabled', true);
						}
					}

					if (type == 'plus') {
						if (current_value < max) {
							current_value = (current_value + step).toFixed(stepLength);
							input.val(current_value).change();
						}
						if (parseFloat(input.val()) >= max) {
							input.val(max).change();
							$(this).attr('disabled', true);
						}
					}
				} else {
					input.val(min);
				}
			});


			$('input', '.quantity').on('focusin',function () {
				$(this).data('oldValue', $(this).val());
			});

			$('input', '.quantity').on('change', function () {
				var input = $(this),
					max = parseFloat(input.attr('max')),
					min = parseFloat(input.attr('min')),
					current_value = parseFloat(input.val()),
					step = parseFloat(input.attr('step'));

				if (isNaN(max)) {
					max = 100;
				}
				if (isNaN(min)) {
					min = 0;
				}

				if (isNaN(step)) {
					step = 1;
				}


				var btn_add_to_cart = $('.add_to_cart_button', $(this).parent().parent().parent());
				if (current_value >= min) {
					$(".btn-number[data-type='minus']", $(this).parent()).removeAttr('disabled');
					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', current_value);
					}

				} else {
					alert('Sorry, the minimum value was reached');
					$(this).val($(this).data('oldValue'));

					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', $(this).data('oldValue'));
					}
				}

				if (current_value <= max) {
					$(".btn-number[data-type='plus']", $(this).parent()).removeAttr('disabled');
					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', current_value);
					}
				} else {
					alert('Sorry, the maximum value was reached');
					$(this).val($(this).data('oldValue'));
					if (typeof(btn_add_to_cart) != 'undefined') {
						btn_add_to_cart.attr('data-quantity', $(this).data('oldValue'));
					}
				}

			});
		},
		processWidgetTitle: function(){
			$('.cart_totals > h2,.woocommerce-account .woocommerce h3,.woocommerce-account .woocommerce h2,.woocommerce-checkout .woocommerce h3,.woocommerce-checkout .woocommerce h2').each(function(){
				$(this).addClass('widget-title mg-bottom-30').html('<span>'+ $(this).html().trim() +'</span>');
			});
		},
		quickView: function(){
			var is_click_quick_view = false;
			$(document).on('click', '.product-quick-view', function (event) {
				event.preventDefault();
				if (is_click_quick_view) return;
				is_click_quick_view = true;
				var product_id = $(this).data('product_id'),
					popupWrapper = '#popup-product-quick-view-wrapper',
					$icon = $(this).find('i'),
					iconClass = $icon.attr('class'),
					productWrap = $(this).parent().parent().parent().parent(),
					button = $(this);
				productWrap.addClass('active');
				button.addClass('active');
				$icon.attr('class','fa fa-spinner fa-pulse');
				$.ajax({
					url: g5plus_app_variable.ajax_url,
					data: {
						action: 'product_quick_view',
						id: product_id
					},
					success: function (html) {
						productWrap.removeClass('active');
						button.removeClass('active');
						$icon.attr('class',iconClass);
						if ($(popupWrapper).length) {
							$(popupWrapper).remove();
						}
						$('body').append(html);
						G5Plus.woocommerce.addCartQuantity();
						G5Plus.common.tooltip();
						G5Plus.woocommerce.sale_countdown();


						var $productImageWrap = $('#quick-view-product-image');
						G5Plus.woocommerce.singleProductImage($productImageWrap);

						if( typeof $.fn.wc_variation_form !== 'undefined' ) {
							var form_variation = $(popupWrapper).find( '.variations_form' );
							var form_variation_select = $(popupWrapper).find( '.variations_form .variations select' );
							form_variation.wc_variation_form();
							form_variation.trigger( 'check_variations' );
							form_variation_select.change();
						}

						$(popupWrapper).modal();
						is_click_quick_view = false;
						G5Plus.common.lightGallery();
					},
					error: function (html) {
						is_click_quick_view = false;
					}
				});

			});
		},
		sale_countdown: function(){
			$('.product-deal-countdown').each(function(){
				var date_end = $(this).data('date-end');
				var $this = $(this);
				$this.countdown(date_end,function(event){
					count_down_callback(event,$this);
				}).on('update.countdown', function(event) {
					count_down_callback(event,$this);
				});
			});

			function count_down_callback(event,$this) {
				var seconds = parseInt(event.offset.seconds);
				var minutes = parseInt(event.offset.minutes);
				var hours = parseInt(event.offset.hours);
				var days = parseInt(event.offset.totalDays);

				//if ((seconds == 0)&& (minutes == 0) && (hours == 0) && (days == 0)) {
				//	$this.remove();
				//	return;
				//}

				if (days < 10) days = '0' + days;
				if (hours < 10) hours = '0' + hours;
				if (minutes < 10) minutes = '0' + minutes;
				if (seconds < 10) seconds = '0' + seconds;


				$('.countdown-day',$this).text(days);
				$('.countdown-hours',$this).text(hours);
				$('.countdown-minutes',$this).text(minutes);
				$('.countdown-seconds',$this).text(seconds);
			}

			G5Plus.woocommerce.sale_countdown_width();

		},
		sale_countdown_width: function(){
			$('.product-deal-countdown').each(function(){
				var innerWidth = 0;
				$(this).removeClass('small');
				$('.countdown-section',$(this)).each(function(){
					innerWidth += $(this).outerWidth() + parseInt($(this).css('margin-right').replace("px", ''),10);
				});
				if (innerWidth > $(this).outerWidth()) {
					$(this).addClass('small');
				}
			});
		},
		categoryName : function(){
			$('.product-listing.woocommerce .product-category h3').each(function(){
				$(this).css('margin-bottom' , '-' + Math.floor($(this).outerHeight() / 2) + 'px');
			})
		},
		product_deal_width: function(){
			$('.g5plus-product-deals').each(function(){
				var $this = $(this);
				$this.removeClass('product-item-vertical');
				$this.imagesLoaded({ background: true }, function() {
					if (has_vertical($this)) {
						$this.addClass('product-item-vertical');
					}
				});
			});

			function has_vertical($wrap){
				var vertical = false;
				$('.product-item-wrap',$wrap).each(function(){
					var $productThumb = $('.product-thumb img',$(this)),
						$productInfo = $('.product-info',$(this));
					if ($productThumb.outerHeight() < $productInfo.outerHeight()) {
						vertical = true;
						return false;
					}
				});
				return vertical;
			}
		}
	};

	G5Plus.search = {

	};

	G5Plus.header = {
		timeOutSearch: null,
		xhrSearchAjax: null,
		init: function () {
			this.anchoPreventDefault();
			this.topDrawerToggle();
			this.switchMenu();
			this.sticky();
			this.menuCategories();
			this.searchProduct();
			this.searchButton();
			this.closeButton();
			this.searchAjaxButtonClick();
			this.closestElement();
			this.menuMobileToggle();
			$('[data-search="ajax"]').each(function() {
				G5Plus.header.searchAjax($(this));
			});

			this.escKeyPress();
			this.mobileNavOverlay();
			this.perfectScroll();
		},
		windowsScroll: function() {
			this.sticky();
			this.menuDropFlyPosition();
		},
		windowResized : function(){
			this.sticky();
			this.menuDropFlyPosition();
		},
		windowLoad: function() {
		},
		topDrawerToggle: function () {
			$('.top-drawer-toggle').on('click', function () {
				$('.top-drawer-inner').slideToggle();
				$('.top-drawer-wrapper').toggleClass('in');
			});
		},
		switchMenu: function() {
			$('header .menu-switch').on('click', function() {
				$('.header-nav-inner').toggleClass('in');
			});
		},
		menuCategories: function() {
			$('.menu-categories-select > i').on('click', function() {
				$('.menu-categories').toggleClass('in');
			});
		},
		sticky: function() {
			$('.sticky-wrapper').each(function() {
				var $this = $(this);
				var stickyHeight = 60;
				if (G5Plus.common.isDesktop()) {
					stickyHeight = 55;
				}
				if ($(document).outerHeight() - $this.outerHeight() - $this.offset().top  <= $window.outerHeight() - stickyHeight) {
					$this.removeClass('is-sticky');
					$('.sticky-region', $this).css('top','');
					return;
				}
				var adminBarHeight = 0;
				if ($('#wpadminbar').length && ($('#wpadminbar').css('position') == 'fixed')) {
					adminBarHeight = $('#wpadminbar').outerHeight();
				}
				if ($(window).scrollTop() > $this.offset().top - adminBarHeight) {
					$this.addClass('is-sticky');
					$('.sticky-region', $this).css('top',adminBarHeight + 'px');
				}
				else {
					$this.removeClass('is-sticky');
					$('.sticky-region', $this).css('top','');
				}
			});
		},

		searchProduct: function() {
			$('.search-product-wrapper .categories').each(function() {
				var $this = $(this),
					$parent = $this.parent();
				$('> span', $this).on('click', function () {
					$('.search-category-dropdown',$parent).slideToggle();
					$(this).toggleClass('in');
					$('.search-ajax-result',$parent).html('');
					$('input[type="text"]',$parent).val('');
				});
				$('.search-category-dropdown span', $this).on('click', function () {
					$('> span', $this).html($(this).html());
					$('> span', $this).attr('data-id', $(this).attr('data-id'));
					$('.search-category-dropdown',$parent).slideToggle();
					$('> span', $this).toggleClass('in');
				});
			});
		},

		searchButton: function () {
			var $itemSearch = $('.header-customize-item.item-search > a, .mobile-search-button > a');
			if (!$itemSearch.length) {
				return;
			}
			var $searchPopup = $('#search_popup_wrapper');
			if (!$searchPopup.length) {
				return;
			}
			if ($itemSearch.hasClass('search-ajax')) {
				$itemSearch.on('click', function() {
					$window.scrollTop(0);
					$searchPopup.addClass('in');
					$('body').addClass('overflow-hidden');
					var $input = $('input[type="text"]', $searchPopup);
					$input.focus();
					$input.val('');

					var $result = $('.search-ajax-result', $searchPopup);
					$result.html('');
				});
			}
			else {
				var dlgSearch = new DialogFx( $searchPopup[0] );
				$itemSearch.on('click', dlgSearch.toggle.bind(dlgSearch));
				$itemSearch.on('click', function() {
					var $input = $('input[type="text"]', $searchPopup);

					$input.focus();
					$input.val('');
				});
			}
		},
		searchAjax: function ($wrapper) {
			$('input[type="text"]', $wrapper).on('keyup', function (event) {
				if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
					return;
				}
				var keys = ["Control", "Alt", "Shift"];
				if (keys.indexOf(event.key) != -1) return;
				switch (event.which) {
					case 27:	// ESC
						$('.search-ajax-result', $wrapper).html('');
						$wrapper.removeClass('in');
						$(this).val('');
						break;
					case 38:	// UP
						G5Plus.header.searchAjaxKeyUp($wrapper);
						event.preventDefault();
						break;
					case 40:	// DOWN
						G5Plus.header.searchAjaxKeyDown($wrapper);
						event.preventDefault();
						break;
					case 13:
						G5Plus.header.searchAjaxKeyEnter($wrapper);
						break;
					default:
						clearTimeout(G5Plus.header.timeOutSearch);
						G5Plus.header.timeOutSearch = setTimeout(G5Plus.header.searchAjaxSearchProcess, 500, $wrapper, false);
						break;
				}
			});
		},
		searchAjaxKeyUp: function($wrapper) {
			var $item = $('.search-ajax-result li.selected', $wrapper);
			if ($('.search-ajax-result li', $wrapper).length < 2) return;
			var $prev = $item.prev();
			$item.removeClass('selected');
			if ($prev.length) {
				$prev.addClass('selected');
			}
			else {
				$('.search-ajax-result li:last', $wrapper).addClass('selected');
				$prev = $('.search-ajax-result li:last', $wrapper);
			}
			if ($prev.position().top < $('.ajax-search-result', $wrapper).scrollTop()) {
				$('.ajax-search-result', $wrapper).scrollTop($prev.position().top);
			}
			else if ($prev.position().top + $prev.outerHeight() > $('.ajax-search-result', $wrapper).scrollTop() + $('.ajax-search-result', $wrapper).height()) {
				$('.ajax-search-result', $wrapper).scrollTop($prev.position().top - $('.ajax-search-result', $wrapper).height() + $prev.outerHeight());
			}
		},
		searchAjaxKeyDown: function($wrapper) {
			var $item = $('.search-ajax-result li.selected', $wrapper);
			if ($('.search-ajax-result li', $wrapper).length < 2) return;
			var $next = $item.next();
			$item.removeClass('selected');
			if ($next.length) {
				$next.addClass('selected');
			}
			else {
				$('.search-ajax-result li:first', $wrapper).addClass('selected');
				$next = $('.search-ajax-result li:first', $wrapper);
			}
			if ($next.position().top < $('.search-ajax-result', $wrapper).scrollTop()) {
				$('.search-ajax-result', $wrapper).scrollTop($next.position().top);
			}
			else if ($next.position().top + $next.outerHeight() > $('.search-ajax-result', $wrapper).scrollTop() + $('.search-ajax-result', $wrapper).height()) {
				$('.search-ajax-result', $wrapper).scrollTop($next.position().top - $('.search-ajax-result', $wrapper).height() + $next.outerHeight());
			}
		},
		searchAjaxKeyEnter: function($wrapper) {
			var $item = $('.search-ajax-result li.selected a', $wrapper);
			if ($item.length > 0) {
				window.location = $item.attr('href');
			}
		},
		searchAjaxSearchProcess: function($wrapper, isButtonClick) {
			var keyword = $('input[type="text"]', $wrapper).val();
			if (!isButtonClick && keyword.length < 3) {
				$('.search-ajax-result', $wrapper).html('');
				return;
			}
			$('.search-button i', $wrapper).addClass('fa-spinner fa-spin');
			$('.search-button i', $wrapper).removeClass('fa-search');
			if (G5Plus.header.xhrSearchAjax) {
				G5Plus.header.xhrSearchAjax.abort();
			}
			var action = $wrapper.attr('data-ajax-action');
			var data = 'action=' + action + '&keyword=' + keyword;
			if ($('.categories > span[data-id]', $wrapper)) {
				data += '&cate_id=' + $('.categories > span[data-id]', $wrapper).attr('data-id');
			}

			G5Plus.header.xhrSearchAjax = $.ajax({
				type   : 'POST',
				data   : data,
				url    : g5plus_app_variable.ajax_url,
				success: function (data) {
					$('.search-button i', $wrapper).removeClass('fa-spinner fa-spin');
					$('.search-button i', $wrapper).addClass('fa-search');
					$wrapper.addClass('in');
					$('.search-ajax-result', $wrapper).html(data);
				},
				error : function(data) {
					if (data && (data.statusText == 'abort')) {
						return;
					}
					$('.search-button i', $wrapper).removeClass('fa-spinner fa-spin');
					$('.search-button i', $wrapper).addClass('fa-search');
				}
			});
		},
		searchAjaxButtonClick: function () {
			$('.search-button').on('click', function() {
				var $wrapper = $($(this).attr('data-search-wrapper'));
				G5Plus.header.searchAjaxSearchProcess($wrapper, true);
			});
		},
		menuMobileToggle: function() {
			$('.toggle-icon-wrapper > .toggle-icon').on('click', function() {
				var $this = $(this);
				var $parent = $this.parent();
				var dropType = $parent.attr('data-drop-type');
				$parent.toggleClass('in');
				if (dropType == 'menu-drop-fly') {
					$('body').toggleClass('mobile-nav-in');
				}
				else {
					$('.nav-menu-mobile').slideToggle();
				}
			});
		},
		escKeyPress: function() {
			$(document).on('keyup', function(event) {
				if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
					return;
				}
				var keys = ["Control", "Alt", "Shift"];
				if (keys.indexOf(event.key) != -1) return;
				if (event.which == 27) {
					if ($('#search_popup_wrapper').hasClass('in')) {
						$('#search_popup_wrapper').removeClass('in');
						setTimeout(function() {
							$('body').removeClass('overflow-hidden');
						}, 500);

					}

				}
			});
		},
		anchoPreventDefault: function() {
			$('.prevent-default').on('click', function(event) {
				event.preventDefault();
			});
		},
		closeButton: function() {
			$('.close-button').on('click', function() {
				var $closeButton = $(this);
				var ref = $closeButton.attr('data-ref');
				if ($('#search_popup_wrapper').hasClass('in')) {
					setTimeout(function() {
						$('body').removeClass('overflow-hidden');
					}, 500);
				}
				$(ref).removeClass('in');
			});

		},
		closestElement: function() {
			$($window).on('click',function(event){
				if ($(event.target).closest('.search-product-wrapper .categories').length == 0) {
					$('.search-product-wrapper .search-category-dropdown').slideUp();
					$('.search-product-wrapper .categories > span').removeClass('in');
				}

				if ($(event.target).closest('.search-product-wrapper').length == 0) {
					$('.search-ajax-result').html('');
					$('.search-product-wrapper').removeClass('in');
					$('input[type="text"]','.search-product-wrapper').val('');
				}
			});
		},
		mobileNavOverlay: function() {
			$('.mobile-nav-overlay').on('click', function() {
				$('body').removeClass('mobile-nav-in');
				$('.toggle-mobile-menu').removeClass('in');
			})
		},
		menuDropFlyPosition: function() {
			var adminBarHeight = 0;
			if ($('#wpadminbar').length && ($('#wpadminbar').css('position') == 'fixed')) {
				adminBarHeight = $('#wpadminbar').outerHeight();
			}
			$('.header-mobile-nav.menu-drop-fly').css('top', adminBarHeight + 'px');
		},
		perfectScroll: function() {
			var $cartContent = $('.categories .search-category-dropdown');
			$cartContent.perfectScrollbar({
				wheelSpeed: 0.5,
				suppressScrollX: true
			});
		}
	};

	G5Plus.footer = {
		init: function () {

		}
	};

	G5Plus.widget = {
		init: function() {
			this.categoryCaret();

		},
		categoryCaret: function() {
			$('li', '.widget_categories, .widget_pages, .widget_nav_menu, .widget_product_categories, .product-categories').each(function() {
				if ($(' > ul', this).length > 0) {
					$(this).append('<span class="li-caret fa fa-plus"></span>');
				}
			});
			$('.li-caret').on('click', function(){
				$(this).toggleClass('in');
				$(' > ul', $(this).parent()).slideToggle();
			});
		}

	};

	G5Plus.onReady = {
		init: function () {
			G5Plus.common.init();
			G5Plus.header.init();
			G5Plus.page.init();
			G5Plus.blog.init();
			G5Plus.woocommerce.init();
			G5Plus.footer.init();
			G5Plus.widget.init();
		}
	};

	G5Plus.onLoad = {
		init: function () {
			G5Plus.header.windowLoad();
			G5Plus.page.windowLoad();
			G5Plus.woocommerce.windowLoad();
		}
	};

	G5Plus.onResize = {
		init: function () {
			G5Plus.common.windowResized();
			G5Plus.page.windowResized();
			G5Plus.woocommerce.windowResized();
			G5Plus.header.windowResized();
			G5Plus.blog.windowResized();
		}
	};

	G5Plus.onScroll = {
		init: function () {
			G5Plus.header.windowsScroll();
			G5Plus.common.windowScroll();
		}
	};

	$(window).resize(G5Plus.onResize.init);
	$(window).scroll(G5Plus.onScroll.init);
	$(document).ready(G5Plus.onReady.init);
	$(window).load(G5Plus.onLoad.init);
})(jQuery);

