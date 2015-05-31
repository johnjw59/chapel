<?php 
  require_once('../../inc/init.inc');

  $title = 'Vancouver | Chapel';
  $background_image = '/img/back_vancouver.jpg';
  $javascript = 'window.onresize = dynamicHeight;';

  $fbfeed_path = '../../fbfeed';
  include($fbfeed_path . '/fbfeed-settings.php');

  require_once('../../inc/header.inc');
  require_once('../../inc/nav.inc');
?>

    <div id="location" class="content clearfix">

      <div class="left clearfix">
        <div class="logo-labels clearfix">
          <img class="title" src="/img/logo-vancouver.png" alt="Chapel Vancouver" onload="dynamicHeight();" />
          <img class="label" src="/img/label-upcoming.png" alt="Upcoming Chapels" />
        </div>
  

        <div id="upcoming">
         <div class="event">
           <div class="date">May 29th</div>
           <div class="name">Chapel Vancouver</div>
           <div class="time">7pm</div>
           <div class="location">John Oliver Secondary, 530 E 41st Ave, Vancouver</div>
         </div>
         <div class="event">
            <span class="date">June 20th</span>
            <span class="name">Chapel Unified</span>
            <span class="time">7pm</span>
            <span class="location">Westside Church, 777 Homer Street, Vancouver</span>
          </div>
        </div>
      </div><!-- end of left -->

      <div class="right">
        <img class="label" src="/img/label-community.png" alt="Community" />
        <div class="invite">
          Want to keep up with Chapel Vancouver?<br /> 
          Join our <a href="http://www.facebook.com/283821668334514" target="_blank">Facebook Group</a>.
        </div>
        <?php
          $custom = array(
            'id' => '283821668334514',
          );
          fbFeed($settings, $custom);
        ?>
      </div><!-- end of right -->
    </div><!-- end of content -->

<?php require_once('../../inc/footer.inc'); ?>
