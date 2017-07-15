(function($) {
	"use strict";
	var G5Plus_Install_DemoData = {
		wrapper: [],
		demoItem: [],
		tryInstallCount: 0,
		initialize: function() {
			G5Plus_Install_DemoData.wrapper = $('.g5plus-demo-data-wrapper');
			this.demoClick();
		},
		demoClick: function () {
			$('.install-button', G5Plus_Install_DemoData.wrapper).on('click', function() {
				if (G5Plus_Install_DemoData.wrapper.hasClass('setting-up')) {
					return;
				}
				if (prompt('Type "install" to accept install demo data. \nNOTE: Will delete all post, page before install!', '') != 'install'){
					return;
				}
				if (!confirm('Are you sure install demo data?\nNOTE: Will delete all post, page before install!')) {
					return;
				}
				G5Plus_Install_DemoData.wrapper.addClass('setting-up');
				G5Plus_Install_DemoData.demoItem = $(this).closest('.g5plus-demo-site');
				if (G5Plus_Install_DemoData.demoItem.length > 0) {
					G5Plus_Install_DemoData.demoItem.addClass('in');
				}
				$(this).addClass('in');

				var demo_site = $(this).attr('data-demo');
				var demo_path = $(this).attr('data-path');

				window.onbeforeunload = function(e){
					if(!e) e = window.event;
					e.cancelBubble = true;
					e.returnValue = 'The install demo you made will be lost if you navigate away from this page.';

					if (e.stopPropagation) {
						e.stopPropagation();
						e.preventDefault();
					}
				};
				G5Plus_Install_DemoData.setProgressBar('init', 0 , 0);
				G5Plus_Install_DemoData.import('init', demo_site, demo_path, '');
			});
		},
		setProgressBar:function(type, count, amount) {
			var percent = 0;
			switch (type) {
				case 'init':
					percent = 0;
					break;
				case 'setting':
					percent = 5;
					break;
				case 'core':
					percent = 5 + (count * 1.0/amount * 80);
					break;
				case 'slider':
					percent = 85 + (count * 1.0/amount * 10);
					break;
				case 'update-id':
					percent = 95;
					break;
				case 'done':
					percent = 100;
					break;
				default:
					percent = 100;
			}
			$('.progress-bar > span', this.wrapper).css('width', percent + '%');
		},
		import: function(type, demo_site, demo_path, other_data) {
			var dataSubmit = {
				type: type,
				demo_site: demo_site,
				demo_path: demo_path,
				other_data: other_data,
				action: 'g5plus_install_demo',
				security: true
			};
			$.ajax({
				type: 'POST',
				data: dataSubmit,
				url: g5plus_install_demo_meta.ajax_url,
				success: function (data) {
					G5Plus_Install_DemoData.tryInstallCount = 0;
					try {
						data = $.parseJSON(data);
						switch (data.code) {
							case 'error':
							case 'fileNotFound':
								$('.install-message', G5Plus_Install_DemoData.wrapper).addClass('error');
								$('.install-message', G5Plus_Install_DemoData.wrapper).text(data.message);
								break;

							case 'setting':
							case 'core':
							case 'slider':
							case 'update-id':
								var countInstall = 0,
									amountInstall = 1;
								if ((typeof (data.message) != "undefined") && (typeof (data.message.count) != "undefined")) {
									countInstall = data.message.count;
								}
								if ((typeof (data.message) != "undefined") && (typeof (data.message.amount) != "undefined")) {
									amountInstall = data.message.amount;
								}
								G5Plus_Install_DemoData.setProgressBar(data.code, countInstall , amountInstall);

								G5Plus_Install_DemoData.import(data.code, demo_site, demo_path, data.message);
								break;

							case 'done':
								G5Plus_Install_DemoData.setProgressBar(data.code, 1, 1);

								$('.progress-bar', this.wrapper).addClass('nostripes');
								G5Plus_Install_DemoData.wrapper.addClass('done');
								$('.install-message', G5Plus_Install_DemoData.wrapper).addClass('updated');
								$('.install-message', G5Plus_Install_DemoData.wrapper).text($('.install-message', G5Plus_Install_DemoData.wrapper).attr('data-success'));
								$('.install-button > i', G5Plus_Install_DemoData.wrapper).attr('class','fa fa-check');
								window.onbeforeunload = null;
								break;
						}
					}
					catch (e) {
						if (G5Plus_Install_DemoData.tryInstallCount > 10) {
							$('.install-message', G5Plus_Install_DemoData.wrapper).addClass('error');
							$('.install-message', G5Plus_Install_DemoData.wrapper).text('Install demo data error!');
							window.onbeforeunload = null;
							return;
						}
						G5Plus_Install_DemoData.tryInstallCount += 1;
						G5Plus_Install_DemoData.import(type, demo_site, demo_path);
					}
				},
				error: function() {
					if (G5Plus_Install_DemoData.tryInstallCount > 10) {
						$('.install-message', G5Plus_Install_DemoData.wrapper).addClass('error');
						$('.install-message', G5Plus_Install_DemoData.wrapper).text('Install demo data error!');
						window.onbeforeunload = null;
						return;
					}
					G5Plus_Install_DemoData.tryInstallCount += 1;
					G5Plus_Install_DemoData.import(type, demo_site, demo_path);
				}
			});
		}
	};
	$(document).ready(function(){
		G5Plus_Install_DemoData.initialize();
	});
})(jQuery);