<?php
  require_once('conn.inc');
	$base_url = 'http://' . getenv('HTTP_HOST');

  $next_chapel = $db->prepare("SELECT date FROM common UNION SELECT date FROM vancouver WHERE date >= CURDATE() ORDER BY date ASC LIMIT 1;");
  $next_chapel->execute();
  $next_chapel = strtotime($next_chapel->fetch()['date']);
