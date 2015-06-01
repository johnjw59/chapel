<?php
  /**
   * Check my facebook events for new Chapels and add the link to the database.
   */
  require_once('../inc/init.inc');
  define('FACEBOOK_SDK_V4_SRC_DIR', 'facebook-sdk/src/Facebook/');
  require 'facebook-sdk/autoload.php';

  use Facebook\FacebookSession;
  use Facebook\FacebookRequest;
  use Facebook\GraphUser;

  FacebookSession::setDefaultApplication('1462674247346980', '5c62d346046db776b35c7e6493d6a7a4');
  $session = new FacebookSession($fb_access);

  // Have to get three kinds of events as Facebook stores them differently.
  // Get events I'm going to.
  $events_going = (new FacebookRequest(
          $session, 'GET', '/me/events'
        ))->execute()->getGraphObject(GraphUser::className())->asArray();
  $events_going = isset($events_going['data']) ? $events_going['data'] : array();

  // Get events I haven't replied to.
  $events_not_replied = (new FacebookRequest(
          $session, 'GET', '/me/events/not_replied'
        ))->execute()->getGraphObject(GraphUser::className())->asArray();
  $events_not_replied = isset($events_not_replied['data']) ? $events_not_replied['data'] : array();

  // Get events I've declined.
  $events_declined = (new FacebookRequest(
          $session, 'GET', '/me/events/declined'
        ))->execute()->getGraphObject(GraphUser::className())->asArray();
  $events_declined = isset($events_declined['data']) ? $events_declined['data'] : array();

  $events = array_merge($events_going, $events_not_replied, $events_declined);

  /**
   * For each event, if it's a Chapel event, 
   * add the link to the correct table entry if it doesn't already have a one.
   */
  foreach ($events as $event) {
    // Get the actual event object.
    $full_event = (new FacebookRequest(
          $session, 'GET', '/' . $event->id
        ))->execute()->getGraphObject(GraphUser::className())->asArray();

    // Only bother with open events.
    if ($full_event['privacy'] == 'OPEN') {

      if (stripos($event->name, 'chapel') !== FALSE) {
        // Facebook gives the dates in ISO8601 format.
        $date = DateTime::createFromFormat(DateTime::ISO8601, $event->start_time, new DateTimeZone('America/Vancouver'))->format('Y-m-d H:i:s');

        if ((stripos($event->name, 'vancouver') !== FALSE) || ($full_event['owner']->id == 605979937523)) {
          $chapel = get_chapel('vancouver', $date);
          if (!empty($chapel) && !($chapel['0']['event_link'])) {
            log_event('Added link (' . $event->id . ') to Vancouver event on ' . $date);
            add_event_link('vancouver', $date, 'http://facebook.com/' . $event->id);
          }
          else {
            log_event('Event ' . $event_id . 'already has a link or doesn\'t exist in database (looked in Vancouver).');
          }          
        }
        else if ((stripos($event->name, 'north shore') !== FALSE) || ($full_event['owner']->id == 10152645041594361)) {
          $chapel = get_chapel('north_shore', $date);
          if (!empty($chapel) && !($chapel['0']['event_link'])) {
            log_event('Added link (' . $event->id . ') to North Shore event on ' . $date);
            add_event_link('north_shore', $date, 'http://facebook.com/' . $event->id);
          }
          else {
            log_event('Event ' . $event_id . 'already has a link or doesn\'t exist in database (looked in North Shore).');
          }
        }
        else if (stripos($event->name, 'tri-cities') !== FALSE) {
          $chapel = get_chapel('tri-cities', $date);
          if (!empty($chapel) && !($chapel['0']['event_link'])) {
            log_event('Added link (' . $event->id . ') to Tri-cities event on ' . $date);
            add_event_link('tri-cities', $date, 'http://facebook.com/' . $event->id);
          }
          else {
            log_event('Event ' . $event_id . 'already has a link or doesn\'t exist in database (looked in Tri-cities).');
          }
        }
        // If the event is made by the Chapel page, it's common.
        else if ($full_event['owner']->id == 172092896224624) {
          $chapel = get_chapel('common', $date);
          if (!empty($chapel) && !($chapel['0']['event_link'])) {
            log_event('Added link (' . $event->id . ') to Common event on ' . $date);
            add_event_link('common', $date, 'http://facebook.com/' . $event->id);
          }
          else {
            log_event('Event ' . $event_id . 'already has a link or doesn\'t exist in database (looked in Common).');
          }
        } 
      }

    }
  }

  /**
   * Log successful cron job.
   */
  function log_event($message) {
    if ($message != '') {
        // Add a timestamp to the start of the $message
        $message = date("Y/m/d H:i:s") . ': ' . $message;
        $fp = fopen('cron_log.txt', 'a');
        fwrite($fp, $message."\n");
        fclose($fp);
    }
  }

?>
