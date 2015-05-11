$(document).ready(function() {
  $("#hamburger").click(function(e) {
    e.stopPropagation();
    $("#menu").show();
  });

  $(window).resize(function(){
    if($(window).width() > 790) {
      $('#menu').show();
    }
    else {
      $('#menu').hide();
    }
  });
});
