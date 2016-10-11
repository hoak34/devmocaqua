var $ = jQuery.noConflict();
$(document).ready(function(){

	// Responsive video
	$(".hentry, .widget").fitVids();
	
	$('ul.sf-menu').superfish({
		delay:      100,
		speed:      'fast',
		autoArrows: false     
	});

});	

// Widget slider.
$(window).load(function() {
	$('.news-slider').flexslider({
		animation: "slide"
	});

	$('#mainFlexslider').flexslider({
		animation: "fade",
		manualControls: "#main-slider-control-nav li",
		animationLoop: true,
		slideshow: true,
	});

	  // store the slider in a local variable
	  var $window = $(window),
		  flexslider;
	 
	  // tiny helper function to add breakpoints
	  function getGridSize() {
		return (window.innerWidth < 768) ? 2 : 3;
	  }
	 
	$('#video-flexslider').flexslider({
	  animation: "slide",
	  animationLoop: false,
	  itemWidth: 270,
	  itemMargin: 30,
	  minItems: getGridSize(), // use function to pull in initial value
	  maxItems: getGridSize() // use function to pull in initial value
	});
	 
	  // check grid size on resize event
	  $window.resize(function() {
		var gridSize = getGridSize();
	 
		flexslider.minItems = gridSize;
		flexslider.maxItems = gridSize;
	  });
});