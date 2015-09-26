<?php 
  require_once('../../inc/init.inc');

  $title = 'Vancouver | Chapel';
  $background_image = '/img/back_vancouver.jpg';
  $scripts = array(
    '<script type="javascript/text">window.onresize = dynamicHeight;</script>',
  );

  $fbfeed_path = '../../fbfeed';
  include($fbfeed_path . '/fbfeed-settings.php');

  require_once('../../inc/header.inc');
  require_once('../../inc/nav.inc');
?>

    <div id="location" class="content clearfix">

      <div class="pane-left clearfix">
        <div class="logo-labels clearfix">
          <img class="title" src="/img/logo-vancouver.svg" alt="Chapel Vancouver" onload="dynamicHeight();" />
          <img class="label" src="/img/label-upcoming.svg" alt="Upcoming Chapels" />
        </div>
  
        <div id="upcoming">
        <?php 
          $chapels = upcoming_chapels('vancouver');
          if ($chapels):
            foreach ($chapels as $event): ?>
              <div class="event">
                <?php if ($event['event_link']){ print('<a href="' . $event['event_link'] . '" target="_blank">'); } ?>
                <div class="date"><?= date('F jS', strtotime($event['date'])); ?></div>
                <div class="name"><?= $event['title']; ?></div>
                <div class="time"><?= date('ga', strtotime($event['date'])); ?></div>
                <div class="location"><?= $event['location']; ?></div>
                <?php if ($event['event_link']){ print('</a>'); } ?>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="checkback">
              Check back soon for more Chapel dates!
            </div>
          <?php endif; ?>
        </div>
      </div><!-- end of left -->

      <div class="pane-right">
        <img class="label" src="/img/label-community.svg" alt="Community" />
        <h2>
          Want to keep up with Chapel Vancouver?<br /> 
          Join our <a href="http://www.facebook.com/283821668334514" target="_blank">Facebook Group</a>.
        </h2>
        <?php
          $custom = array(
            'id' => '283821668334514',
          );
          fbFeed($settings, $custom);
        ?>
      </div><!-- end of right -->
    </div><!-- end of content -->

<?php require_once('../../inc/footer.inc'); ?>
