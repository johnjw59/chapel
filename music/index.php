<?php 
  require_once('../inc/init.inc');

  $title = 'Music | Chapel';
  $background_image = '/img/back_music.jpg';

  // Go straight to bandcamp until the album is up on itunes and friends.
  $javascript = 'window.location="https://chapelworship.bandcamp.com/";';
  
  require_once('../inc/header.inc');
  require_once('../inc/nav.inc');
?>
  
    <div id="music" class="content clearfix">
      <div class="left">
        <img class="title" src="/img/text-music.png" alt="Music">
      </div>

      <div class="right center"> 
        <h2>Chapel made an Album!</h2>
        <p>You can download it from Bandcamp for <i>free</i>:</p>
        <a href="http://bandcamp.com"><img src="https://s1.bcbits.com/img/buttons/bandcamp_130x27_white.png"></a>
        <p>You can also support us by buying the album from iTunes:</p>
        <a href=""><img src="/img/itunes.png" width="200px"></a>
        <p>Or, if streaming is more your thing, you can check it out on these sites:</p>
        <div class="img-wrapper clearfix">
          <a href=""><img class="img-left" width="200px" src="/img/rdio.png"></a>
          <a href=""><img class="img-right" width="200px" src="/img/spotify.jpg"></a>
        </div>
      </div><!-- end of right -->
    </div><!-- end of content -->

    <?php require_once('../inc/social.inc'); ?>
<?php require_once('../inc/footer.inc'); ?>
