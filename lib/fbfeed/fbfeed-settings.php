<?php

//------------------------------------------------------------------//
//************ Custom Facebook Feed Standalone Settings ************//
//------------------------------------------------------------------//

$settings = array(

    //*************************//
    //******CONFIGURATION******//
    //*************************//

    // Enter your license key below. Lost your license? Contact Smash Balloon at http://smashballoon.com/custom-facebook-feed/support
    'license'           => 'cff1952cd1d3e86e07e8c402a734d7d6',

    // Optional: Enter your Facebook Access Token below. If you don't have an Access Token then you can get one by following these simple steps: https://smashballoon.com/custom-facebook-feed/docs/get-extended-facebook-user-access-token/
    //'access_token'      => '1462674247346980|PWlbH1jrRTu8XlbpRi2t5LeGJw8',

    // Set the Page ID of the Facebook page you want to display below. Make sure to include the quote marks around it.
    // For information on how to find your Page ID go to http://smashballoon.com/custom-facebook-feed/id/
    'id'                => 'YOUR_FACEBOOK_PAGE_ID_HERE',

    // Is the Facebook feed from a page or a group?
    'pagetype'          => 'group',  // 'page' or 'group'


    //*************************//
    //*****CUSTOM SETTINGS*****//
    //*************************//

    /*
       Define any optional custom settings below.
       For a list of all settings please refer to: http://smashballoon.com/custom-facebook-feed/docs/standalone-settings/

       An example of how to change the layout and number of posts is below:
    */

    'layout' => 'full',
    'number' => '10',

    //***END CUSTOM SETTINGS***//

    // Don't remove the line below. It is required.
    'path'              => isset($fbfeed_path) ? $fbfeed_path : ''
);

// Include the file which generates the feed
if (isset($fbfeed_path)) include $fbfeed_path . '/core/custom-facebook-feed.php';

// Don't display error messages. To debug comment out the line below.
error_reporting(0);

// Uncommment the line below to show your system info settings
// cff_system_info();
?>

