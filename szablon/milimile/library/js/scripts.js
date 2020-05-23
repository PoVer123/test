/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function
if(viewport.width < 1030)
  mobileMenus();
else 
  desktopMenus();
jQuery(window).resize(function () {
 
 
     // update the viewport, in case the window size has changed
      viewport = updateViewportDimensions();
 
       // if we're above or equal to 768 fire this off
       if( viewport.width >= 1030 ) {
         desktopMenus();
       } else {
         mobileMenus();
       }
 
});
function desktopMenus(){
  document.getElementById('mobile-menu-icon').style.display = "none";
  var nav = document.getElementById('main-nav');
  var menu = nav.getElementsByTagName('ul')[0];
  menu.classList.add('desktop-menu');
  jQuery(document).on("scroll",function(){
    if(jQuery(document).scrollTop()>100){
        jQuery(".nav").addClass("moved");
    } else{
        jQuery(".nav").removeClass("moved");
    }
    if(jQuery(document).scrollTop()>600){
        jQuery(".background").hide();
    } else{
        jQuery(".background").show();
    }
});
};
function mobileMenus(){
  var menuIcon = document.getElementById('mobile-menu-icon');
  menuIcon.style.display = "block";
  var nav = document.getElementById('main-nav');
  var menu = nav.getElementsByTagName('ul')[0];
  var home = document.getElementsByClassName('menu-item-home')[0];
  var sub = document.getElementsByClassName('sub-menu')[0];
  var sm = document.getElementsByClassName('social-media')[0];
  if(home)
  home.style.display="none";
  //sub.style.display="none";
 // jQuery('.sub-menu').hide();
  // var rozmowa = document.getElementById("menu-item-63");
  // var ranchor = rozmowa.getElementsByTagName("a")[0];
  // ranchor.onclick = function(e){
  //   e.preventDefault();
  //   jQuery('.sub-menu').slideToggle();
  // };
  jQuery('footer').hide();
  menuIcon.onclick = function(){
    if(!menu.classList.contains('nav-open')){
      menu.classList.add('nav-open');
      sm.style.position = "fixed";
    }
    else{
      menu.classList.remove('nav-open');
      sm.style.position = "relative";
    }
    if(this.classList.contains('open'))
      this.classList.remove('open');
    else
      this.classList.add('open');

  }
  if(document.body.classList.contains('tax-kategoria-miejsca')){
    var filters = document.getElementById('filters');
    var head = filters.getElementsByClassName('filter-head')[0];
    var box = filters.getElementsByClassName('filter-box')[0];

    head.onclick = function(){
      if(box.classList.contains('open'))
        box.classList.remove('open')
      else
        box.classList.add('open')
    }
  }
}
//mobileMenus();

function showImages(el) {
        var windowHeight = jQuery( window ).height();
        jQuery(el).each(function(){
            var thisPos = jQuery(this).offset().top;

            var topOfWindow = jQuery(window).scrollTop();
            if (topOfWindow + windowHeight - 200 > thisPos ) {
                jQuery(this).addClass("fadeIn");
            };
        });
    }
showImages('.element');
    // if the image in the window of browser when the page is loaded, show that image
    jQuery(document).ready(function(){
            showImages('.element');
            showImages('blockquote');
    });

    // if the image in the window of browser when scrolling the page, show that image
    jQuery(window).scroll(function() {
            showImages('.element');
            showImages('blockquote');
    });


//google maps:

var latitude = parseFloat(php_vars.latitude);
var longtitude = parseFloat(php_vars.longtitude);
var zoomIn = parseInt(php_vars.zoom);
var map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: latitude, lng: longtitude},
  zoom: zoomIn,
  styles:[
  
  {
    "featureType": "water",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#9fcecb"
      }
    ]
  }
  
]

});

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {


  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();


}); /* end of as page load scripts */
