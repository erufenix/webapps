


//Preloader
   
	$(window).load(function() {
		$("#preloader").delay(350).fadeOut("slow");
	})  


	
	
	
	
	
//Home fit screen	
	
	
	/*global $:false */
	$(function(){"use strict";
		$('.home-top').css({'height':($(window).height())+'px'});
		$(window).resize(function(){
		$('.home-top').css({'height':($(window).height())+'px'});
		});
	});

	


//Home text rotator	
	
$(".rotator > div:gt(0)").hide();
setInterval(function() { 
  $('.rotator > div:first')
    .fadeOut(0)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('.rotator');
},  3000);



	
	
//Home Background Slider	
	
        $(function(){

            $.mbBgndGallery.buildGallery({
                containment:"#home",
                timer:4000,
                effTimer:700,
                controls:"#controls",
                grayScale:false,
                shuffle:false,
                preserveWidth:false,
                effect:"slideDown",
				effect:{enter:{top:"-100%",opacity:1},exit:{top:0,opacity:0}, enterTiming:"ease-in", exitTiming:"ease-in"},

                // If your server allow directory listing you can use:
                // (however this doesn't work locally on your computer)

                //folderPath:"testImage/",

                // else:

                 images:[
                 "images/1.jpg",
                 "images/2.jpg",
                 "images/3.jpg"
                 ],

                onStart:function(){},
                onPause:function(){},
                onPlay:function(opt){},
                onChange:function(opt,idx){},
                onNext:function(opt){},
                onPrev:function(opt){}
            });


        });	
		
	

//Navigation	

$('ul.slimmenu').on('click',function(){
var width = $(window).width(); 
if ((width <= 800)){ 
    $(this).slideToggle(); 
}	
});		

			var currentIndex = 0;
			var currentId = "home";
$('ul.slimmenu').slimmenu(
{
    resizeWidth: '800',
    collapserTitle: '',
    easingEffect:'easeInOutQuint',
    animSpeed:'medium',
    indentChildren: true,
    childrenIndenter: '&raquo;'
});
			
			var colors = {
					"home" : {
						"background" : "",
						"index" : 0
					},
					"about" : {
						"background" : "",
						"index" : 1
					},
					"services" : {
						"background" : "",
						"index" : 2
					},
					"folio" : {
						"background" : "",
						"index" : 3
					},
					"contact" : {
						"background" : "",
						"index" : 4
					},
					"blog" : {
						"background" : "",
						"index" : 5
					}
					
			};
			
			function goTo(id){
				var obj = eval("colors."+id);
				
				$("body").css("background",obj.background);
				$("ul.slimmenu li a").css("color",obj.background);
				if(obj.index > currentIndex){
					$(".active").addClass("off");
					$(".active").transition({
						x : -100,
						opacity : 0,
						zIndex : 0
					},600);
					
					$("#"+currentId).removeClass("active");
					
					$("#"+id).addClass("active");
					$("#"+id).transition({
						perspective: '100px',
						rotate3d: '1,1,0,90deg'
					},0,function(){
						$("#"+id).removeClass("off");
						$("#"+id).transition({
							rotate3d: '0,0,0,0deg',
						x : 0,
							opacity : 1,
							zIndex : 2
						},600);
					});
				}else if(obj.index < currentIndex){
					$(".active").addClass("off");
					$(".active").transition({
						x : 100,
						opacity : 0,
						zIndex : 0
					},600);
					$("#"+currentId).removeClass("active");
					
					
					$("#"+id).addClass("active");
					$("#"+id).transition({
						perspective: '100px',
						rotate3d: '1,1,0,-90deg'
					},0,function(){
						$("#"+id).removeClass("off");
						$("#"+id).transition({
							rotate3d: '0,0,0,0deg',
						x : 0,
							opacity : 1,
							zIndex : 2
						},600);
					});
				}
				currentIndex = obj.index;
				currentId = id;
				
			}	
	

	
//Sliders	
	
	$(document).ready(function(){
		$('.slider1').bxSlider({
			adaptiveHeight: true,
			touchEnabled: true,
			pager: false,
			controls: true,
			auto: false,
			slideMargin: 1
		});
	});	
	
	
	$(document).ready(function(){
		$('.slider2').bxSlider({
			adaptiveHeight: true,
			touchEnabled: true,
			pager: false,
			controls: true,
			auto: false,
			slideMargin: 1
		});
	});	
	
	$(document).ready(function(){
		$('.slider3').bxSlider({
			adaptiveHeight: true,
			touchEnabled: true,
			pager: false,
			controls: true,
			auto: false,
			slideMargin: 1
		});
	});		

	
	$(document).ready(function(){
		$('.slider4').bxSlider({
			adaptiveHeight: true,
			touchEnabled: true,
			pager: false,
			controls: true,
			auto: false,
			slideMargin: 1
		});
	});		

	
	$(document).ready(function(){
		$('.slider5').bxSlider({
			adaptiveHeight: true,
			touchEnabled: true,
			pager: false,
			controls: true,
			auto: false,
			slideMargin: 1
		});
	});	



	
	
	

//Responsive video	
	
  $(document).ready(function(){
    $(".media").fitVids();
  });	
	
	
	
	
	
	
	

	
//Modal windows

$(function() {
    "use strict";

    $('#fall').on('click', function () {
        $.fn.custombox( this, {
            effect: 'fall'
        });
        return false;
    });


    var slide_position = ['center'];

    $('#slide').on('click', function () {
        $.fn.custombox( this, {
            effect:     'slide',
            position:   slide_position[Math.floor( Math.random() * slide_position.length )]
        });
        return false;
    });


    $('#newspaper').on('click', function () {
        $.fn.custombox( this, {
            effect: 'newspaper'
        });
        return false;
    });


    $('#sidefall').on('click', function () {
        $.fn.custombox( this, {
            effect: 'sidefall'
        });
        return false;
    });

	
	});



//Portfolio filter	





jQuery(document).ready(function () { 
	(function ($) { 
	
	
		var container = $('.all-works');
		
		
		function getNumbColumns() { 
			var winWidth = $(window).width(), 
				columnNumb = 1;
			
			
			if (winWidth > 1500) {
				columnNumb = 3;
			} else if (winWidth > 1200) {
				columnNumb = 3;
			} else if (winWidth > 900) {
				columnNumb = 2;
			} else if (winWidth > 600) {
				columnNumb = 1;
			} else if (winWidth > 300) {
				columnNumb = 1;
			}
			
			return columnNumb;
		}
		
		
		function setColumnWidth() { 
			var winWidth = $(window).width(), 
				columnNumb = getNumbColumns(), 
				postWidth = Math.floor(winWidth / columnNumb);

		}
		
		$('#portfolio-filter #filter a').click(function () { 
			var selector = $(this).attr('data-filter');
			
			$(this).parent().parent().find('a').removeClass('current');
			$(this).addClass('current');
			
			container.isotope( { 
				filter : selector 
			});
			
			setTimeout(function () { 
				reArrangeProjects();
			}, 300);
			
			
			return false;
		});
		
		function reArrangeProjects() { 
			setColumnWidth();
			container.isotope('reLayout');
		}
		
		
		container.imagesLoaded(function () { 
			setColumnWidth();
			
			
			container.isotope( { 
				itemSelector : '.one-work', 
				layoutMode : 'masonry', 
				resizable : false 
			} );
		} );
		
		
	
		
	
		$(window).on('debouncedresize', function () { 
			reArrangeProjects();
			
		} );
		
	
	} )(jQuery);
} );




/* DebouncedResize Function */
	(function ($) { 
		var $event = $.event, 
			$special, 
			resizeTimeout;
		
		
		$special = $event.special.debouncedresize = { 
			setup : function () { 
				$(this).on('resize', $special.handler);
			}, 
			teardown : function () { 
				$(this).off('resize', $special.handler);
			}, 
			handler : function (event, execAsap) { 
				var context = this, 
					args = arguments, 
					dispatch = function () { 
						event.type = 'debouncedresize';
						
						$event.dispatch.apply(context, args);
					};
				
				
				if (resizeTimeout) {
					clearTimeout(resizeTimeout);
				}
				
				
				execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
			}, 
			threshold : 150 
		};
	} )(jQuery);			
	

	
	
	
//Colorbox single project pop-up

$(document).ready(function(){
$(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});	
});

$(".group1").colorbox({rel:'group1'});		
	

	
	
	

// Switcher CSS 
  $(document).ready(function() {
"use strict";
    $("#hide, #show").click(function () {
        if ($("#show").is(":visible")) {
           
            $("#show").animate({
                "margin-left": "-500px"
            }, 500, function () {
                $(this).hide();
            });
            
            $("#switch").animate({
                "margin-left": "0px"
            }, 500).show();
        } else {
            $("#switch").animate({
                "margin-left": "-500px"
            }, 500, function () {
                $(this).hide();
            });
            $("#show").show().animate({
                "margin-left": "0"
            }, 500);
        }
    });
                      
});



	
//Google map	
	
/*global $:false */
    var map;
    $(document).ready(function(){"use strict";
      map = new GMaps({
    disableDefaultUI: true,
    scrollwheel: false,
        el: '#map',
        lat: 44.789511,
        lng: 20.43633
      });
      map.drawOverlay({
        lat: map.getCenter().lat(),
        lng: map.getCenter().lng(),
        layer: 'overlayLayer',
        content: '<div class="overlay"></div>',
        verticalAlign: 'center',
        horizontalAlign: 'center'
      });
        var styles = [
  {
    "featureType": "poi",
    "stylers": [
      { "visibility": "on" },
      { "weight": 0.9 },
      { "lightness": 37 },
      { "gamma": 0.62 },
      { "hue": "#ff0000" },
      { "saturation": -93 }
    ]
  },{
    "featureType": "poi",
    "stylers": [
      { "hue": "#ff0000" },
      { "saturation": -1 },
      { "color": "#ffffff" },
      { "weight": 0.2 }
    ]
  },{
    "featureType": "road",
    "stylers": [
      { "hue": "#ff0000" },
      { "saturation": -98 }
    ]
  },{
    "featureType": "landscape",
    "stylers": [
      { "hue": "#ff0000" },
      { "saturation": -89 }
    ]
  },{
    "featureType": "water",
    "stylers": [
      { "weight": 0.4 },
      { "saturation": -38 }
    ]
  }
];
        
        map.addStyle({
            styledMapName:"Styled Map",
            styles: styles,
            mapTypeId: "map_style"  
        });
        
        map.setStyle("map_style");	  
    });		
	








	
	