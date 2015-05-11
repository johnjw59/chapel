<?php 
  require_once('../../inc/init.inc');

  $title = 'North Shore | Chapel';
  $background_image = $base_url . '/img/back_north_shore.jpg';
  $javascript = 'window.onresize = dynamicHeight;';

  $fbfeed_path = '../../fbfeed';
  include($fbfeed_path . '/fbfeed-settings.php');
  
  require_once('../../inc/header.inc');
  require_once('../../inc/nav.inc');
?>

    <div id="location" class="content clearfix">

      <div class="left">
        <div class="logo-labels clearfix">
          <img class="title" src="<?php echo($base_url); ?>/img/logo-north_shore.png" alt="Chapel North Shore" onload="dynamicHeight();" />
          <img class="label" src="<?php echo($base_url); ?>/img/label-upcoming.png" alt="Upcoming Chapels" />
        </div>
  
        <div id="upcoming">
          <div class="event">
            <span class="date">May 29th</span>
            <span class="name">Chapel North Shore</span>
            <span class="time">7pm</span>
            <span class="location">Queen Mary Community School, 230 Keith Road West, North Vancouver</span>
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
          Want to keep up with Chapel North Shore?<br /> 
          Join our <a href="http://www.facebook.com/520834214713287" target="_blank">Facebook Group</a>.
        </span>
        <?php
          $custom = array(
            'id' => '520834214713287',
            'access_token' => 'CAAUyS2LvayQBAAAHiuZCZCUXzl84iIZAGuOjT6yvZAo4j8yJsFZAIX6RYl7BZBxRMiOeleyXFkQdFQnOMKvQcuRAcGJNZBdGisl912IPbkMZAFqI7ZCpRIOgsx4fp3EDEngDubw6XoBwTRjGH3GeolIV8u7dSQ7v6fMfoBTQT4qFOEQyeYGWQDiorT7qiuGZBbFltZCcxsNdcxSBQZDZD',
          );
          fbFeed($settings, $custom);
          // https://smashballoon.com/custom-facebook-feed/docs/get-extended-facebook-user-access-token/
        ?>
      </div><!-- end of right -->
    </div><!-- end of content -->

<?php require_once($base_url . '../../inc/footer.inc'); ?>

