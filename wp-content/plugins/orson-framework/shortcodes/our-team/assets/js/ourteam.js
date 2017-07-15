(function ($) {
	"use strict";
	var checkFilter = true;
	var G5Plus_OurTeam = {
		vars: {
			filter_id: '',
			ourteam_items: []
		},
		init: function () {
			this.filterCarousel();
			this.filterRow();
			this.loadMore();
			this.resize();
			this.selectCategory();
		},
		loadMore: function () {
			var check = true;
			$('.ot-load-more').each(function () {
				$(this).on('click', function (event) {
					event.preventDefault();
					if (check) {
						var ot_load_more = $(this);
						ot_load_more.css('cursor', 'not-allowed');
						check = false;
						var $ourteam_content = $(this).parent().prev();
						var $this = $(this).button('loading');
						$.ajax({
							url: g5plus_ourteam_meta.ajax_url,
							data: {
								action: 'ourteam_load_more',
								current_page: ot_load_more.data('current_page'),
								columns: ot_load_more.data('columns'),
								category: ot_load_more.data('category'),
								post_per_page: ot_load_more.data('post_per_page'),
								layout_style: ot_load_more.data('layout_style')
							},
							success: function (html) {
								var $newElems = $('.ourteam-item', html).css({
									opacity: 0
								});
								var current_page = $('.ot-load-more', html).attr('data-current_page');
								if(typeof(current_page) != 'undefined') {
									ot_load_more.attr('data-current_page',current_page);
									ot_load_more.data('current_page',current_page);
								} else {
									ot_load_more.parent().remove();
								}
								$ourteam_content.append($newElems);

								$newElems.imagesLoaded({background: true}, function () {
									$newElems.animate({
										opacity: 1
									});
									$ourteam_content.isotope('appended', $newElems);
								});
								ot_load_more.css('cursor', 'pointer');
								$this.button('reset');
								$ourteam_content.prev().children().first().click();
								check = true;
							},
							error: function (html) {
								$this.button('reset');
								ot_load_more.css('cursor', 'pointer');
								check = true;
							}
						});
					}
				});
			});
		},
		filterCarousel: function () {
			$('.ourteam-tab.owl-carousel').each(function () {
				var object = $(this).prev().children('a');
				$(object).button({
					loadingText: '<span class="fa fa-spinner fa-spin"></span> Loading...'
				});
				$(object).parent().prev().children('option').button({
					loadingText: '<span class="fa fa-spinner fa-spin"></span> Loading...'
				});
				$(object).on('click', function (event) {
					event.preventDefault();
					var check = true;
					var filterObject = $(this);
					if (!filterObject.hasClass('btn-light')) {
						filterObject.css('cursor', 'not-allowed');
						check = false;
					} else {
						filterObject.parent().children('a').css('cursor', 'wait');
						if (checkFilter && check) {
							checkFilter = false;
							var dataFilter = $(this).data('filter');
							filterObject.parent().prev().children('option').removeAttr('selected');
							filterObject.parent().prev().children('option[value="' + dataFilter + '"]').attr('selected', 'selected');
							G5Plus_OurTeam.vars.filter_id = filterObject.parent().data('filter_id');
							filterObject.parent().children('a').addClass('btn-light');
							filterObject.removeClass('btn-light');

							var g5plus_ourteam = filterObject.parent().parent();
							g5plus_ourteam.css('height',g5plus_ourteam.outerHeight());
							if (typeof G5Plus_OurTeam.vars.ourteam_items[dataFilter + '-' + G5Plus_OurTeam.vars.filter_id] == 'undefined') {
								var $this = filterObject.button('loading');
								filterObject.parent().prev().children('option').button('loading');
								$.ajax({
									url: g5plus_ourteam_meta.ajax_url,
									data: {
										action: 'ourteam_filter_carousel',
										layout_style: filterObject.parent().data('layout_style'),
										category: filterObject.data('filter'),
										columns: filterObject.parent().data('columns'),
										item_amounts: filterObject.parent().data('item_amounts')
									},
									success: function (html) {
										var $newElems = $('.ourteam-item', html);
										G5Plus_OurTeam.vars.ourteam_items[dataFilter + '-' + G5Plus_OurTeam.vars.filter_id] = $newElems;
										var $ourteam_content = filterObject.parent().next('.ourteam-tab.owl-carousel');
										$ourteam_content.css('opacity', 0);
										$ourteam_content.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
										$ourteam_content.find('.owl-stage-outer').children().unwrap();
										$ourteam_content.html($newElems);

										G5Plus_OurTeam.setItemEffect($newElems, 'hide');
										$ourteam_content.css('opacity', 1);
										$ourteam_content.addClass('owl-carousel');
										G5Plus.common.owlCarousel();
										$ourteam_content.imagesLoaded(function () {
											$newElems = $('.ourteam-item', $ourteam_content);
											G5Plus_OurTeam.setItemEffect($newElems, 'show');
											g5plus_ourteam.css('height','auto');
										});

										$this.button('reset');
										filterObject.parent().prev().children('option').button('reset');
										filterObject.parent().prev().removeAttr('disabled');
										checkFilter = true;
										filterObject.parent().children('a').css('cursor', 'pointer');
										filterObject.parent().children('a:not(.btn-light)').css('cursor', 'not-allowed');
									},
									error: function (html) {
										$this.button('reset');
										checkFilter = true;
									}
								});
							} else {
								var $ourteam_content = filterObject.parent().next('.ourteam-tab.owl-carousel');
								var $newElems = G5Plus_OurTeam.vars.ourteam_items[dataFilter + '-' + G5Plus_OurTeam.vars.filter_id];
								$ourteam_content.css('opacity', 0);
								$ourteam_content.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
								$ourteam_content.find('.owl-stage-outer').children().unwrap();
								$ourteam_content.html($newElems);

								G5Plus_OurTeam.setItemEffect($newElems, 'hide');
								$ourteam_content.css('opacity', 1);
								$ourteam_content.addClass('owl-carousel');
								G5Plus.common.owlCarousel();
								$ourteam_content.imagesLoaded(function () {
									$newElems = $('.ourteam-item', $ourteam_content);
									G5Plus_OurTeam.setItemEffect($newElems, 'show');
									g5plus_ourteam.css('height','auto');
								});
								filterObject.parent().prev().removeAttr('disabled');
								checkFilter = true;
								filterObject.parent().children('a').css('cursor', 'pointer');
								filterObject.parent().children('a:not(.btn-light)').css('cursor', 'not-allowed');
							}
						}
					}
				});
			});
		},
		filterRow: function () {
			var isRTL = $('body').hasClass('rtl');
			var ourteam_content = $('.ourteam-content');

			$(ourteam_content).each(function () {
				var $this = $(this);
				$this.imagesLoaded(function () {
					$this.isotope({
						itemSelector: '.ourteam-item',
						layoutMode: "fitRows",
						isOriginLeft: !isRTL,
						transitionDuration: '0.8s'
					});
				});
			});
			$('.ourteam-filter').each(function () {
				$(this).on('click', 'a', function () {
					var check = true;
					if (!$(this).hasClass('btn-light')) {
						check = false;
					}
					var $grid = $(this).parent().next('.ourteam-content');
					if (checkFilter && check) {
						$(this).parent().children('a').addClass('btn-light');
						$(this).removeClass('btn-light');
						$(this).parent().children('a').css('cursor', 'pointer');
						$(this).css('cursor', 'not-allowed');
						var filterValue = $(this).attr('data-filter');
						$grid.isotope({filter: filterValue});
						$(this).parent().prev().removeAttr('disabled');
						$(this).parent().prev().children('option').removeAttr('selected');
						$(this).parent().prev().children('option[value="' + filterValue + '"]').attr('selected', 'selected');
					}
				});
			});
			var archive_active = $('.filter-archive').data('active');
			if (typeof(archive_active) != 'undefined') {
				var archive_filter = $(".filter-archive a[data-filter='" + archive_active + "']");
				archive_filter.click();
			}
			checkFilter = true;
		},
		setItemEffect: function ($items, $effect) {
			if ($effect == 'hide') {
				$items.css('opacity', 0);
				$items.css('transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-webkit-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-moz-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-ms-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('-o-transition', 'opacity 1.5s linear, transform 1s');
				$items.css('transform', 'scale(0.2)');
				$items.css('-ms-transform', 'scale(0.2)');
				$items.css('-webkit-transform', 'scale(0.2)');
			}
			if ($effect == 'show') {
				for (var $i = 0; $i < $items.length; $i++) {
					(function ($index) {
						var $delay = 100+ 100 * $i;
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
				$('.ourteam-tab.owl-carousel').each(function () {
					var $container = $(this);
					setTimeout(function () {
						var $items = $('.ourteam-item', $container);
						G5Plus_OurTeam.setItemEffect($items, 'show');
					}, 500);
				});
			});
			$(window).on('orientationchange', function () {
				$('.ourteam-tab.owl-carousel').each(function () {
					var $container = $(this);
					setTimeout(function () {
						var $items = $('.ourteam-item', $container);
						G5Plus_OurTeam.setItemEffect($items, 'show');
					}, 500);
				})
			});
		},
		selectCategory: function () {
			var $elm = $('select.ourteam-filter-group');
			$elm.off();
			$($elm).on('change', function (event) {
				$(this).attr('disabled', 'disabled');
				event.preventDefault();
				var optionValue = $('option:selected', this).attr('value');
				var object = $(this).next().children('[data-filter="' + optionValue + '"]');
				object.click();
			});
		}
	};
	$(document).ready(function () {
		G5Plus_OurTeam.init();
	});
})(jQuery);