<?php
  require_once('conn.inc');

	$base_url = 'http://' . getenv('HTTP_HOST');
  $description = "Chapel is a monthly Friday night worship event for high school youth and young adult leaders, presented by Youth Unlimited, with locations in Vancouver, the North Shore and the Tri-cities. Chapel's mission is to invite and unite a generation of young people to see God move in our city; to create a movement, not a moment. Through passionate worship, inspiring and convicting messages, and a community of awesome people, we are taking a bold stand for Jesus as one voice. #chapelmvmt";

  try {
    global $db;
    $db = new PDO('mysql:host=localhost;dbname='. $db_name, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  } 
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

  date_default_timezone_set('America/Vancouver');
  
  // get the time of the next chapel (use Vancouver as the default).
  $next_chapel = $db->prepare("SELECT date FROM common WHERE date >= CURDATE() UNION SELECT date FROM vancouver WHERE date >= CURDATE() ORDER BY date ASC LIMIT 1;");
  $next_chapel->execute();
  $next_chapel = strtotime($next_chapel->fetch()['date']);

  /**
   * Return a list of upcoming chapels for a given location.
   */
  function upcoming_chapels($location) {
    global $db;
    $query = $db->prepare("SELECT * FROM common WHERE date >= CURDATE() UNION SELECT * FROM `" . $location . "` WHERE date >= CURDATE() ORDER BY date ASC;");
    $query->execute();
    return $query->fetchAll();
  }
