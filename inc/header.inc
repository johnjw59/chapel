<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title><?php echo($title); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/favicon.png">
    <link rel="apple-touch-icon" href="/favicon.png">
    <meta name="keywords" content="Chapel, Chape, Chaple, Movement, chapelmvmt, #chapelmvmt, Vancouver, North Shore, Tri-cities, Worship, Youth, Christian, Concert, Band, Jonathan Mitchell, jo vancouver, j o vancouver, Chapel j o, shore chapel, Youth Unlimited">
    <meta name="description" content="Chapel is a monthly Friday night worship event for high school youth and young adult leaders, presented by Youth Unlimited, with locations in Vancouver, the North Shore and the Tri-cities. Chapel's mission is to invite and unite a generation of young people to see God move in our city; to create a movement, not a moment. Through passionate worship, inspiring and convicting messages, and a community of awesome people, we are taking a bold stand for Jesus as one voice. #chapelmvmt">
    
    <link rel="stylesheet" href="/css/icomoon.css" type="text/css" />
    <link rel="stylesheet" href="/css/main.css" type="text/css" />
    <link rel="stylesheet" media="(max-width: 790px)" href="/css/mobile.css" type="text/css" />

    <script type="text/javascript" src="/js/lib/jquery-1.7.1.min.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-53242106-2', 'auto');
      ga('send', 'pageview');
    </script>


    <script type="text/javascript" src="/js/countdown.js"></script>
    <script type="text/javascript" src="/js/verticalcenter.js"></script>
    <script type="text/javascript" src="/js/dynamicheight.js"></script>
    <script type="text/javascript" src="/js/mobile_menu.js"></script>

    <script>
        // Launch countdown clock.
        $(document).ready(function() {
          count(<?php print $next_chapel; ?>*1000);
          setInterval(function(){count(<?php print $next_chapel; ?>*1000);}, 1000);
        });
    </script>
    
    <?php
      // print any scripts local to the page.
      if (isset($scripts)) {
        foreach ($scripts as $script) {
          print $script;
        }
      }
    ?>
  </head>
  <body style="background-image: url(<?php echo($background_image); ?>);">
