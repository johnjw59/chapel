<?php 
  require_once('../inc/init.inc');

  $title = 'Contact | Chapel';
  $background_image = '/img/back_contact.jpg';
  
  require_once('../inc/header.inc');
  require_once('../inc/nav.inc');

  require_once("../inc/mail_form.inc");
?>
  
    <div id="contact" class="content clearfix">
      <div class="pane-left">
        <img class="title" src="/img/text-contact.png" alt="Contact" />
      </div>

      <div class="pane-right">
        <p>
          We'd love to hear from you! Please fill out the form below to send us a message.
        </p>
        <?php
          if (!empty($error_msg)) {
            echo '<p class="error">ERROR: '. implode("<br />", $error_msg) . "</p>";
          }
          if ($result != NULL) {
            echo '<p class="success">'. $result . "</p>";
          }
        ?>
        <form action="<?php echo basename(__FILE__); ?>" method="post">
          <noscript>
            <input type="hidden" name="nojs" id="nojs" />
          </noscript>

          <label for="name">Name</label><br />
          <input type="text" style="width:300px;" name="name" id="name" required><br />
        
          <label for="email">E-mail</label><br />
          <input type="text" style="width:300px;" name="email" id="email" required><br />
        
          <label for="comments">Message</label><br />
          <textarea name="comments" id="comments" rows="8" cols="50" style="width:530px" required></textarea><br />

          <input type="submit" name="submit" id="submit" value="Send" <?php if (isset($disable) && $disable === true) echo ' disabled="disabled"'; ?> />
        </form>
      </div><!-- end of right -->
    </div><!-- end of content -->

    <?php require_once('../inc/social.inc'); ?>
<?php require_once('../inc/footer.inc'); ?>
