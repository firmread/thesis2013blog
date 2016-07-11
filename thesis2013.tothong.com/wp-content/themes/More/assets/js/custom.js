/***************************************************
			SuperFish Menu
***************************************************/	
// initialise plugins
	jQuery.noConflict()(function(){
		jQuery('ul#menu').superfish();
	});
	
	
	
jQuery.noConflict()(function($) {
  if ($.browser.msie && $.browser.version.substr(0,1)<7)
  {
	$('li').has('ul').mouseover(function(){
		$(this).children('ul').css('visibility','visible');
		}).mouseout(function(){
		$(this).children('ul').css('visibility','hidden');
		})
  }
});

/***************************************************
				TOPBAR
***************************************************/

jQuery("#TopTrigger").toggle(function(){
	jQuery("#TopContentInset").slideDown('fast'); 
	jQuery(this).text('-');
}, function () {
	jQuery("#TopContentInset").slideUp('fast');
	jQuery(this).text('+');
});

/***************************************************
			Responsive Menu
***************************************************/
jQuery.noConflict()(function($){
	   
      // Create the dropdown base
      $("<select />").appendTo("nav");
      
      // Create default option "Go to..."
      $("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Please choose page"
      }).appendTo("nav select");
      
      // Populate dropdown with menu items
      $("nav a").each(function() {
       var el = $(this);
       $("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });
      
	   // To make dropdown actually work
	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
      $("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
});


/***************************************************
			Pretty Photo
***************************************************/

jQuery.noConflict()(function($){
	$(document).ready(function() {  
		$("a[rel^='prettyPhoto']").prettyPhoto({opacity:0.80,default_width:200,default_height:344,theme:'facebook',hideflash:false,modal:false});
	});
});


/***************************************************
			Nivo SLider
***************************************************/
jQuery.noConflict()(function($){
	$(window).load(function() {
        $('#slider').nivoSlider();
    });
})


/***************************************************
			Twitter feed
***************************************************/
jQuery.noConflict()(function($){
	jQuery(document).ready(function () {
		JQTWEET.loadTweets();
	});
})


/***************************************************
			Testimonials rotator
***************************************************/
jQuery.noConflict()(function($){
	$(".testimonialrotator").testimonialrotator({
		settings_slideshowTime:2
	});
});


/***************************************************
			Simple content slider
***************************************************/
jQuery.noConflict()(function($){
	$('#slides').slides({
		preload: true,
        preloadImage: 'assets/img/spinner-trans.gif',
		next: 'next',
		prev: 'prev',
		generatePagination: false
		
	});
});


/***************************************************
			Isotope Portfolio
***************************************************/
jQuery.noConflict()(function($){
var $container = $('#portfolio');
		
if($container.length) {
	$container.waitForImages(function() {
		
		// initialize isotope
		$container.isotope({
		  itemSelector : '.block',
		  layoutMode : 'fitRows'
		});
		
		// filter items when filter link is clicked
		$('#themeFilterableNav a').click(function(){
		  var selector = $(this).attr('data-filter');
		  $container.isotope({ filter: selector });
		  $(this).parent().addClass('active-tag').siblings().removeClass('active-tag');
		  return false;
		});
		
	},null,true);
}});
