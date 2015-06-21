<?php
  require_once('conn.inc');
	$base_url = 'http://' . getenv('HTTP_HOST');


  try {
    global $db;
    $db = new PDO('mysql:host=localhost;dbname='. $db_name, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  } 
  catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

  // get the time of the next chapel (use Vancouver as the default).
  $next_chapel = $db->prepare("SELECT date FROM common UNION SELECT date FROM vancouver WHERE date >= CURDATE() ORDER BY date ASC LIMIT 1;");
  $next_chapel->execute();
  $next_chapel = strtotime($next_chapel->fetch()['date']);

  /**
   * Return a list of upcoming chapels for a given location.
   */
  function upcoming_chapels($location) {
    global $db;
    $query = $db->prepare("SELECT * FROM common WHERE date >= CURDATE() UNION SELECT * FROM " . $location . " WHERE date >= CURDATE() ORDER BY date ASC;");
    $query->execute();
    return $query->fetchAll();
  }
