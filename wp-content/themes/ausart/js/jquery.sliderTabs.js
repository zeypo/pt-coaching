/*
 * jQuery SliderTabs v1.1
 * http://lopatin.github.com/sliderTabs
 *
 * Copyright 2012, Alex Lopatin
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 */


 (function( $ ){
	/*
	 * The sliderTabs tabs class
	 */
	$.sliderTabs = function(container, options){
		var plugin = this;

		var defaults = {
			autoplay: false,
			tabArrowWidth: 35,
			classes: {
				leftTabArrow: '',
				panel: '',
				panelActive: '',
				panelsContainer: '',
				rightTabArrow: '',
				tab: '',
				tabActive: '',	
				tabsList: ''
			},
			defaultTab: 1,
			height: null,
			indicators: false,
			mousewheel: true,
			position: "top",
			panelArrows: false,
			panelArrowsShowOnHover: false,
			tabs: true,
			tabHeight: 30,
			tabArrows: true,
			tabSlideLength: 100,
			tabSlideSpeed: 200,
			transition: 'slide',
			transitionEasing: 'easeOutCubic',
			transitionSpeed: 500,
			width: null
		};

		// jQuery objects of important elements
		var $container = $(container),
			$indicators,
			$tabsList,
			$contentDivs,
			$tabsListContainer,
			$tabsListWrapper,
			$contentDivsContainer,
			$leftTabArrow,
			$rightTabArrow,
			$leftPanelArrow,
			$rightPanelArrow;

		// Locks to stop out of sync behavior
		var selectLock = false,
			heightLock = true;
		
		var settings, minMargin;

		// Index of currently selected tab
		plugin.selectedTab = defaults.defaultTab;

		plugin.init = function(){
			settings = plugin.settings = $.extend({}, defaults, options);
			$container.addClass('ui-slider-tabs');

			/* 
			 * Rebuild structure of container
			 */
			$contentDivs = $container.children("div").addClass('ui-slider-tab-content').remove();
			
			// Tabs
			$tabsList = $container.children("ul").addClass('ui-slider-tabs-list').remove();
			$tabsList.children("li").remove().appendTo($tabsList);
			plugin.count = $tabsList.children('li').length;
			$tabsListWrapper = $("<div class='ui-slider-tabs-list-wrapper'>");
			$tabsListContainer = $("<div class='ui-slider-tabs-list-container'>").append($tabsList).appendTo($tabsListWrapper);
			$tabsListContainer.find('li').css('height', settings.tabHeight+2);
			$tabsListContainer.find('li a').css('height', settings.tabHeight+2);
			
			// Tab arrows
			$leftTabArrow = $("<a href='#' class='ui-slider-left-arrow'><div></div></a>").css({
				'width': settings.tabArrowWidth,
				'height': settings.tabHeight+2
			}).appendTo($tabsListContainer).click(function(e){
				plugin.slideTabs('right', settings.tabSlideLength);
				return false;
			});
			$rightTabArrow = $("<a href='#' class='ui-slider-right-arrow'><div></div></a>").css({
				'width': settings.tabArrowWidth,
				'height': settings.tabHeight+2
			}).appendTo($tabsListContainer).click(function(e){
				plugin.slideTabs('left', settings.tabSlideLength);
				return false;
			});

			// Content container
			$contentDivsContainer = $("<div class='ui-slider-tabs-content-container'>").append($contentDivs);

			// Position the tabs on top or bottom
			if(settings.position == 'bottom')
				$container.append($contentDivsContainer).append($tabsListWrapper.addClass('bottom'));
			else
				$container.append($tabsListWrapper).append($contentDivsContainer);
			

			if(settings.width)
				$container.width(parseInt(settings.width));
			if(settings.height)
				$contentDivsContainer.height(parseInt(settings.height)- settings.tabHeight);

			// Create and show indicators
			if(settings.indicators)
				plugin.showIndicators();
			

			// Select default tab
			plugin.selectTab(settings.defaultTab);
			plugin.slideTabs('left', 0);

			reorderPanels();

			resizePanels();

			// When tab is clicked
			$container.delegate('.ui-slider-tabs-list li a', 'click', function(){
				if(!$(this).parent().hasClass('selected') && !selectLock){
					plugin.selectTab($(this).parent());
				}
				return false;
			});

			// When indicator is clicked
			if($indicators)
				$indicators.delegate('.ui-slider-tabs-indicator', 'click', function(){
					if(!$(this).hasClass('selected') && !selectLock)
						plugin.selectTab($(this).index()+1);
				});

			// Set classes
			$.each(settings.classes, function(i, c){
				switch(i){
					case 'leftTabArrow': 
						$leftTabArrow.addClass(c);
						break;
					case 'rightTabArrow':
						$rightTabArrow.addClass(c);
						break;
					case 'panel':
						$contentDivs.addClass(c);
						break;
					case 'panelsContainer':
						$contentDivsContainer.addClass(c);
						break;
					case 'tab':
						$tabsList.find('li').addClass(c);
						break;
					case 'tabsList':
						$tabsList.addClass(c);
						break;
					default:
						break;
				}
			});

			// Panel arrows
			// Creates them if they don't exist
			if(settings.panelArrows)
				positionPanelArrows();

			if(settings.panelArrowsShowOnHover){
				if($leftPanelArrow)
					$leftPanelArrow.addClass('showOnHover');
				if($rightPanelArrow)
					$rightPanelArrow.addClass('showOnHover');
			}

			$contentDivsContainer.resize(positionPanelArrows);

			// Make responsive to changes in dimensions
			$tabsListWrapper.resize(function(){
				resizeTabsList();
				resizePanels();
			});
			
			// Resize content container height if inner panels change
			setInterval(function(){
				var $panel = $contentDivsContainer.children('.selected');
				if($panel.outerHeight() > $contentDivsContainer.outerHeight() && heightLock)
					resizeContentContainer($panel);
			}, 100);

			resizeTabsList();

			// Hide tabs wrapper if option if false
			if(!settings.tabs)
				$tabsListWrapper.hide();

			// Auto play
			if(settings.autoplay)
				setInterval(plugin.next, settings.autoplay);

			// Panel arrows

			// Mousehweel
			$container.bind('mousewheel', function(event, delta, deltaX, deltaY) {
			    if(delta > 0)
			    	plugin.prev();
			   	else if(delta < 0)
			   		plugin.next();
			   	return false;
			});
		}

		/*
		 * Public methods
		 */

		// Select tab
		// param: tab is a tab index (1 ... n) or jQuery object of tab li element
		plugin.selectTab = function(tab){
			heightLock = false;

			// Find $targetPanel, the panel to show
			var $clicked = (typeof tab === 'number') ? $tabsList.children("li:nth-child("+tab+")") : tab;
			var targetId = ($clicked.find('a').attr('href')).substr(1);
			var $targetPanel = $contentDivsContainer.children("#"+targetId);

			// Update selected tab
			plugin.selectedTab = (typeof tab === 'number') ? tab : tab.index()+1;

			// Resize the main contant container to the size of $targetPanel
			resizeContentContainer($targetPanel);

			// Lock selections until transitions finished
			selectLock = true;

			// Direction to slide panel on hide
			var direction = ($tabsList.find('.selected').index() < $clicked.index()) ? 'left' : 'right';
			
			// Update selected classes
			$clicked.siblings().removeClass('selected');
			if(settings.classes.tabActive != '') $clicked.siblings().removeClass(settings.classes.tabActive);
			$clicked.addClass('selected').addClass(settings.classes.tabActive);
			
			// Hide and show appropriate panels
			hidePanel($contentDivsContainer.children(".ui-slider-tab-content:visible"), direction);
			showPanel($targetPanel);

			// Slide tabs so that they fit in $tabsListContainer
			fitTabInContainer($clicked);

			// Select the proper indicator
			selectIndicator();
		};

		// Select the next (right) panel
		plugin.next = function(){
			if(!selectLock){
				if(plugin.count === plugin.selectedTab)
					plugin.selectTab(1);
				else plugin.selectTab(plugin.selectedTab+1);
			}	
		};

		// Select the previous panel
		plugin.prev = function(){
			if(!selectLock){
				if(plugin.selectedTab === 1)
					plugin.selectTab(plugin.count);
				else plugin.selectTab(plugin.selectedTab-1);
			}
		};

		// Slide tabs left/right within $tabsListContainer
		plugin.slideTabs = function(direction, length){
			var margin = parseInt($tabsList.css('margin-top'));
			var newMargin = margin;

			// Reset 'edge' classes on tab arrows
			$leftTabArrow.removeClass('edge');
			$rightTabArrow.removeClass('edge');

			// Calculate delta to slide by
			if(direction=='right') newMargin += length;
			else if(direction=='left') newMargin -= length;
			
			if(newMargin >= 0) {
				newMargin = 0;
				$leftTabArrow.addClass('edge');
			}

			else if(newMargin <= minMargin){
				newMargin = minMargin;
				$rightTabArrow.addClass('edge');
			}

			// Animate
			$tabsList.animate({'margin-top': newMargin}, settings.tabSlideSpeed);
		};

		// Show panel indicators
		// Create indicators if they don't exist yet
		plugin.showIndicators = function(){
			if(!$indicators){
				$indicators = $("<div class='ui-slider-tabs-indicator-container'>");
				for(var i = 0; i < $contentDivs.length; i++){
					$indicators.append("<div class='ui-slider-tabs-indicator'></div>");
				}
				$contentDivsContainer.append($indicators);
			}
			else
				$indicators.show();
		};

		// Hide panel indicators
		plugin.hideIndicators = function(){
			if($indicators)
				$indicators.hide();
		};

		// Show arrows that slide tabs left and right
		plugin.showTabArrows = function(){
			if(!settings.tabArrows)
				return;
			$leftTabArrow.show();
			$rightTabArrow.show();
			$tabsListContainer.css('margin', '0 '+settings.tabArrowWidth+'px');
		};

		// Hide arrows that slide tabs left and right
		plugin.hideTabArrows = function(){
			$leftTabArrow.hide();
			$rightTabArrow.hide();
			$tabsListContainer.css('margin', '0');
		};

		// Show panel arrows
		plugin.showPanelArrows = function(){
			if($leftPanelArrow) $leftPanelArrow.show();
			if($rightPanelArrow) $rightPanelArrow.show();
		};

		// Hide panel arrows
		plugin.hidePanelArrows = function(){
			if($leftPanelArrow) $leftPanelArrow.hide();
			if($rightPanelArrow) $rightPanelArrow.hide();
		};

		/*
		 * Private methods
		 */

		// Add the selected class to the plugin.selectedTab tab. Remove from all others.
		var selectIndicator = function(){
			if(settings.indicators && $indicators){
				var $indicator = $indicators.children("div:nth-child("+plugin.selectedTab+")");
				$indicator.siblings().removeClass('selected');
				$indicator.addClass('selected');
			}	
		};

		// 	Slide tabs inside of $tabsListContainer so that the selected one fits inside
		var fitTabInContainer = function(tab){
			var tabOffset = tab.offset(),
				containerOffset = $tabsListContainer.offset(),
				leftOffset = tabOffset.top - containerOffset.top,
				rightOffset = (containerOffset.bottom + $tabsListContainer.outerWidth()) - (tabOffset.bottom + tab.outerWidth() );
			
			if(leftOffset < 0)
				plugin.slideTabs('right', -leftOffset);
			else if(rightOffset < 0)
				plugin.slideTabs('left', -rightOffset);
		};

		// Reposition content panels so that they are ready to be transitioned in and out.
		// This depends on whether the transition is set to slide or fade
		var reorderPanels = function(){
			// Position content divs
			if(settings.transition == 'slide')
				// Move panels left/right basedon their index relative to the selected panel
				$tabsList.children('li').each(function(index, el){
					var selectedIndex = $tabsList.children('.selected').index(),
						thisIndex = $(el).index();
					var panel = $contentDivsContainer.children('#'+$(el).find('a').attr('href').substr(1));
					if(selectedIndex < thisIndex)
						panel.css({left: $contentDivsContainer.width()+'px'});
					else if(selectedIndex > thisIndex)
						panel.css({left: '-'+$contentDivsContainer.width()+'px'});
					else
						panel.addClass(settings.classes.panelActive);
				});
			
			if(settings.transition == 'fade')
				// Set opacity to correct value for non selected panels.
				$tabsList.children('li').each(function(index, el){
					var selectedIndex = $tabsList.children('.selected').index(),
						thisIndex = $(el).index();
					var panel = $contentDivsContainer.children('#'+$(el).find('a').attr('href').substr(1));
					if(selectedIndex != thisIndex)
						panel.css({opacity: 0});
					else
						panel.addClass(settings.classes.panelActive);
				});
		};
		
		// Object determining css properties to be animated to based on various actions, transitions, and directions
		var panelAnimationCSS = function(width){
			return {
					hide: {
						slideleft: {
							left: '-'+width+'px'
						},
						slideright: {
							left: width+'px'
						},
						fade: {
							opacity: 0
						}
					},
					show: {
						slide: {
							left: 0
						},
						fade: {
							opacity: 1
						}
					}
				}
		};
		
		// Transition out the passed in panel.
		// param: 	panel is the jQuery object of the panel to be hidden
		//			direction is either 'left' or 'right' for sliding transitions
		var hidePanel = function(panel, direction){
			// Calculate correct key in panelAnimationCSS
			if(settings.transition == 'slide')
				var trans = 'slide'+direction;
			else var trans = settings.transition;

			// Animate the panel out
			panel.animate(panelAnimationCSS($contentDivsContainer.width())['hide'][trans], settings.transitionSpeed, settings.transitionEasing, function(){
				panel.hide();
				panel.removeClass('selected');
				//if(settings.classes.panelActive != '') panel.removeClass(settings.classes.panelActive);
				selectLock = false;
				reorderPanels();
			});
		};

		// Transition in the parameter panel
		// param: 	panel is the jQuery object of the panel to be shown
		var showPanel = function(panel){
			// Show first
			panel.show();
			panel.addClass(settings.classes.panelActive).addClass('selected');

			// Then animate css properties
			panel.animate(panelAnimationCSS($contentDivsContainer.width())['show'][settings.transition], settings.transitionSpeed, settings.transitionEasing, function(){
				selectLock = false;
				heightLock = true;
				reorderPanels();
			});
		};

		// Animate the height of the content container to height target
		// params:  target (int) is the new height
		var resizeContentContainer = function(target){
			if(!settings.height)
				$contentDivsContainer.animate({
					height: actualHeight(target)
				}, 200);
		};

		// Position the panel arrows
		var positionPanelArrows = function(){
			if(settings.panelArrows){
				// Initialize them if you need to
				if(!$leftPanelArrow && !$rightPanelArrow){
					$leftPanelArrow = $("<div class='ui-slider-tabs-leftPanelArrow'>").click(function(){
						plugin.prev();
					});
					$rightPanelArrow = $("<div class='ui-slider-tabs-rightPanelArrow'>").click(function(){
						plugin.next();
					});

					$leftPanelArrow.appendTo($contentDivsContainer);
					$rightPanelArrow.appendTo($contentDivsContainer);
				}

				// Set correct CSS 'top' attribute of each panel arrow
				$rightPanelArrow.css({
					"top": $contentDivsContainer.height()/2 - $rightPanelArrow.outerHeight()/2
				});
				$leftPanelArrow.css({
					"top": $contentDivsContainer.height()/2 - $leftPanelArrow.outerHeight()/2
				});
			}
		};

		// Change the width of $tabsList to the sum of the outer widths of all tabs
		var resizeTabsList = function(){
			// Calculate total width
			var height = 0;
			$tabsList.children().each(function(index, element){
				height += $(element).outerHeight(true);
			});
			
			// Set new width of $tabsList
			$tabsList.height(height);

			// Update minMargin. Hide tab arrows if no overflow
			if($tabsListContainer.height() < height && settings.tabArrows){
				plugin.showTabArrows();
				minMargin = $tabsListContainer.height() - height;
			}
			else plugin.hideTabArrows();
		}

		// Resize indiviual panels to the width of the new container
		var resizePanels = function(){
			$contentDivs.width($contentDivsContainer.width() - ($contentDivs.outerWidth() - $contentDivs.width()));
		};

		// Get height of a hidden element
		var actualHeight = function(element){
			var prevCSS = {
				'display': element.css('display'),
				'left': element.css('left'),
				'position': element.css('position')
			};
			element.css({
				'display': 'normal',
				'left': -5000,
				'position': 'absolute'
			});
			var height = element.outerHeight();
			element.css(prevCSS);
			return height;
		};
		

		// Initialize the plugin
		plugin.init();
	};

	/*
	 * Handle input. Call public functions and initializers
	 */
	$.fn.sliderTabs = function( data ) {
		return this.each(function(){
			var _this = $(this),
				plugin = _this.data('sliderTabs');

			// Method calling logic
		    if (!plugin) {
		    	// If no plugin, initialize it
				plugin = new $.sliderTabs(this, data);
				_this.data('sliderTabs', plugin);
				return plugin;
			}
			if (plugin.methods[data]){
				// If plugin exists, call a public method
				return plugin.methods[ data ].apply( this, Array.prototype.slice.call( arguments, 1 ));
			}
		});
  	};
})( jQuery );






/*
 * The following is the jQuery Mousewheel plugin. Full credit goes to 
 * Brandon Aaron. (https://github.com/brandonaaron/jquery-mousewheel)
 * /


/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */

(function($) {

var types = ['DOMMouseScroll', 'mousewheel'];

if ($.event.fixHooks) {
    for ( var i=types.length; i; ) {
        $.event.fixHooks[ types[--i] ] = $.event.mouseHooks;
    }
}

$.event.special.mousewheel = {
    setup: function() {
        if ( this.addEventListener ) {
            for ( var i=types.length; i; ) {
                this.addEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = handler;
        }
    },
    
    teardown: function() {
        if ( this.removeEventListener ) {
            for ( var i=types.length; i; ) {
                this.removeEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = null;
        }
    }
};

$.fn.extend({
    mousewheel: function(fn) {
        return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
    },
    
    unmousewheel: function(fn) {
        return this.unbind("mousewheel", fn);
    }
});


function handler(event) {
    var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
    event = $.event.fix(orgEvent);
    event.type = "mousewheel";
    
    // Old school scrollwheel delta
    if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
    if ( orgEvent.detail     ) { delta = -orgEvent.detail/3; }
    
    // New school multidimensional scroll (touchpads) deltas
    deltaY = delta;
    
    // Gecko
    if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
        deltaY = 0;
        deltaX = -1*delta;
    }
    
    // Webkit
    if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
    if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
    
    // Add event and delta to the front of the arguments
    args.unshift(event, delta, deltaX, deltaY);
    
    return ($.event.dispatch || $.event.handle).apply(this, args);
}

})(jQuery);



/*
 * The following is the jQuery Resize plugin. Full credit goes to 
 * "Cowboy" Ben Alman. (https://github.com/cowboy/jquery-resize)
 * /

/*
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,h,c){var a=$([]),e=$.resize=$.extend($.resize,{}),i,k="setTimeout",j="resize",d=j+"-special-event",b="delay",f="throttleWindow";e[b]=250;e[f]=true;$.event.special[j]={setup:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.add(l);$.data(this,d,{w:l.width(),h:l.height()});if(a.length===1){g()}},teardown:function(){if(!e[f]&&this[k]){return false}var l=$(this);a=a.not(l);l.removeData(d);if(!a.length){clearTimeout(i)}},add:function(l){if(!e[f]&&this[k]){return false}var n;function m(s,o,p){var q=$(this),r=$.data(this,d);r.w=o!==c?o:q.width();r.h=p!==c?p:q.height();n.apply(this,arguments)}if($.isFunction(l)){n=l;return m}else{n=l.handler;l.handler=m}}};function g(){i=h[k](function(){a.each(function(){var n=$(this),m=n.width(),l=n.height(),o=$.data(this,d);if(m!==o.w||l!==o.h){n.trigger(j,[o.w=m,o.h=l])}});g()},e[b])}})(jQuery,this);