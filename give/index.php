<?php 
  require_once('../inc/init.inc');

  $title = 'Give | Chapel';
  $background_image = '/img/back_give.jpg';
  
  require_once('../inc/header.inc');
  require_once('../inc/nav.inc');
?>
  
    <div id="about" class="content clearfix">
      <div class="pane-left">
        <img class="title" src="/img/text-give.svg" alt="Give" style="width: 65%; padding-left: 15%;" />
      </div>

      <div class="pane-right">
        <p>
          Chapel relies on the donations of churches and individuals to fund it’s ministry. If you feel called to give to this movement, please click the image below.
        </p>
        <a href="https://www.youthunlimited.com/donate/" target="_blank"><img class="give-link" src="/img/give-link.png" alt="Give to Chapel" title="Give to Chapel" /></a>
        <p>
          Greater Vancouver Youth Unlimited has come along side Chapel as it’s grown and provided guidance, financial covering, and logistical support. To allow for donations to Chapel to be tax deductable, Youth Unlimited has graciously offered to process all the finances. One-time or monthly giving is done through the Youth Unlimited website under the program name “Chapel.”
        </p>
      </div><!-- end of right -->
    </div><!-- end of content -->

    <?php require_once('../inc/social.inc'); ?>
<?php require_once('../inc/footer.inc'); ?>
