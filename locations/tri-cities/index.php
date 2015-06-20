<?php 
  require_once('../../inc/init.inc');

  $title = 'Tri-cities | Chapel';
  $background_image = '/img/back_tri-cities.jpg';
  $javascript = 'window.onresize = dynamicHeight;';

  $fbfeed_path = '../../fbfeed';
  include($fbfeed_path . '/fbfeed-settings.php');
  
  require_once('../../inc/header.inc');
  require_once('../../inc/nav.inc');
?>

    <div id="location" class="content clearfix">

      <div class="pane-left">
        <div class="logo-labels clearfix">
          <img class="title" src="/img/logo-tri-cities.png" alt="Chapel Tri-cities" onload="dynamicHeight();" />
          <img class="label" src="/img/label-upcoming.png" alt="Upcoming Chapels" />
        </div>

        <div id="upcoming">
          <?php foreach (upcoming_chapels('tri-cities') as $event): ?>
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
