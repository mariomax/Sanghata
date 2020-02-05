/* WordPress uses jQuery and the shorthand "$" for other functions. */
/* Use $j instead of the shorthand or the "longhand" fix of jQuery. */
var $j = jQuery.noConflict();

$j(window).scroll(function() {    // Fires when window scrolled
  var height = $j(window).scrollTop();  // Get scrolling height of window
  var sBContainer = $j(".site-branding-container");  // Get the whole container
  var sBranding = $j(".site-branding");  // Get the parent container too
  var sTitle = $j(".site-title");  // Move the title over on scroll
  var sDescription = $j(".site-description");  // Move the description over on scroll
  var theNav = $j(".main-navigation");  // Give the element a new class name
  if (height  > 100) {
    sBContainer.addClass("fixedContainer");
    sBranding.addClass("fixedBox");
    sTitle.addClass("fixedTitle");
    sDescription.addClass("fixedDescription");
    theNav.addClass("fixedNav");
  } else {
    sBContainer.removeClass("fixedContainer");
    sBranding.removeClass("fixedBox");
    sTitle.removeClass("fixedTitle");
    sDescription.removeClass("fixedDescription");
    theNav.removeClass("fixedNav");
  }
});
