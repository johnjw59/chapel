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



  // Below are the global database accessing functions.

  /**
   * Return a list of upcoming chapels for a given location.
   */
  function upcoming_chapels($location) {
    global $db;

    $query = $db->prepare("SELECT * FROM common UNION SELECT * FROM " . $location . " WHERE date >= CURDATE() ORDER BY date ASC;");
    $query->execute();
    return $query->fetchAll();
  }

  /**
   * Return a Chapel event.
   */
  function get_chapel($location, $date) {
    global $db;

    $query = $db->prepare("SELECT * FROM " . $location . " WHERE date = :date;");
    $query->execute(array(':date' => $date));
    return $query->fetchAll();
  }

  /**
   * Add an event link to a given Chapel.
   */
  function add_event_link($location, $date, $link) {
    global $db;

    $query = $db->prepare("UPDATE " . $location . " SET event_link = :link WHERE date = :date;");
    $query->execute(array(':date' => $date, ':link' => $link));
  }
