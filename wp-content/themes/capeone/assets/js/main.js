jQuery(document).ready(function($) {

    $(".site-nav-toggle").click(function() {
        $(".capeone-main-nav").toggle();
    });
	
	$(".capeone-menu-toggle").click(function() {
        $(".capeone-mobile-drawer-header").toggle();
    });
	
	$(".capeone-wp-menu li").mouseenter(function(){
  		$(this).addClass("menu-item-hovered");
		$(this).find(".capeone-mega-menu-wrap").show();
	});
	$(".capeone-wp-menu li").mouseleave(function(){
  		$(this).removeClass("menu-item-hovered");
		$(this).find(".capeone-mega-menu-wrap").hide();
	});
	

    var stickyTop = function() {

        var stickyTop;
        if ($("body.admin-bar").length) {

            if ($(window).width() < 765) {
                stickyTop = 46;
            } else {
                stickyTop = 32;
            }
        } else {
            stickyTop = 0;
        }
		
        return stickyTop;
    }

    $('.page_item_has_children').addClass('menu-item-has-children');
	
	var page_min_height = $(window).height() - $('.site-footer').outerHeight()- stickyTop();
	
	if($('.header-wrap').length)
		page_min_height = page_min_height - $('.header-wrap').outerHeight();
		
	if($('.page-title-bar').length)
		page_min_height = page_min_height - $('.page-title-bar').outerHeight();
		
	$('.page-wrap').css({'min-height':page_min_height});
	
	function onScroll(event){
    var scrollPos = $(document).scrollTop()+$(".capeone-header").height();
	
	$('.capeone-nav-main a[href^="#"]').each(function () {
        var currLink = $(this);
		var refElement = $(currLink.attr("href"));
		if(refElement.length){
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.capeone-nav-main li').removeClass("active");
            currLink.parent('li').addClass("active");
        }else{
            currLink.parent('li').removeClass("active");
        }
		}
    });
	
	$('.capeone-nav-left a[href^="#"]').each(function () {
        var currLink = $(this);
		var refElement = $(currLink.attr("href"));
		if(refElement.length){
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.capeone-nav-left li').removeClass("active");
            currLink.parent('li').addClass("active");
        }else{
            currLink.parent('li').removeClass("active");
        }
		}
    });
	}

    function capeoneFxdHeader() {
        var stickyHeight = stickyTop();

        var headerPosition = $(document).scrollTop();
		
		if( headerPosition > 200 )
			$('.back-to-top').fadeIn();
		else
			$('.back-to-top').fadeOut();

        var headerHeight = $(".capeone-header").height();
		
		if ($(".header-image").length) {
			headerHeight += $(".header-image").outerHeight()-69;
		}
		
        if (headerPosition < headerHeight) $(".capeone-fixed-header-wrap").hide();
        else $(".capeone-fixed-header-wrap").show().css({ 'top': stickyHeight });
    }
	
    $(window).scroll(function() {
        capeoneFxdHeader();
		onScroll();
    })
	
    /* smooth scroll*/
/*    $(document).on('click', "a.scroll,.site-nav a[href^='#'],.capeone-main-nav a[href^='#']", function(e) {

        var selectorHeight = 0;
        if (!$('.capeone-fixed-header-wrap').length)
            selectorHeight = $('.capeone-main-header').outerHeight();
        else
            selectorHeight = $('.capeone-fixed-header-wrap').outerHeight();

        e.preventDefault();
        var id = $(this).attr('href');

        if (typeof $(id).offset() !== 'undefined') {
            var goTo = $(id).offset().top - selectorHeight - stickyTop() + 1;
            $("html, body").animate({ scrollTop: goTo }, 300);
        }
    });*/

    $('.comment-form #submit').addClass('btn-normal');
    $('.comment-reply-link').addClass('pull-right btn-reply');

    $('#back-to-top, .back-to-top').click(function() {
        $('html, body').animate({ scrollTop: 0 }, '800');
        return false;
    });

    if ($(window).width() < 920) {
        $('li.menu-item-has-children').prepend('<div class="menu-expand"></div>');
    } else {
        $('#top-menu .menu-expand').remove();
    }

    $(window).resize(function() {

        if ($(window).width() < 920) {
            $('li.menu-item-has-children').prepend('<div class="menu-expand"></div>');
        } else {
            $('#top-menu .menu-expand').remove();
        }
		
		if ($(window).width() > 768) {
			$('.capeone-mobile-drawer-header').hide();
			}
		

    });

    $(document).on('click', '#top-menu .menu-expand', function(e) {
		e.preventDefault();		
        $(this).parent('.menu-item').find('>ul').slideToggle();
    });

	
	/*search icon*/
	$(document).on('click', '.capeone-header .capeone-search .capeone-search-label',function(){
			$(this).parent('.capeone-search').find('.capeone-search-wrap').toggle();
	});
		

	if(capeone_params.page_preloader === '1' ){
		if(capeone_params.preloader_image!=='')
			$.LoadingOverlaySetup({background : capeone_params.preloader_background,image : capeone_params.preloader_image});
		else
			$.LoadingOverlaySetup({background : capeone_params.preloader_background});
			
		$.LoadingOverlay("show");
		$(window).load(function() {
			$.LoadingOverlay("hide");
		});
	}


    $('button.single_add_to_cart_button').prepend('<i class="fa fa-shopping-cart"></i> ');
    $('body.admin-bar').addClass('capeone-adminbar');

});
jQuery( function( $ ) {
	// Add space for Elementor Menu Anchor link
	var selectorHeight = $('.capeone-fixed-header-wrap').height(); 		
	selectorHeight = selectorHeight - 1;
	
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addFilter( 'frontend/handlers/menu_anchor/scroll_top_distance', function( scrollTop ) {
			return scrollTop - selectorHeight ;
		} );
	} );
} );