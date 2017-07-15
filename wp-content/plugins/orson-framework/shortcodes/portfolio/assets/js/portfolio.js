(function ($) {
	"use strict";
	var checkFilter = true;
	var G5Plus_portfolio = {
		vars: {
			filter_id: '',
			portfolio_items: [],
			galleries: []
		},
		init: function () {
			this.filterCarousel();
			this.filterRow();
			this.loadMore();
			this.viewGallery();
			this.resize();
			this.selectCategory();
			this.singleTwoColumns();
		},
		singleTwoColumns: function () {
			var $gallery = $('.portfolio-images', '.portfolio-two-columns');
			var $scrollInfo = $('.portfolio-content-wrap', '.portfolio-two-columns');
			if (typeof $gallery != 'undefined' && typeof $scrollInfo != 'undefined') {
				var $galleryHeight = $($gallery).outerHeight();
				var $scrollInfoHeight = $($scrollInfo).outerHeight();
				if (typeof  $($scrollInfo).position() != 'undefined') {
					var $scrollInfoTop = $($gallery).position().top;
					var $maxScroll = $galleryHeight - $scrollInfoHeight;
					$(window).scroll(function () {
						G5Plus_portfolio.scrollInfo($scrollInfo, $maxScroll, $scrollInfoTop);
					});
					$(window).resize(function () {
						G5Plus_portfolio.scrollInfo($scrollInfo, $maxScroll, $scrollInfoTop);
					})
				}
			}
		},
		loadMore: function () {
			var check = true;
			$('.portfolio-load-more').each(function () {
				$(this).on('click', function (event) {
					event.preventDefault();
					if (check) {
						check = false;
						var $portfolio_content = $(this).parent().prev();
						var $this = $(this).button('loading');
						var portfolio_load_more = $(this);
						$.ajax({
							url: g5plus_portfolio_meta.ajax_url,
							data: {
								action: 'portfolio_load_more',
								current_page: portfolio_load_more.data('current_page'),
								columns: portfolio_load_more.data('columns'),
								category: portfolio_load_more.data('category'),
								item_per_page: portfolio_load_more.data('item_per_page'),
								overlay_style: portfolio_load_more.data('overlay_style'),
								icon_color_scheme: portfolio_load_more.data('icon_color_scheme'),
								image_size: portfolio_load_more.data('image_size'),
								padding: portfolio_load_more.data('padding')
							},
							success: function (html) {
								var $newElems = $('.portfolio-item', html).css({
									opacity: 0
								});
								var current_page = $('.portfolio-load-more', html).attr('data-current_page');
								if(typeof(current_page) != 'undefined') {
									portfolio_load_more.attr('data-current_page',current_page);
									portfolio_load_more.data('current_page',current_page);
								} else {
									portfolio_load_more.parent().remove();
								}

								$portfolio_content.append($newElems);
								$newElems.imagesLoaded({background: true}, function () {
									$newElems.animate({
										opacity: 1
									});
									$portfolio_content.isotope('appended', $newElems);
									$this.button('reset');
									$portfolio_content.prev().children().children().first().click();
									check = true;
								});
							},
							error: function (html) {
								check = true;
							}
						});
					}
				});
			});
		},
		filterCarousel: function () {
			$('.portfolio-category.owl-carousel').each(function () {
				var object = $(this).prev().children().children('a');
				$(object).button({
					loadingText: '<span class="fa fa-spinner fa-spin"></span> Loading...'
				});
				$(object).parent().next('select').children().button({
					loadingText: '<span class="fa fa-spinner fa-spin"></span> Loading...'
				});
				$(object).on('click', function (event) {
					event.preventDefault();
					var thisObject = $(this);
					var check = true;
					if (thisObject.hasClass('filter-active') || (thisObject.hasClass('btn') && !thisObject.hasClass('btn-light'))) {
						thisObject.css('cursor', 'not-allowed');
						check = false;
					} else {
						thisObject.parent().children('a').css('cursor', 'wait');
						if (checkFilter && check) {
							checkFilter = false;
							var dataFilter = $(this).data('filter');
							thisObject.parent().next('select').children('option').removeAttr('selected');
							thisObject.parent().next('select').children('option[value="' + dataFilter + '"]').attr('selected', 'selected');
							G5Plus_portfolio.vars.filter_id = thisObject.parent().data('filter_id');
							thisObject.parent().children('.btn').addClass('btn-light');
							thisObject.removeClass('btn-light');
							thisObject.parent().children('a').removeClass('filter-active');
							thisObject.addClass('filter-active');

							var g5plus_portfolio = thisObject.parent().parent().parent();
							g5plus_portfolio.css('height',g5plus_portfolio.outerHeight());
							if (typeof G5Plus_portfolio.vars.portfolio_items[dataFilter + '-' + G5Plus_portfolio.vars.filter_id] == 'undefined') {
								var $this = thisObject.button('loading');
								thisObject.parent().next('select').children().button('loading');
								$.ajax({
									url: g5plus_portfolio_meta.ajax_url,
									data: {
										action: 'portfolio_filter_carousel',
										category: thisObject.data('filter'),
										hover_effect: thisObject.parent().data('hover_effect'),
										columns: thisObject.parent().data('columns'),
										overlay_style: thisObject.parent().data('overlay_style'),
										icon_color_scheme: thisObject.parent().data('icon_color_scheme'),
										image_size: thisObject.parent().data('image_size'),
										padding: thisObject.parent().data('padding')
									},
									success: function (html) {
										var $newElems = $('.portfolio-item', html);
										G5Plus_portfolio.vars.portfolio_items[dataFilter + '-' + G5Plus_portfolio.vars.filter_id] = $newElems;
										var $portfolio_content = thisObject.parent().parent().next('.portfolio-category.owl-carousel');

										$portfolio_content.css('opacity', 0);
										$portfolio_content.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
										$portfolio_content.find('.owl-stage-outer').children().unwrap();
										$portfolio_content.html($newElems);

										G5Plus_portfolio.setItemEffect($newElems, 'hide');
										$portfolio_content.css('opacity', 1);
										$portfolio_content.addClass('owl-carousel');
										G5Plus.common.owlCarousel();
										$portfolio_content.imagesLoaded(function () {
											$newElems = $('.portfolio-item', $portfolio_content);
											G5Plus_portfolio.setItemEffect($newElems, 'show');
											g5plus_portfolio.css('height','auto');
										});

										$this.button('reset');
										thisObject.parent().next('select').children().button('reset');
										checkFilter = true;
										thisObject.parent().next('select').removeAttr('disabled');
										thisObject.parent().children('a').css('cursor', 'pointer');
										thisObject.parent().children('.filter-active' || 'a:not(.btn-light)').css('cursor', 'not-allowed');
									},
									error: function (html) {
										$this.button('reset');
										checkFilter = true;
									}
								});
							} else {
								var $portfolio_content = thisObject.parent().parent().next('.portfolio-category.owl-carousel');
								var $newElems = G5Plus_portfolio.vars.portfolio_items[dataFilter + '-' + G5Plus_portfolio.vars.filter_id];
								$portfolio_content.css('opacity', 0);
								$portfolio_content.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
								$portfolio_content.find('.owl-stage-outer').children().unwrap();
								$portfolio_content.html($newElems);

								G5Plus_portfolio.setItemEffect($newElems, 'hide');
								$portfolio_content.css('opacity', 1);
								$portfolio_content.addClass('owl-carousel');
								G5Plus.common.owlCarousel();
								$portfolio_content.imagesLoaded(function () {
									$newElems = $('.portfolio-item', $portfolio_content);
									G5Plus_portfolio.setItemEffect($newElems, 'show');
									g5plus_portfolio.css('height','auto');
								});

								checkFilter = true;
								thisObject.parent().next('select').removeAttr('disabled');
								thisObject.parent().children('a').css('cursor', 'pointer');
								thisObject.parent().children('.filter-active' || 'a:not(.btn-light)').css('cursor', 'not-allowed');
							}
						}
					}
				});
			});
		},
		filterRow: function () {
			var portfolio_filter = $('.portfolio-filter');
			var isRTL = $('body').hasClass('rtl');

			$('.portfolio-content:not(".owl-carousel")').each(function () {
				var $this = $(this);
				$this.imagesLoaded(function () {
					$this.isotope({
						itemSelector: '.portfolio-item',
						layoutMode: 'fitRows',
						isOriginLeft: !isRTL,
						transitionDuration: '0.8s'
					});
				});
			});
			$(portfolio_filter).each(function () {
				$(this).on('click', 'a', function () {
					var check = true;
					if ($(this).hasClass('filter-active') || ($(this).hasClass('btn') && !$(this).hasClass('btn-light'))) {
						check = false;
					}
					var $grid = $(this).parent().parent().next('.portfolio-content');
					if (checkFilter && check) {
						var filterValue = $(this).attr('data-filter');
						$grid.isotope({filter: filterValue});
						$(this).parent().children('a').css('cursor','pointer');
						$(this).css('cursor','not-allowed');
						$(this).parent().next('select').removeAttr('disabled');
						$(this).parent().next('select').children('option').removeAttr('selected');
						$(this).parent().next('select').children('option[value="' + filterValue + '"]').attr('selected', 'selected');
					}
				});
				$(this).on('click', '.filter-tab', function () {
					var check = true;
					if ($(this).hasClass('filter-active') || ($(this).hasClass('btn') && !$(this).hasClass('btn-light'))) {
						check = false;
					}
					if (checkFilter && check) {
						$(this).parent().children('.filter-tab').removeClass('filter-active');
						$(this).addClass('filter-active');
					}
				});
				$(this).on('click', '.btn', function () {
					var check = true;
					if ($(this).hasClass('filter-active') || ($(this).hasClass('btn') && !$(this).hasClass('btn-light'))) {
						check = false;
					}
					if (checkFilter && check) {
						$(this).parent().children('.btn').addClass('btn-light');
						$(this).removeClass('btn-light');
					}
				});
			});
			var archive_active = $('.filter-archive').data('active');
			if (typeof(archive_active) != 'undefined') {
				var archive_filter = $(".filter-archive a[data-filter='" + archive_active + "']");
				archive_filter.click();
			}
			$('.portfolio-content').isotope();
		},
		transformY: function ($elm, $to) {
			$elm.css('transform', 'translateY(' + $to + 'px)');
			$elm.css('-webkit-transform', 'translateY(' + $to + 'px)');
			$elm.css('transform', 'translateY(' + $to + 'px)');
		},
		scrollInfo: function ($scrollInfo, $maxScroll, $scrollInfoTop) {
			var $windowTop = $(window).scrollTop() + 120;
			var $windowWidth = $(window).width();
			var $to = $windowTop - $scrollInfoTop;
			if ($windowWidth > 992 && $maxScroll > 0 && $to > 0) {
				if ($to <= $maxScroll) {
					G5Plus_portfolio.transformY($scrollInfo, $to);
				} else {
					G5Plus_portfolio.transformY($scrollInfo, $maxScroll);
				}
			} else {
				G5Plus_portfolio.transformY($scrollInfo, 0);
			}
		},
		viewGallery: function () {
			$(document).on('click', 'a.view-gallery', function (event) {
				event.preventDefault();
				var object = $('a.view-gallery');
				$(object).button({
					loadingText: '<span class="fa fa-spinner fa-spin"></span>'
				});
				var $post_id = $(this).attr('data-post-id');
				var $this = $(this);
				if (typeof G5Plus_portfolio.vars.galleries[$post_id] == 'undefined') {
					var $thisButton = $(this).button('loading');
					$.ajax({
						url: g5plus_portfolio_meta.ajax_url,
						type: 'GET',
						data: ({
							action: 'portfolio_load_gallery',
							post_id: $post_id
						}),
						success: function (data) {
							var $galleries = JSON.parse(data);
							$this.lightGallery({
								dynamic: true,
								dynamicEl: $galleries,
								thumbWidth: 80
							});
							$thisButton.button('reset');
							G5Plus_portfolio.vars.galleries[$post_id] = JSON.parse(data);
						},
						error: function () {
							$thisButton.button('reset');
						}
					});
				} else {
					$this.lightGallery({
						dynamic: true,
						dynamicEl: G5Plus_portfolio.vars.galleries[$post_id]
					});
					if (typeof l != 'undefined') {
						l.stop();
						$this.removeClass('onclick');
					}
				}
			});
		},
		setItemEffect: function ($items, $effect) {
			if ($effect == 'hide') {
				$items.css('transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-webkit-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-moz-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-ms-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-o-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('opacity', 0);
				$items.css('transform', 'scale(0.2)');
				$items.css('-ms-transform', 'scale(0.2)');
				$items.css('-webkit-transform', 'scale(0.2)');
			}
			if ($effect == 'show') {
				for (var $i = 0; $i < $items.length; $i++) {
					(function ($index) {
						var $delay = 100 * $i;
						setTimeout(function () {
							$($items[$index]).css('opacity', 1);
							$($items[$index]).css('transform', 'scale(1)');
							$($items[$index]).css('-ms-transform', 'scale(1)');
							$($items[$index]).css('-webkit-transform', 'scale(1)');
						}, $delay);
					})($i);
				}
			}
		},
		resize: function () {
			$(window).resize(function () {
				$('.portfolio-category.owl-carousel').each(function () {
					var container = $(this);
					setTimeout(function () {
						var $items = $('.portfolio-item', container);
						G5Plus_portfolio.setItemEffect($items, 'show');
					}, 500);
				});
			});
			$(window).on('orientationchange', function () {
				$('.portfolio-category.owl-carousel').each(function () {
					var container = $(this);
					setTimeout(function () {
						var $items = $('.portfolio-item', container);
						G5Plus_portfolio.setItemEffect($items, 'show');
					}, 500);
				});
			});
		},
		selectCategory: function () {
			var $elm = $('select.portfolio-filter-group');
			$elm.off();
			$($elm).on('change', function (event) {
				$(this).attr('disabled', 'disabled');
				event.preventDefault();
				var optionValue = $('option:selected', this).attr('value');
				var object = $(this).prev().children('[data-filter="' + optionValue + '"]');
				object.click();
			});
		}
	};
	$(document).ready(function () {
		G5Plus_portfolio.init();
	});
	$(window).resize(function () {
		G5Plus_portfolio.singleTwoColumns();
	})
})(jQuery);