/*
 * jQuery liquid carousel v1.0
 * http://www.nikolakis.net
 *
 * Copyright 2010, John Nikolakis
 * Free to use under the GPL license.
 * http://www.gnu.org/licenses/gpl.html
 *
 */

(function($){
	$.fn.liquidcarousel = function(options) {

	var defaults = {
		duration: 100,
		hidearrows: true
	};
	var options = $.extend(defaults, options);

    return this.each(function() {
			var divobj = $(this);

			$(divobj).css('overflow', 'hidden');

			$('> .wrapper', divobj).css('overflow', 'hidden');
			$('> .wrapper', divobj).css('float', 'left');

			$('> .wrapper > ul', divobj).css('float', 'left');
			$('> .wrapper > ul', divobj).css('margin', '0');
			$('> .wrapper > ul', divobj).css('padding', '0');
			$('> .wrapper > ul', divobj).css('display', 'block');

			$('> .wrapper > ul > li', divobj).css('display', 'block');
			$('> .wrapper > ul > li', divobj).css('float', 'left');

			var visiblelis = 0;
			var totallis = $('> .wrapper > ul > li', this).length;
			var currentposition = 0;
			var additionalmargin = 0;
			var totalwidth = 0;

			$(window).resize(function(e){
				var divwidth = $(divobj).width();
				var availablewidth = divwidth;
				
				var heighest = 0;
				$('> .wrapper > ul > li', divobj).css("height", "auto");
				$('> .wrapper > ul > li', divobj).each(function () {
					if ( $(this).outerHeight() > heighest ) {
						heighest = $(this).outerHeight();
					}
				});
							  
				$(divobj).height(heighest);
				$('> .wrapper', divobj).height(heighest);
				$('> .wrapper > ul', divobj).height(heighest);
				$('> .wrapper > ul > li', divobj).height(heighest);
				
				var liwidth = $('> .wrapper > ul > li:first', divobj).outerWidth(true);
				var originalmarginright = parseInt($('> .wrapper > ul > li', divobj).css('marginRight'));
				var originalmarginleft = parseInt($('> .wrapper > ul > li', divobj).css('marginLeft'));
				totalwidth = liwidth + additionalmargin;

				previousvisiblelis = visiblelis;
				visiblelis = Math.floor((availablewidth / liwidth));

				if (visiblelis < totallis) {
					additionalmargin = Math.floor((availablewidth - (visiblelis * liwidth))/visiblelis);
				} else {
					additionalmargin = Math.floor((availablewidth - (totallis * liwidth))/totallis);
				}
				halfadditionalmargin = Math.floor(additionalmargin/2);
				totalwidth = liwidth + additionalmargin;

				if (visiblelis > previousvisiblelis  || totallis <= visiblelis) {
					currentposition -= (visiblelis-previousvisiblelis);
					if (currentposition < 0 || totallis <= visiblelis ) {
						currentposition = 0;
					}
				}
				$('> .wrapper > ul', divobj).css('marginLeft', -(currentposition * totalwidth));

				if (visiblelis >= totallis || ((divwidth >= (totallis * liwidth)) && options.hidearrows) ) {
					if (options.hidearrows) {
						$('> .prev', $(divobj).parents(".widget")).hide();
						$('> .next', $(divobj).parents(".widget")).hide();

						additionalmargin = Math.floor((divwidth - (totallis * liwidth))/totallis);
						halfadditionalmargin = Math.floor(additionalmargin/2);
						totalwidth = liwidth + additionalmargin;
						$('> .wrapper > ul > li', divobj).css('marginRight', originalmarginright + halfadditionalmargin);
						$('> .wrapper > ul > li', divobj).css('marginLeft', originalmarginleft + halfadditionalmargin);
					}
					$('> .wrapper', divobj).width(totallis * totalwidth);
					$('> ul', divobj).width(totallis * totalwidth);
					$('> .wrapper', divobj).css('marginLeft', 0);
					currentposition = 0;
				} else {
					$('.prev', $(divobj).parents(".widget")).show();
					$('.next', $(divobj).parents(".widget")).show();
					$('> .wrapper', divobj).width(visiblelis * totalwidth);
					$('> ul', divobj).width(visiblelis * totalwidth);
				}
			});

			$('.next', $(divobj).parents(".widget")).click(function(){

				if (totallis <= visiblelis) {
					currentposition = 0;
				} else if ((currentposition + (visiblelis*2)) < totallis) {
					currentposition += visiblelis;
				} else if ((currentposition + (visiblelis*2)) >= totallis -1) {
					currentposition = totallis - visiblelis;
				}
				$('> .wrapper > ul', divobj).stop();
				$('> .wrapper > ul', divobj).animate({'marginLeft': -(currentposition * totalwidth)}, options.duration);
			});

			$('.prev', $(divobj).parents(".widget")).click(function(){
				if ((currentposition - visiblelis) > 0) {
					currentposition -= visiblelis;
				} else if ((currentposition - (visiblelis*2)) <= 0) {
					currentposition = 0;
				}
				$('> .wrapper > ul', divobj).stop();
				$('> .wrapper > ul', divobj).animate({'marginLeft': -(currentposition * totalwidth)}, options.duration);
			});

			$('.next', $(divobj).parents(".widget")).dblclick(function(e){
				e.preventDefault();
				clearSelection();
			});

			$('.prev', $(divobj).parents(".widget")).dblclick(function(e){
				e.preventDefault();
				clearSelection();
			});

			function clearSelection() {
				if (document.selection && document.selection.empty) {
					document.selection.empty();
				} else if (window.getSelection) {
					var sel = window.getSelection();
					sel.removeAllRanges();
				}
			}

			$(window).resize();
    });


 };
})(jQuery);
