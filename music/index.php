<?php 
  require_once('../inc/init.inc');

  $title = 'Album | Chapel';
  $background_image = '/img/back_music.jpg';
  $description = "Download the Chapel Worship album from Bandcamp or iTunes or listen to it on Spotify or Rdio! Build Your Kingdom Here, One Thing Remains, All The Poor & Powerless, Great I Am, Anchor, In Tenderness, Came To My Rescue, Oceans, Amazing Grace, Set a Fire [Live]. Chapel's mission is to invite and unite a generation of young people to see God move in our city. Through passionate worship, inspiring and convicting messages, and a community of awesome people, we are taking a bold stand for Jesus as one voice.";
  
  require_once('../inc/header.inc');
  require_once('../inc/nav.inc');
?>
  
    <div id="music" class="content clearfix">
      <div class="pane-left">
        <img class="title" src="/img/text-album.png" alt="Album">
      </div>

      <div class="pane-right center"> 
        <h2>Chapel made an Album!</h2>
        <p>You can download it from Bandcamp for <i>free</i>:</p>
        <a href="http://chapelworship.bandcamp.com/" target="_blank"><img src="https://s1.bcbits.com/img/buttons/bandcamp_130x27_white.png" alt="Download the album on Bandcamp"></a>
        <p>You can also support us by buying the album from iTunes:</p>
        <a href="https://itunes.apple.com/ca/album/chapel-worship/id1012537578" target="_blank"><img src="/img/itunes.png" width="170px" alt="Buy the album on iTunes"></a>
        <p>Or, if streaming is more your thing, you can check it out on these sites:</p>
        <div class="img-wrapper clearfix">
          <a href="https://open.spotify.com/album/2EzdG0n2QV6bbf9sBe1mE0" target="_blank"><img class="left" width="190px" src="/img/spotify.png" alt="Listen to the album on Spotify"></a>
          <a href="http://rd.io/x/Rl1bHag-CFrV/" target="_blank"><img class="right" width="170px" src="/img/rdio.png" alt="Listen to the album on Rdio"></a>
        </div>
      </div><!-- end of right -->
    </div><!-- end of content -->

    <?php require_once('../inc/social.inc'); ?>
<?php require_once('../inc/footer.inc'); ?>
