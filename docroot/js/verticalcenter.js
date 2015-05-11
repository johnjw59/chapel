function verticalCenter() {
  var $height = ($(window).height());
  // element to be centered
  var $contentHeight = ($("#front").height());
  
  var $height = ($height - $contentHeight) /2;
  // subtract nav from top of element
  var marginTop = Math.max($height, 140);
  var marginBottom = $height;
  
  $("#front").css("margin", marginTop + "px 0 " + marginBottom + "px 0");
     
}
