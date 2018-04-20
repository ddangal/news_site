(function($){
	"use strict";

	/**
	 * Page Preloader
	 */

	$('#main-menu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -20
    });

	/**
	 * Page Preloader
	 */
    $('.single-item').slick({
    	dots: false,
    	autoplay: true,
  		autoplaySpeed: 4000,
    	responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '0',
		        slidesToShow: 1
		      }
		    }
		  ]
    });

    $('.multiple-items').slick({
	  infinite: true,
	  autoplay: true,
	  arrows: true,
	  slidesToShow: parseInt( news_unlimited_object.slider_style ),
	  slidesToScroll: 1,
	  responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '0',
		        slidesToShow: 1
		      }
		    }
		  ]
	});

    $('.single-item-rtl').slick({
  		rtl: true,
  		autoplay: true,
  		autoplaySpeed: 3000,

  		responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 767,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    }
		  ]
	});

	$('.shadow').slick({
	  dots: false,
	  infinite: true,
	  speed: 500,
	  fade: true,
	  cssEase: 'linear',

	  responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    }
		  ]
	});

	 $('.autoplay').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  autoplay: true,
		  autoplaySpeed: 2000,
		  dots: true,
		   responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 3
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    }
		  ]
		});	

	     $('.single-item1').slick({
    	dots: false,
    	autoplay: true,
  		autoplaySpeed: 4000,
    	responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 3
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: false,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    }
		  ]
    });

// ACCORDANCE PANEL ABOUT US PAGE

	 function toggleIcon(e) {
		    $(e.target)
		        .prev('.panel-heading')
		        .find(".more-less")
		        .toggleClass('glyphicon-chevron-right glyphicon-chevron-down');
		}
		$('.panel-group').on('hidden.bs.collapse', toggleIcon);
		$('.panel-group').on('shown.bs.collapse', toggleIcon);

		$('.grid-view-wrap,.middle-section-view-wrap').matchHeight();
		

	/**
	 * Google Map
	*/
	function initialize() {

		// Create an array of styles.
		var styles = [{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ff9800"},{"gamma":1},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffc100"},{"saturation":33.4},{"lightness":-25.4},{"gamma":1},{"visibility":"on"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#ffa03f"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#f5d8c8"}]},{"featureType":"poi.attraction","elementType":"geometry.fill","stylers":[{"color":"#ff9506"},{"visibility":"off"}]},{"featureType":"poi.government","elementType":"labels.text.fill","stylers":[{"hue":"#ffb000"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"saturation":"-34"},{"color":"#f3a25c"},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"labels.text.stroke","stylers":[{"color":"#f6dbc3"},{"visibility":"on"}]},{"featureType":"poi.sports_complex","elementType":"geometry.fill","stylers":[{"color":"#e97a0a"}]},{"featureType":"poi.sports_complex","elementType":"labels.text.stroke","stylers":[{"color":"#f9e2cb"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#53FF00"},{"saturation":-73},{"lightness":40},{"gamma":1}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#FBFF00"},{"gamma":1}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#00FFFD"},{"lightness":30},{"gamma":1}]},{"featureType":"water","elementType":"all","stylers":[{"saturation":6},{"lightness":8},{"gamma":1},{"color":"#78c7e5"}]}];

		var loc, map, marker, infobox;

		var styledMap = new google.maps.StyledMapType(styles,  {name: "Styled Map"});

		loc = new google.maps.LatLng($("#map").attr("data-lat"), $("#map").attr("data-lon"));

		map = new google.maps.Map(document.getElementById("map"), {
			zoom: parseInt( news_unlimited_object.zoom_map ),
			center: loc,
			scrollwheel: false,
			//draggable:true,
			navigationControl: false,
			scaleControl: false,
			mapTypeControl:false,
			streetViewControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			},
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		});

		//Associate the styled map with the MapTypeId and set it to display.
		map.mapTypes.set('map_style', styledMap);
		map.setMapTypeId('map_style');

		marker = new google.maps.Marker({
			map: map,
			position: loc,
			//disableDefaultUI:true,

			icon: news_unlimited_object.map_icon,
			//pixelOffset: new google.maps.Size(-140, -100),
			visible: true

			//animation: google.maps.Animation.DROP
		});

		var center;
		function calculateCenter() {
			center = map.getCenter();
		}
		google.maps.event.addDomListener(map, 'idle', function() {
			calculateCenter();
		});
		google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(center);
		});

	}

	if( document.getElementById('map') ){
		google.maps.event.addDomListener(window, 'load', initialize);
	}
	
	/*  Arrow for Menu has sub-menu
     */
    if ($(window).width() > 992) {
      $(".navbar-arrow ul ul > li").has("ul").children("a").append("<i class='arrow-indicator fa fa-angle-right'></i>");
    }
    
    /* Main Menu Slide Down Effect
     */
     
    var selected = $('#navbar li');
    // Mouse-enter dropdown
    selected.on("mouseenter", function() {
        $(this).find('ul').first().stop(true, true).delay(350).slideDown(500, 'easeInOutQuad');
    });

    // Mouse-leave dropdown
    selected.on("mouseleave", function() {
        $(this).find('ul').first().stop(true, true).delay(100).slideUp(150, 'easeInOutQuad');
    });
    
    
    
    /**
     * Slicknav - a Mobile Menu
     */
    var $slicknav_label;
    $('#responsive-menu').slicknav({
      duration: 500,
      easingOpen: 'easeInExpo',
      easingClose: 'easeOutExpo',
      closedSymbol: '<i class="fa fa-plus"></i>',
      openedSymbol: '<i class="fa fa-minus"></i>',
      prependTo: '#slicknav-mobile',
      allowParentLinks: true,
      label:"" 
    });

    jQuery('#responsive-menu > li').each(function(){
    	if( jQuery(this).hasClass('page_item_has_children') ){
    		jQuery(this).find('a:first').append('<i class="has_sub_menu_parent fa fa-angle-down"></i>');
    	}
    });

	// If parent menu has submenu then add down arrow
    jQuery('#responsive-menu > li').each(function(){
        if( jQuery(this).find('ul').hasClass('sub-menu') ){
            jQuery(this).find('ul:first').prev('a').append('<i class="has_sub_menu_parent fa fa-angle-down"></i>');
        }
    });

})(jQuery);

    jQuery(window).on( 'scroll' , function(){
        if(jQuery(window).scrollTop() > 500){
            jQuery("#back-to-top").fadeIn(200);
        } else{
            jQuery("#back-to-top").fadeOut(200);
        }
    });

    jQuery(document).on("click",'#back-to-top a',function() {
        jQuery('html, body').animate({ scrollTop:0 },'slow');
        return false;
    });