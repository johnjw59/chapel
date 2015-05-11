<?php 
  require_once('../../inc/init.inc');

  $title = 'Tri-cities | Chapel';
  $background_image = $base_url . '/img/back_tri-cities.jpg';
  $javascript = 'window.onresize = dynamicHeight;';

  $fbfeed_path = '../../fbfeed';
  include($fbfeed_path . '/fbfeed-settings.php');
  
  require_once('../../inc/header.inc');
  require_once('../../inc/nav.inc');
?>

    <div id="location" class="content clearfix">

      <div class="left">
        <div class="logo-labels clearfix">
          <img class="title" src="<?php echo($base_url); ?>/img/logo-tri-cities.png" alt="Chapel Tri-cities" onload="dynamicHeight();" />
          <img class="label" src="<?php echo($base_url); ?>/img/label-upcoming.png" alt="Upcoming Chapels" />
        </div>

        <div id="upcoming">
         <div class="event">
           <span class="date">May 29th</span>
           <span class="name">Chapel Tri-cities</span>
           <span class="time">7pm</span>
           <span class="location">Charles Best Secondary, 2525 Como Lake Ave, Coquitlam</span>
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
        <img class="label" src="<?php echo($base_url); ?>/img/label-community.png" alt="Community" />
        <span class="invite">
          Want to keep up with Chapel Tri-cities?<br /> 
          Join our <a href="http://www.facebook.com/733198850086184" target="_blank">Facebook Group</a>.
        </span>
        <?php
          $custom = array(
            'id' => '733198850086184',
          );
          fbFeed($settings, $custom);
        ?>
      </div><!-- end of right -->
    </div><!-- end of content -->

<?php require_once('../../inc/footer.inc'); ?>
