function dynamicHeight() {
  var $windowHeight = ($(window).height());

  var $above = ($(".logo-labels").height()) + 123;
  var $height = Math.max(($windowHeight - $above), 90);

  $("#upcoming").css("height", $height + "px");
}
