<?php 
  require_once('../inc/init.inc');

  $title = 'About | Chapel';
  $background_image = $base_url . '/img/back_about.jpg';
  
  require_once('../inc/header.inc');
  require_once('../inc/nav.inc');
?>
  
    <div id="about" class="content clearfix">
      <div class="left">
        <img class="title" src="<?php echo($base_url); ?>/img/text-about.png" alt="About" />
      </div>

      <div class="right">
        <span class="videoWrapper">
          <iframe width="560" height="315" src="//www.youtube.com/embed/c_XF5bQH9zA?wmode=transparent&amp;rel=0&amp;autohide=1&amp;showinfo=0&amp;enablejsapi=1" frameborder="0" allowfullscreen="allowfullscreen" webkitallowfullscreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen"></iframe>
        </span>

        <h3>Values</h3>
        <ul>
          <li>
            <strong>Gospel-Centered</strong>. What Jesus has done and what he calls us to do will always be the focus of each Chapel night.</li>
          <li>
            <strong>Partnering with Churches</strong>. Chapel’s vision is to see the local Church flourish. By partnering with entire youth groups, youth can experience God together and walk out their faith as a community.
          </li>
          <li>
            <strong>Empowering the One</strong>. This movement isn’t reliant on epic events and big numbers. Chapel’s goal will always be to empower and encourage individuals to grab hold of God’s call on their own lives.
          </li>
        </ul>

        <h3>History</h3>
        <p>
          Chapel started out in a small church in South Vancouver with a couple youth groups coming together and believing God for something big to happen. Despite small numbers and seemingly insurmountable ambitions, the youth that came faithfully engaged with their whole hearts in worship. And it was contagious. Other youth groups joined, camps kids found community, and soon that little church in South Van couldn’t hold everyone.
        </p>
        <p>
          Things moved to the local high school, and God continued to unite groups from across the city to join together in worship and proclaiming the gospel. These days, Chapel is multiplying leaders and initiating satellite Chapel campuses in other suburbs of Vancouver. The satellite model is overcoming geographical obstacles and empowering local leaders with a city-wide vision. We are excited about where God is taking Chapel as movement! And just like those kids back in that little church in South Van, we continue to expect God to move in ways we can’t even imagine.
        </p> 

      </div><!-- end of right -->
    </div><!-- end of content -->

    <?php require_once('../inc/social.inc'); ?>
<?php require_once('../inc/footer.inc'); ?>