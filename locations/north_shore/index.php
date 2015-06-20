<?php 
  require_once('../../inc/init.inc');

  $title = 'North Shore | Chapel';
  $background_image = '/img/back_north_shore.jpg';
  $javascript = 'window.onresize = dynamicHeight;';

  $fbfeed_path = '../../fbfeed';
  include($fbfeed_path . '/fbfeed-settings.php');
  
  require_once('../../inc/header.inc');
  require_once('../../inc/nav.inc');
?>

    <div id="location" class="content clearfix">

      <div class="pane-left">
        <div class="logo-labels clearfix">
          <img class="title" src="/img/logo-north_shore.png" alt="Chapel North Shore" onload="dynamicHeight();" />
          <img class="label" src="/img/label-upcoming.png" alt="Upcoming Chapels" />
        </div>
  
        <div id="upcoming">
          <?php foreach (upcoming_chapels('north_shore') as $event): ?>
            <div class="event">
              <?php if ($event['event_link']){ print('<a href="' . $event['event_link'] . '" target="_blank">'); } ?>
              <div class="date"><?= date('F jS', strtotime($event['date'])); ?></div>
              <div class="name"><?= $event['title']; ?></div>
              <div class="time"><?= date('ga', strtotime($event['date'])); ?></div>
              <div class="location"><?= $event['location']; ?></div>
              <?php if ($event['event_link']){ print('</a>'); } ?>
            </div>
          <?php endforeach; ?>
         </div>
      </div><!-- end of left -->

      <div class="pane-right">
        <img class="label" src="/img/label-community.png" alt="Community" />
        <span class="invite">
          Want to keep up with Chapel North Shore?<br /> 
          Join our <a href="http://www.facebook.com/520834214713287" target="_blank">Facebook Group</a>.
        </span>
        <?php
          $custom = array(
            'id' => '520834214713287',
            'access_token' => 'CAAUyS2LvayQBAGK9XxSfv3iunFrhJz2UwMBxGENmZA0bNlk7zPF2VgPkwir0pSQhvOnLZCtSZCC28B04LuqgbIcBbxoLkn2XGwODjguTZCi9xgmXcdnUDfhuwjkRX2wKdXfJrejzLf7vO607178e53bvXDOjn679YXZCW1y3abYoDNYxQJoVckdoaiShMkjSt1q9SRpUZA3QZDZD',
          );
          fbFeed($settings, $custom);
          // https://smashballoon.com/custom-facebook-feed/docs/get-extended-facebook-user-access-token/
        ?>
      </div><!-- end of right -->
    </div><!-- end of content -->

<?php require_once('../../inc/footer.inc'); ?>

