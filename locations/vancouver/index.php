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

      <div class="pane-left clearfix">
        <div class="logo-labels clearfix">
          <img class="title" src="/img/logo-vancouver.png" alt="Chapel Vancouver" onload="dynamicHeight();" />
          <img class="label" src="/img/label-upcoming.png" alt="Upcoming Chapels" />
        </div>
  
        <div id="upcoming">
          <?php foreach (upcoming_chapels('vancouver') as $event): ?>
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
