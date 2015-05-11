<?php 
  require_once('../inc/init.inc');

  $title = 'Contact | Chapel';
  $background_image = $base_url . '/img/back_contact.jpg';
  
  require_once('../inc/header.inc');
  require_once('../inc/nav.inc');
?>
  
    <div id="contact" class="content clearfix">
      <div class="left">
        <img class="title" src="<?php echo($base_url); ?>/img/text-contact.png" alt="Contact" />
      </div>

      <div class="right">
        <p>
          Under Contruction.
        </p>
        <p>
          Please send all inquiries to <a href="mailto:chapelvancouver&#64;gmail&#46;com" target="_blank">chapelvancouver&#64;gmail&#46;com</a> in the meantime.
        </p>
      </div><!-- end of right -->
    </div><!-- end of content -->

    <?php require_once('../inc/social.inc'); ?>
<?php require_once('../inc/footer.inc'); ?>