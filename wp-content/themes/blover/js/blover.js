
(function($){
     'use strict';

$(document).ready(function($) {

$('a').on( 'click', function(){
  $(this).blur();
});

   var $bloverSecondary = $('#secondary');

  if(typeof $.fn.theiaStickySidebar === 'function'){
      $bloverSecondary.theiaStickySidebar({
        additionalMarginTop: 126 //Number(bloverCustomScript.fatNavbarHeight)
      });
  }

if (typeof $.fn.slick === 'function'){

var $bloverFeaturedSliderImage = $('.blover-featured-slider-wrapper');

$bloverFeaturedSliderImage.show();
// // Slick slider
$('.blover-featured-slider').slick({
  infinite: true,
  autoplay: Boolean(blover.home_page_slider_autoplay),
  autoplaySpeed: Number(blover.home_page_slider_play_speed),
  speed: 1000,
  slidesToShow: 1,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
        //variableWidth: false
      }
    }
  ]
});
}

// Top search panelchange image url to placeholder url in xml
var $bloverSearchPanel = $('.blover-search-panel');
var $bloverSearchToggle = $('.search-toggle');

    $bloverSearchToggle.on( 'click', function(){
        $bloverSearchPanel.slideToggle(250).css('z-index', '1001');
	$(this).attr('aria-expanded', 'true');
        });
    $('.blover-search-panel-close').on( 'click', function(){
        $bloverSearchPanel.slideToggle(250).css('z-index', '');
	$bloverSearchToggle.attr('aria-expanded', 'false');
        });


//Sticky menu
var $bloverSiteNavigation = $('#top-navigation');
var $bloverWpAdminBar = $('#wpadminbar');
var lastScrollTop = 0; //, delta = 5;
    $(window).scroll(function(){
      
      var $bloverAdminBarHeight = $bloverWpAdminBar.height();
      var $bloverAdminBarPosistionValue = $bloverWpAdminBar.css('position');
      var st = $(this).scrollTop();
      if($bloverAdminBarHeight > 0 ){
	if($bloverAdminBarPosistionValue === 'fixed') {
	    if ( st > $bloverAdminBarHeight ) {
	      $bloverSiteNavigation.css( 'top', $bloverAdminBarHeight + 'px' );

	     if (st > $bloverAdminBarHeight + 70) {
		 $bloverSiteNavigation.css( 'top', $bloverAdminBarHeight + 'px' );
	      if (st > lastScrollTop){
		  $bloverSiteNavigation.slideUp(100);
	      } else {
		  $bloverSiteNavigation.slideDown(200);
	      }
	     } else {
		 $bloverSiteNavigation.slideDown(200);
	     }
	   } else {
	     $bloverSiteNavigation.css( 'top', $bloverAdminBarHeight + 'px' );
	   }
	}
      } else {
	  $bloverSiteNavigation.css( 'top', '0' );
	 if (st > 70) {

	  if (st > lastScrollTop){
	      $bloverSiteNavigation.slideUp(100);
	  } else {
	      $bloverSiteNavigation.slideDown(200);
	  }
	 } else {
	     $bloverSiteNavigation.slideDown(200);
	 }
      }
     lastScrollTop = st;
    });

	var button, closeButton, menu, bgmenu;

	button = $( '#left-navbar-toggle' );
        bgmenu = $('.left-sidebar-bg');
        menu = $('#left-sidebar');
        closeButton = $('.left-sidebar-close');
        button.on( 'click', function() {
                            bloverMenuToggle();
                        });

        closeButton.on( 'click', function() {
                            bloverMenuToggle();
                        });

        bgmenu.on( 'click', function() {
                            bloverMenuToggle();
                        });

        var bloverMenuToggle = function(){

	    if(menu.is(':visible')) {

		button.attr('aria-expanded', 'false');
	    } else {

		button.attr('aria-expanded', 'true');
	    }
            menu.toggle('slide', {direction: 'left' } , 150);
            bgmenu.fadeToggle(500);

        };

    var $bloverMenuPlusLeft = $('#site-navigation .expand-submenu');

    $bloverMenuPlusLeft.on( 'click', function(){

	if( $(this).hasClass('submenu-expanded')) {
            $(this).css({'transform': 'none'}).removeClass('submenu-expanded').prop('title', blover.expandText);
	    $(this).parent().children('ul').hide();
        } else {
            $(this).css({'transform': 'rotate(45deg)'}).addClass('submenu-expanded').prop('title', blover.closeText);
	    $(this).parent().children('ul').show();
        }

    });

    var $bloverDate = new Date();
    var $bloverDay = $bloverDate.getDate();
    var $bloverFullYear = $bloverDate.getFullYear();
    var $bloverDayOfWeek = blover.days[$bloverDate.getDay()];
    var $bloverMonth = blover.months[$bloverDate.getMonth()];

    var $bloverFullDate = $bloverDayOfWeek + ', ' + $bloverMonth + ' ' + $bloverDay + ', ' + $bloverFullYear;

    $('#today-date').append($bloverFullDate);

  $('.posts-navigation').hide();

  var $bloverContainer = $('.masonry-container');

  if (typeof Masonry === 'function'){

    if ( $('body').hasClass('woocommerce') && $('ul').hasClass('products') ) {
      var $bloverWooProductsContainer = $('ul.products');
      imagesLoaded( document.querySelector('ul.products'), function() {
        $(function(){
            $bloverWooProductsContainer.masonry({
              itemSelector: 'li.product'
            });
        });
      });
    } else {
      imagesLoaded( document.querySelector('.masonry-container'), function() {
        $(function(){
            $bloverContainer.masonry({
              itemSelector: '.masonry'
            });
        });
      });
    }
  }
if ( blover.pagination === 'infinite' ) {
  if (typeof $.infinitescroll === 'function'){

    $bloverContainer.infinitescroll({

        navSelector  : '.posts-navigation', // selector for the paged navigation (it will be hidden)
        nextSelector : '.nav-previous > a', // selector for the NEXT link (to page 2)
        itemSelector : '.masonry', // selector for all items you'll retrieve
        loading: {
                finished: undefined,
                finishedMsg: '',
                img: blover.getTemplateDirectoryUri + '/slick/ajax-loader.gif',
                msg: null,
                msgText: blover.loadingText,
                selector: null,
                speed: 'fast',
                start: undefined
            }

        }, function( newElements ) {
            // hide new items while they are loading
            var $newElems = $( newElements ).css({ opacity: 0 });
            // ensure that images load before adding to masonry layout
            $newElems.imagesLoaded(function(){
              // show elems now they're ready
              $newElems.animate({ opacity: 1 });
              $bloverContainer.masonry( 'appended', $newElems, true );
            });
        }
    );
  }
}

if( blover.pagination === 'ajax' ) {
       // The number of the next page to load (/page/x/).
	var pageNum = parseInt(blover.startPage, 10) + 1;

	// The maximum number of pages the current query can return.
	var max = parseInt(blover.maxPages, 10);

	// The link of the next page of posts.
	var nextLink = blover.nextLink;

/**
 * Replace the traditional navigation with our own,
 * but only if there is at least one page of new posts to load.
 */
    if(pageNum <= max) {
	// Insert the "More Posts" link.
	$('#primary:not(.woocommerce)').append('<p id="blover-load-more"><a class="btn btn-secondary" href="#">' + blover.loadMoreText + '</a></p>');

	// Remove the traditional navigation.
	$('.navigation').remove();
    }
 /*
 * Load new posts when the link is clicked.
 */
var $bloverLoadMore = $('#blover-load-more a');

$bloverLoadMore.on( 'click', function() {

        // Are there more posts to load?
	if(pageNum <= max) {

                $(this).css('opacity', '0').css('transition', '0');

                $.ajax({
                    url: nextLink,
                    cache: false,
                    dataType: 'html',
                    success: function(response) {

                var result = $(response).find('.masonry');

		if (typeof Masonry === 'function'){

                    result = $( result ).css({ opacity: 0 });

                    $bloverContainer.append( result ).imagesLoaded(function(){
                        result.animate({ opacity: 1 });
                        $bloverContainer.masonry( 'appended', result, true );
                            if(typeof $.fn.theiaStickySidebar === 'function'){
                                $bloverSecondary.theiaStickySidebar({
                                  additionalMarginTop: 105
                                });
                            }
                        pageNum++;
                        nextLink = nextLink.replace(/\/page\/[0-9]*/, '/page/'+ pageNum).replace(/paged=[0-9]*/, 'paged='+ pageNum);
                            if(pageNum <= max) {
                                    $bloverLoadMore.css('opacity', '1').text( blover.loadMoreText );
                            } else {
                                    $bloverLoadMore.css('opacity', '1').text( blover.noMorePostsText );
                            }
                    });
                }


        }
        });
        } else {
			$bloverLoadMore.append('');
		}
                return false;

});
}

$bloverContainer.on( 'click', '.blover-jp-sharing-toggle', function(){
  $(this).siblings('.comments-link').toggle();
  $(this).toggle().siblings('.blover-jp-sharing').toggle('slide', {direction: 'right' } , 400, 'linear').siblings('.blover-jp-sharing-close').toggle();
  $(this).siblings('.blover-jp-sharing-close').toggle();
});

$bloverContainer.on( 'click', '.blover-jp-sharing-close', function(){
  $(this).toggle().siblings('.blover-jp-sharing').toggle('slide', {direction: 'right' } , 400, 'linear');
  $(this).siblings('.blover-jp-sharing-toggle').toggle();
  $(this).siblings('.comments-link').fadeToggle(1000);
});

});
})(jQuery);
