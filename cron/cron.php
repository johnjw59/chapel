<?php
  require_once('../inc/init.inc');
  define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook-sdk/src/Facebook/');
  require 'facebook-sdk/autoload.php';

  use Facebook\FacebookSession;
  use Facebook\FacebookRequest;
  use Facebook\GraphUser;

  FacebookSession::setDefaultApplication('1462674247346980', '5c62d346046db776b35c7e6493d6a7a4');
  $session = new FacebookSession($fb_access);

  $me = (new FacebookRequest(
          $session, 'GET', '/me'
        ))->execute()->getGraphObject(GraphUser::className());

  var_dump($me);

?>
