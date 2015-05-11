<?php
//Query Facebook to get the like and comment counts

//Get Access Token from settings file
require_once( '../fbfeed-settings.php' );

if ( empty($settings['access_token']) || $settings['access_token'] == 'OPTIONAL_ACCESS_TOKEN_HERE' ){
    $access_token = '282595515249010|6WgldrfrkAB3R4pQQ3gw8sBB17M';
} else {
    $access_token = $settings['access_token'];
}


//Get Post ID
$post_id = $_GET['id'];

//Which meta type should we query?
$metaType = $_GET['type'];
if ($metaType == 'likes'){
    $row = 'like_info';
    $cell = 'like_count';
} else if ($metaType == 'comments'){
    $row = 'comment_info';
    $cell = 'comment_count';
}

//Make the request
$json_object = fetchUrl("https://graph.facebook.com/fql?q=SELECT%20" . $row . "%20FROM%20stream%20WHERE%20post_id='" . $post_id . "'%20&access_token=" . $access_token);
$FBdata = json_decode($json_object);
foreach ($FBdata->data as $news ){
	echo $news->$row->$cell;
}

//Get JSON object of feed data
function fetchUrl($url){
    //Can we use cURL?
    if(is_callable('curl_init')){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate,sdch');

        $feedData = curl_exec($ch);
        curl_close($ch);
    //If not then use file_get_contents
    } elseif ( ini_get( 'allow_url_fopen' ) || ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    }
    
    return $feedData;
}
?>