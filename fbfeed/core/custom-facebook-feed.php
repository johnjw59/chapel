<?php

/*================== Custom Facebook Feed Standalone ===================

Author: Smash Balloon
Support Website: http://smashballoon.com/custom-facebook-feed/support
Version: 2.0
Copyright: Smash Balloon
License: Non-distributable, not for resale

*/
include 'cff_autolink.php';
function fbFeed($settings, $custom) {

    $cff_license  = $settings[ 'license' ];

    //***CONFIGURATION***//
    $default_token = '282595515249010|6WgldrfrkAB3R4pQQ3gw8sBB17M';
    isset($custom['access_token']) ? $access_token = trim($custom[ 'access_token' ]) : ( isset( $settings[ 'access_token' ] ) ? $access_token = trim($settings[ 'access_token' ]) : $access_token = $default_token );
    if( $settings[ 'access_token' ] == 'OPTIONAL_ACCESS_TOKEN_HERE' ) $access_token = $default_token;
    isset($custom['id']) ? $page_id = trim($custom[ 'id' ]) : $page_id = trim($settings[ 'id' ]);

    //Is the page type set in $custom? If not then is it set in $settings? If not then defaults to 'page'.
    isset($custom['pagetype']) ? $cff_page_type = $custom[ 'pagetype' ] : (isset($settings['pagetype']) ? $cff_page_type = $settings[ 'pagetype' ] : $cff_page_type = 'page');
    isset($custom['number']) ? $show_posts = $custom[ 'number' ] : (isset($settings['number']) ? $show_posts = $settings[ 'number' ] : $show_posts = 25);
    isset($custom['limit']) ? $cff_post_limit = $custom[ 'limit' ] : (isset($settings['limit']) ? $cff_post_limit = $settings[ 'limit' ] : $cff_post_limit = 25);
    isset($custom['showothers']) ? $show_others = $custom[ 'showothers' ] : (isset($settings['showothers']) ? $show_others = $settings[ 'showothers' ] : $show_others = false);

    isset($custom['showpostsby']) ? $show_posts_by = $custom[ 'showpostsby' ] : (isset($settings['showpostsby']) ? $show_posts_by = $settings[ 'showpostsby' ] : $show_posts_by = 'me');
    isset($custom['locale']) ? $cff_locale = $custom[ 'locale' ] : (isset($settings['locale']) ? $cff_locale = $settings[ 'locale' ] : $cff_locale = 'en_US');
    isset($custom['ajax']) ? $cff_ajax = $custom[ 'ajax' ] : (isset($settings['ajax']) ? $cff_ajax = $settings[ 'ajax' ] : $cff_ajax = false);
    isset($custom['ssl']) ? $cff_ssl = $custom[ 'ssl' ] : (isset($settings['ssl']) ? $cff_ssl = $settings[ 'ssl' ] : $cff_ssl = false);


    //***LAYOUT & STYLE SETTINGS***//
    isset($custom['width']) ? $cff_feed_width = $custom[ 'width' ] : (isset($settings['width']) ? $cff_feed_width = $settings[ 'width' ] : $cff_feed_width = '');
    isset($custom['height']) ? $cff_feed_height = $custom[ 'height' ] : (isset($settings['height']) ? $cff_feed_height = $settings[ 'height' ] : $cff_feed_height = '');
    isset($custom['padding']) ? $cff_feed_padding = $custom[ 'padding' ] : (isset($settings['padding']) ? $cff_feed_padding = $settings[ 'padding' ] : $cff_feed_padding = '');
    isset($custom['bgcolor']) ? $cff_bg_color = $custom[ 'bgcolor' ] : (isset($settings['bgcolor']) ? $cff_bg_color = $settings[ 'bgcolor' ] : $cff_bg_color = '');
    isset($custom['showauthor']) ? $cff_show_author_new = $custom[ 'showauthor' ] : (isset($settings['showauthor']) ? $cff_show_author_new = $settings[ 'showauthor' ] : $cff_show_author_new = '');
    isset($custom['class']) ? $cff_class = $custom[ 'class' ] : (isset($settings['class']) ? $cff_class = $settings[ 'class' ] : $cff_class = '');
    isset($custom['eventsource']) ? $cff_events_source = $custom[ 'eventsource' ] : (isset($settings['eventsource']) ? $cff_events_source = $settings[ 'eventsource' ] : $cff_events_source = 'eventspage');
    isset($custom['eventoffset']) ? $cff_event_offset = $custom[ 'eventoffset' ] : (isset($settings['eventoffset']) ? $cff_event_offset = $settings[ 'eventoffset' ] : $cff_event_offset = 6);
    isset($custom['eventimage']) ? $cff_event_image_size = $custom[ 'eventimage' ] : (isset($settings['eventimage']) ? $cff_event_image_size = $settings[ 'eventimage' ] : $cff_event_image_size = 'full');
    isset($custom['filter']) ? $cff_filter_string = $custom[ 'filter' ] : (isset($settings['filter']) ? $cff_filter_string = $settings[ 'filter' ] : $cff_filter_string = '');
    isset($custom['exfilter']) ? $cff_exclude_string = $custom[ 'exfilter' ] : (isset($settings['exfilter']) ? $cff_exclude_string = $settings[ 'exfilter' ] : $cff_exclude_string = '');

    //PHOTOS ONLY
    isset($custom['photosource']) ? $cff_photos_source = $custom[ 'photosource' ] : (isset($settings['photosource']) ? $cff_photos_source = $settings[ 'photosource' ] : $cff_photos_source = 'timeline');
    isset($custom['photocols']) ? $cff_photos_cols = $custom[ 'photocols' ] : (isset($settings['photocols']) ? $cff_photos_cols = $settings[ 'photocols' ] : $cff_photos_cols = '1');

    //ALBUMS ONLY
    isset($custom['albumsource']) ? $cff_albums_source = $custom[ 'albumsource' ] : (isset($settings['albumsource']) ? $cff_albums_source = $settings[ 'albumsource' ] : $cff_albums_source = 'photospage');
    isset($custom['albumcols']) ? $cff_album_cols = $custom[ 'albumcols' ] : (isset($settings['albumcols']) ? $cff_album_cols = $settings[ 'albumcols' ] : $cff_album_cols = '1');
    isset($custom['showalbumtitle']) ? $cff_show_album_title = $custom[ 'showalbumtitle' ] : (isset($settings['showalbumtitle']) ? $cff_show_album_title = $settings[ 'showalbumtitle' ] : $cff_show_album_title = true);
    isset($custom['showalbumnum']) ? $cff_show_album_number = $custom[ 'showalbumnum' ] : (isset($settings['showalbumnum']) ? $cff_show_album_number = $settings[ 'showalbumnum' ] : $cff_show_album_number = true);

    //***POST LAYOUT***
    isset($custom['layout']) ? $cff_preset_layout = $custom[ 'layout' ] : (isset($settings['layout']) ? $cff_preset_layout = $settings[ 'layout' ] : $cff_preset_layout = 'thumb');
    isset($custom['enablenarrow']) ? $cff_enable_narrow = $custom[ 'enablenarrow' ] : (isset($settings['enablenarrow']) ? $cff_enable_narrow = $settings[ 'enablenarrow' ] : $cff_enable_narrow = true);
    ( ($cff_enable_narrow == 'true' || $cff_enable_narrow == true) && $cff_enable_narrow !== 'false' ) ? $cff_enable_narrow = true : $cff_enable_narrow = false;
    isset($custom['mediaposition']) ? $cff_media_position = $custom[ 'mediaposition' ] : (isset($settings['mediaposition']) ? $cff_media_position = $settings[ 'mediaposition' ] : $cff_media_position = 'below');

    //***POST TYPES***
    isset($custom['type']) ? $cff_type = $custom[ 'type' ] : (isset($settings['type']) ? $cff_type = $settings[ 'type' ] : $cff_type = 'status,events,videos,photos,links,albums');
    //Set to false by default
    $cff_show_links_type = false;
    $cff_show_event_type = false;
    $cff_show_video_type = false;
    $cff_show_photos_type = false;
    $cff_show_status_type = false;
    $cff_show_albums_type = false;
    //Look for non-plural version of string in the types string in case user specifies singular in settings
    if ( stripos($cff_type, 'link') !== false ) $cff_show_links_type = true;
    if ( stripos($cff_type, 'event') !== false ) $cff_show_event_type = true;
    if ( stripos($cff_type, 'video') !== false ) $cff_show_video_type = true;
    if ( stripos($cff_type, 'photo') !== false ) $cff_show_photos_type = true;
    if ( stripos($cff_type, 'status') !== false ) $cff_show_status_type = true;
    if ( stripos($cff_type, 'album') !== false ) $cff_show_albums_type = true;

    //***POST INCLUDES***
    isset($custom['include']) ? $cff_includes = $custom[ 'include' ] : (isset($settings['include']) ? $cff_includes = $settings[ 'include' ] : $cff_includes = 'author,text,desc,sharedlinks,date,media,eventtitle,eventdetails,social,link,likebox');
    //Look for non-plural version of string in the types string in case user specifies singular in settings
    $cff_show_author = false;
    $cff_show_text = false;
    $cff_show_desc = false;
    $cff_show_shared_links = false;
    $cff_show_date = false;
    $cff_show_media = false;
    $cff_show_event_title = false;
    $cff_show_event_details = false;
    $cff_show_meta = false;
    $cff_show_link = false;
    $cff_show_like_box = false;
    if ( stripos($cff_includes, 'author') !== false ) $cff_show_author = true;
    if ( stripos($cff_includes, 'text') !== false ) $cff_show_text = true;
    if ( stripos($cff_includes, 'desc') !== false ) $cff_show_desc = true;
    if ( stripos($cff_includes, 'sharedlink') !== false ) $cff_show_shared_links = true;
    if ( stripos($cff_includes, 'date') !== false ) $cff_show_date = true;
    if ( stripos($cff_includes, 'media') !== false ) $cff_show_media = true;
    if ( stripos($cff_includes, 'eventtitle') !== false ) $cff_show_event_title = true;
    if ( stripos($cff_includes, 'eventdetail') !== false ) $cff_show_event_details = true;
    if ( stripos($cff_includes, 'social') !== false ) $cff_show_meta = true;
    if ( stripos($cff_includes, ',link') !== false ) $cff_show_link = true;
    if ( stripos($cff_includes, 'like') !== false ) $cff_show_like_box = true;
    
    //Exclude
    isset($custom['exclude']) ? $cff_excludes = $custom[ 'exclude' ] : (isset($settings['exclude']) ? $cff_excludes = $settings[ 'exclude' ] : $cff_excludes = '');
    //Look for non-plural version of string in the types string in case user specifies singular in shortcode
    if ( stripos($cff_excludes, 'author') !== false ) $cff_show_author = false;
    if ( stripos($cff_excludes, 'text') !== false ) $cff_show_text = false;
    if ( stripos($cff_excludes, 'desc') !== false ) $cff_show_desc = false;
    if ( stripos($cff_excludes, 'sharedlink') !== false ) $cff_show_shared_links = false;
    if ( stripos($cff_excludes, 'date') !== false ) $cff_show_date = false;
    if ( stripos($cff_excludes, 'media') !== false ) $cff_show_media = false;
    if ( stripos($cff_excludes, 'eventtitle') !== false ) $cff_show_event_title = false;
    if ( stripos($cff_excludes, 'eventdetail') !== false ) $cff_show_event_details = false;
    if ( stripos($cff_excludes, 'social') !== false ) $cff_show_meta = false;
    if ( stripos($cff_excludes, ',link') !== false ) $cff_show_link = false;
    if ( stripos($cff_excludes, 'like') !== false ) $cff_show_like_box = false;

    //*Post Styling*
    isset($custom['postbgcolor']) ? $cff_post_bg_color = $custom[ 'postbgcolor' ] : (isset($settings['postbgcolor']) ? $cff_post_bg_color = $settings[ 'postbgcolor' ] : $cff_post_bg_color = '');
    isset($custom['postcorners']) ? $cff_post_rounded = $custom[ 'postcorners' ] : (isset($settings['postcorners']) ? $cff_post_rounded = $settings[ 'postcorners' ] : $cff_post_rounded = '0');


    //***TYPOGRAPHY***
    //*Text limits*
    isset($custom['textlength']) ? $title_limit = $custom[ 'textlength' ] : (isset($settings['textlength']) ? $title_limit = $settings[ 'textlength' ] : $title_limit = 99999);
    isset($custom['desclength']) ? $body_limit = $custom[ 'desclength' ] : (isset($settings['desclength']) ? $body_limit = $settings[ 'desclength' ] : $body_limit = 99999);

    //*Author*
    isset($custom['authorsize']) ? $cff_author_size = $custom[ 'authorsize' ] : (isset($settings['authorsize']) ? $cff_author_size = $settings[ 'authorsize' ] : $cff_author_size = '');
    isset($custom['authorcolor']) ? $cff_author_color = $custom[ 'authorcolor' ] : (isset($settings['authorcolor']) ? $cff_author_color = $settings[ 'authorcolor' ] : $cff_author_color = '');

    //*Post text*
    isset($custom['textformat']) ? $cff_title_format = $custom[ 'textformat' ] : (isset($settings['textformat']) ? $cff_title_format = $settings[ 'textformat' ] : $cff_title_format = '');
    isset($custom['textsize']) ? $cff_title_size = $custom[ 'textsize' ] : (isset($settings['textsize']) ? $cff_title_size = $settings[ 'textsize' ] : $cff_title_size = '');
    isset($custom['textweight']) ? $cff_title_weight = $custom[ 'textweight' ] : (isset($settings['textweight']) ? $cff_title_weight = $settings[ 'textweight' ] : $cff_title_weight = '');
    isset($custom['textcolor']) ? $cff_title_color = $custom[ 'textcolor' ] : (isset($settings['textcolor']) ? $cff_title_color = $settings[ 'textcolor' ] : $cff_title_color = '');
    isset($custom['textlink']) ? $cff_title_link = $custom[ 'textlink' ] : (isset($settings['textlink']) ? $cff_title_link = $settings[ 'textlink' ] : $cff_title_link = false);
    isset($custom['posttags']) ? $cff_post_tags = $custom[ 'posttags' ] : (isset($settings['posttags']) ? $cff_post_tags = $settings[ 'posttags' ] : $cff_post_tags = true);
    isset($custom['textlinkcolor']) ? $cff_posttext_link_color = $custom[ 'textlinkcolor' ] : (isset($settings['textlinkcolor']) ? $cff_posttext_link_color = $settings[ 'textlinkcolor' ] : $cff_posttext_link_color = '');
    isset($custom['linkhashtags']) ? $cff_link_hashtags = $custom[ 'linkhashtags' ] : (isset($settings['linkhashtags']) ? $cff_link_hashtags = $settings[ 'linkhashtags' ] : $cff_link_hashtags = true);



    //*Description text*
    isset($custom['descsize']) ? $cff_body_size = $custom[ 'descsize' ] : (isset($settings['descsize']) ? $cff_body_size = $settings[ 'descsize' ] : $cff_body_size = '12');
    isset($custom['descweight']) ? $cff_body_weight = $custom[ 'descweight' ] : (isset($settings['descweight']) ? $cff_body_weight = $settings[ 'descweight' ] : $cff_body_weight = '');
    isset($custom['desccolor']) ? $cff_body_color = $custom[ 'desccolor' ] : (isset($settings['desccolor']) ? $cff_body_color = $settings[ 'desccolor' ] : $cff_body_color = '');

    //*Shared link box*
    isset($custom['linktitleformat']) ? $cff_link_title_format = $custom[ 'linktitleformat' ] : (isset($settings['linktitleformat']) ? $cff_link_title_format = $settings[ 'linktitleformat' ] : $cff_link_title_format = 'p');
    isset($custom['linktitlesize']) ? $cff_link_title_size = $custom[ 'linktitlesize' ] : (isset($settings['linktitlesize']) ? $cff_link_title_size = $settings[ 'linktitlesize' ] : $cff_link_title_size = '');
    isset($custom['linktitlecolor']) ? $cff_link_title_color = $custom[ 'linktitlecolor' ] : (isset($settings['linktitlecolor']) ? $cff_link_title_color = $settings[ 'linktitlecolor' ] : $cff_link_title_color = '');
    isset($custom['linkurlcolor']) ? $cff_link_url_color = $custom[ 'linkurlcolor' ] : (isset($settings['linkurlcolor']) ? $cff_link_url_color = $settings[ 'linkurlcolor' ] : $cff_link_url_color = '');
    isset($custom['linkbgcolor']) ? $cff_link_bg_color = $custom[ 'linkbgcolor' ] : (isset($settings['linkbgcolor']) ? $cff_link_bg_color = $settings[ 'linkbgcolor' ] : $cff_link_bg_color = '');
    isset($custom['linkbordercolor']) ? $cff_link_border_color = $custom[ 'linkbordercolor' ] : (isset($settings['linkbordercolor']) ? $cff_link_border_color = $settings[ 'linkbordercolor' ] : $cff_link_border_color = '');
    isset($custom['disablelinkbox']) ? $cff_disable_link_box = $custom[ 'disablelinkbox' ] : (isset($settings['disablelinkbox']) ? $cff_disable_link_box = $settings[ 'disablelinkbox' ] : $cff_disable_link_box = false);
    ( ($cff_disable_link_box == 'true' || $cff_disable_link_box == true) && $cff_disable_link_box !== 'false' ) ? $cff_disable_link_box = true : $cff_disable_link_box = false;

    //*Event title*
    isset($custom['eventtitleformat']) ? $cff_event_title_format = $custom[ 'eventtitleformat' ] : (isset($settings['eventtitleformat']) ? $cff_event_title_format = $settings[ 'eventtitleformat' ] : $cff_event_title_format = 'p');
    isset($custom['eventtitlesize']) ? $cff_event_title_size = $custom[ 'eventtitlesize' ] : (isset($settings['eventtitlesize']) ? $cff_event_title_size = $settings[ 'eventtitlesize' ] : $cff_event_title_size = '');
    isset($custom['eventtitleweight']) ? $cff_event_title_weight = $custom[ 'eventtitleweight' ] : (isset($settings['eventtitleweight']) ? $cff_event_title_weight = $settings[ 'eventtitleweight' ] : $cff_event_title_weight = '');
    isset($custom['eventtitlecolor']) ? $cff_event_title_color = $custom[ 'eventtitlecolor' ] : (isset($settings['eventtitlecolor']) ? $cff_event_title_color = $settings[ 'eventtitlecolor' ] : $cff_event_title_color = '');
    isset($custom['eventtitlelink']) ? $cff_event_title_link = $custom[ 'eventtitlelink' ] : (isset($settings['eventtitlelink']) ? $cff_event_title_link = $settings[ 'eventtitlelink' ] : $cff_event_title_link = false);
    //*Event details text*
    isset($custom['eventdetailssize']) ? $cff_event_details_size = $custom[ 'eventdetailssize' ] : (isset($settings['eventdetailssize']) ? $cff_event_details_size = $settings[ 'eventdetailssize' ] : $cff_event_details_size = '');
    isset($custom['eventdetailsweight']) ? $cff_event_details_weight = $custom[ 'eventdetailsweight' ] : (isset($settings['eventdetailsweight']) ? $cff_event_details_weight = $settings[ 'eventdetailsweight' ] : $cff_event_details_weight = '');
    isset($custom['eventdetailscolor']) ? $cff_event_details_color = $custom[ 'eventdetailscolor' ] : (isset($settings['eventdetailscolor']) ? $cff_event_details_color = $settings[ 'eventdetailscolor' ] : $cff_event_details_color = '');
    isset($custom['eventlinkcolor']) ? $cff_event_link_color = $custom[ 'eventlinkcolor' ] : (isset($settings['eventlinkcolor']) ? $cff_event_link_color = $settings[ 'eventlinkcolor' ] : $cff_event_link_color = '');

    //Event date
    isset($custom['eventdatesize']) ? $cff_event_date_size = $custom[ 'eventdatesize' ] : (isset($settings['eventdatesize']) ? $cff_event_date_size = $settings[ 'eventdatesize' ] : $cff_event_date_size = '');
    isset($custom['eventdateweight']) ? $cff_event_date_weight = $custom[ 'eventdateweight' ] : (isset($settings['eventdateweight']) ? $cff_event_date_weight = $settings[ 'eventdateweight' ] : $cff_event_date_weight = '');
    isset($custom['eventdatecolor']) ? $cff_event_date_color = $custom[ 'eventdatecolor' ] : (isset($settings['eventdatecolor']) ? $cff_event_date_color = $settings[ 'eventdatecolor' ] : $cff_event_date_color = '');
    isset($custom['eventdatepos']) ? $cff_event_date_position = $custom[ 'eventdatepos' ] : (isset($settings['eventdatepos']) ? $cff_event_date_position = $settings[ 'eventdatepos' ] : $cff_event_date_position = 'top');
    isset($custom['eventdateformat']) ? $cff_event_date_formatting = $custom[ 'eventdateformat' ] : (isset($settings['eventdateformat']) ? $cff_event_date_formatting = $settings[ 'eventdateformat' ] : $cff_event_date_formatting = 1);
    isset($custom['eventdatecustom']) ? $cff_event_date_custom = $custom[ 'eventdatecustom' ] : (isset($settings['eventdatecustom']) ? $cff_event_date_custom = $settings[ 'eventdatecustom' ] : $cff_event_date_custom = '');
    //*Post date*
    isset($custom['datepos']) ? $cff_date_position = $custom[ 'datepos' ] : (isset($settings['datepos']) ? $cff_date_position = $settings[ 'datepos' ] : $cff_date_position = 'author');
    isset($custom['datesize']) ? $cff_date_size = $custom[ 'datesize' ] : (isset($settings['datesize']) ? $cff_date_size = $settings[ 'datesize' ] : $cff_date_size = '');
    isset($custom['dateweight']) ? $cff_date_weight = $custom[ 'dateweight' ] : (isset($settings['dateweight']) ? $cff_date_weight = $settings[ 'dateweight' ] : $cff_date_weight = '');
    isset($custom['datecolor']) ? $cff_date_color = $custom[ 'datecolor' ] : (isset($settings['datecolor']) ? $cff_date_color = $settings[ 'datecolor' ] : $cff_date_color = '');
    isset($custom['dateformat']) ? $cff_date_formatting = $custom[ 'dateformat' ] : (isset($settings['dateformat']) ? $cff_date_formatting = $settings[ 'dateformat' ] : $cff_date_formatting = 1);
    isset($custom['datecustom']) ? $cff_date_custom = $custom[ 'datecustom' ] : (isset($settings['datecustom']) ? $cff_date_custom = $settings[ 'datecustom' ] : $cff_date_custom = '');
    isset($custom['beforedate']) ? $cff_date_before = $custom[ 'beforedate' ] : (isset($settings['beforedate']) ? $cff_date_before = $settings[ 'beforedate' ] : $cff_date_before = '');
    isset($custom['afterdate']) ? $cff_date_after = $custom[ 'afterdate' ] : (isset($settings['afterdate']) ? $cff_date_after = $settings[ 'afterdate' ] : $cff_date_after = '');
    isset($custom['timezone']) ? $cff_timezone = $custom[ 'timezone' ] : (isset($settings['timezone']) ? $cff_timezone = $settings[ 'timezone' ] : $cff_timezone = '');
    //*View on Facebook/View Link*
    isset($custom['linksize']) ? $cff_link_size = $custom[ 'linksize' ] : (isset($settings['linksize']) ? $cff_link_size = $settings[ 'linksize' ] : $cff_link_size = '');
    isset($custom['linkweight']) ? $cff_link_weight = $custom[ 'linkweight' ] : (isset($settings['linkweight']) ? $cff_link_weight = $settings[ 'linkweight' ] : $cff_link_weight = '');
    isset($custom['linkcolor']) ? $cff_link_color = $custom[ 'linkcolor' ] : (isset($settings['linkcolor']) ? $cff_link_color = $settings[ 'linkcolor' ] : $cff_link_color = '');

    //***LIKES, SHARES and COMMENTS***
    isset($custom['iconstyle']) ? $cff_icon_style = $custom[ 'iconstyle' ] : (isset($settings['iconstyle']) ? $cff_icon_style = $settings[ 'iconstyle' ] : $cff_icon_style = 'light');
    isset($custom['socialtextcolor']) ? $cff_meta_text_color = $custom[ 'socialtextcolor' ] : (isset($settings['socialtextcolor']) ? $cff_meta_text_color = $settings[ 'socialtextcolor' ] : $cff_meta_text_color = '');
    isset($custom['socialbgcolor']) ? $cff_meta_bg_color = $custom[ 'socialbgcolor' ] : (isset($settings['socialbgcolor']) ? $cff_meta_bg_color = $settings[ 'socialbgcolor' ] : $cff_meta_bg_color = '');
    isset($custom['sociallinkcolor']) ? $cff_meta_link_color = $custom[ 'sociallinkcolor' ] : (isset($settings['sociallinkcolor']) ? $cff_meta_link_color = $settings[ 'sociallinkcolor' ] : $cff_meta_link_color = '');



    isset($custom['expandcomments']) ? $cff_expand_comments = $custom[ 'expandcomments' ] : (isset($settings['expandcomments']) ? $cff_expand_comments = $settings[ 'expandcomments' ] : $cff_expand_comments = false);
    isset($custom['commentsnum']) ? $cff_comments_num = $custom[ 'commentsnum' ] : (isset($settings['commentsnum']) ? $cff_comments_num = $settings[ 'commentsnum' ] : $cff_comments_num = '4');
    isset($custom['hidecommentimages']) ? $cff_hide_comment_avatars = $custom[ 'hidecommentimages' ] : (isset($settings['hidecommentimages']) ? $cff_hide_comment_avatars = $settings[ 'hidecommentimages' ] : $cff_hide_comment_avatars = false);


    //***MISC***
    //*Like box*
    isset($custom['likeboxpos']) ? $cff_like_box_position = $custom[ 'likeboxpos' ] : (isset($settings['likeboxpos']) ? $cff_like_box_position = $settings[ 'likeboxpos' ] : $cff_like_box_position = 'bottom');
    isset($custom['likeboxoutside']) ? $cff_like_box_outside = $custom[ 'likeboxoutside' ] : (isset($settings['likeboxoutside']) ? $cff_like_box_outside = $settings[ 'likeboxoutside' ] : $cff_like_box_outside = false);
    isset($custom['likeboxcolor']) ? $cff_likebox_bg_color = $custom[ 'likeboxcolor' ] : (isset($settings['likeboxcolor']) ? $cff_likebox_bg_color = $settings[ 'likeboxcolor' ] : $cff_likebox_bg_color = '');
    isset($custom['likeboxtextcolor']) ? $cff_like_box_text_color = $custom[ 'likeboxtextcolor' ] : (isset($settings['likeboxtextcolor']) ? $cff_like_box_text_color = $settings[ 'likeboxtextcolor' ] : $cff_like_box_text_color = 'blue');
    isset($custom['likeboxwidth']) ? $cff_likebox_width = $custom[ 'likeboxwidth' ] : (isset($settings['likeboxwidth']) ? $cff_likebox_width = $settings[ 'likeboxwidth' ] : $cff_likebox_width = '');
    isset($custom['likeboxheight']) ? $cff_likebox_height = $custom[ 'likeboxheight' ] : (isset($settings['likeboxheight']) ? $cff_likebox_height = $settings[ 'likeboxheight' ] : $cff_likebox_height = '');
    isset($custom['likeboxfaces']) ? $cff_like_box_faces = $custom[ 'likeboxfaces' ] : (isset($settings['likeboxfaces']) ? $cff_like_box_faces = $settings[ 'likeboxfaces' ] : $cff_like_box_faces = false);
    isset($custom['likeboxborder']) ? $cff_like_box_border = $custom[ 'likeboxborder' ] : (isset($settings['likeboxborder']) ? $cff_like_box_border = $settings[ 'likeboxborder' ] : $cff_like_box_border = false);

    //*Page Header*
    isset($custom['showheader']) ? $cff_show_header = $custom[ 'showheader' ] : (isset($settings['showheader']) ? $cff_show_header = $settings[ 'showheader' ] : $cff_show_header = '');
    isset($custom['headeroutside']) ? $cff_header_outside = $custom[ 'headeroutside' ] : (isset($settings['headeroutside']) ? $cff_header_outside = $settings[ 'headeroutside' ] : $cff_header_outside = false);
    isset($custom['headertext']) ? $cff_header_text = $custom[ 'headertext' ] : (isset($settings['headertext']) ? $cff_header_text = $settings[ 'headertext' ] : $cff_header_text = 'Facebook Feed');
    isset($custom['headerbg']) ? $cff_header_bg_color = $custom[ 'headerbg' ] : (isset($settings['headerbg']) ? $cff_header_bg_color = $settings[ 'headerbg' ] : $cff_header_bg_color = '');
    isset($custom['headerpadding']) ? $cff_header_padding = $custom[ 'headerpadding' ] : (isset($settings['headerpadding']) ? $cff_header_padding = $settings[ 'headerpadding' ] : $cff_header_padding = '');
    isset($custom['headertextsize']) ? $cff_header_text_size = $custom[ 'headertextsize' ] : (isset($settings['headertextsize']) ? $cff_header_text_size = $settings[ 'headertextsize' ] : $cff_header_text_size = '');
    isset($custom['headertextweight']) ? $cff_header_text_weight = $custom[ 'headertextweight' ] : (isset($settings['headertextweight']) ? $cff_header_text_weight = $settings[ 'headertextweight' ] : $cff_header_text_weight = '');
    isset($custom['headertextcolor']) ? $cff_header_text_color = $custom[ 'headertextcolor' ] : (isset($settings['headertextcolor']) ? $cff_header_text_color = $settings[ 'headertextcolor' ] : $cff_header_text_color = '');
    isset($custom['headericon']) ? $cff_header_icon = $custom[ 'headericon' ] : (isset($settings['headericon']) ? $cff_header_icon = $settings[ 'headericon' ] : $cff_header_icon = 'none');
    isset($custom['headericoncolor']) ? $cff_header_icon_color = $custom[ 'headericoncolor' ] : (isset($settings['headericoncolor']) ? $cff_header_icon_color = $settings[ 'headericoncolor' ] : $cff_header_icon_color = '');
    isset($custom['headericonsize']) ? $cff_header_icon_size = $custom[ 'headericonsize' ] : (isset($settings['headericonsize']) ? $cff_header_icon_size = $settings[ 'headericonsize' ] : $cff_header_icon_size = '28');


    //Video
    isset($custom['videoaction']) ? $cff_video_action = $custom[ 'videoaction' ] : (isset($settings['videoaction']) ? $cff_video_action = $settings[ 'videoaction' ] : $cff_video_action = 'playvideo');
    //*Separating line
    isset($custom['sepcolor']) ? $cff_sep_color = $custom[ 'sepcolor' ] : (isset($settings['sepcolor']) ? $cff_sep_color = $settings[ 'sepcolor' ] : $cff_sep_color = '');
    isset($custom['sepsize']) ? $cff_sep_size = $custom[ 'sepsize' ] : (isset($settings['sepsize']) ? $cff_sep_size = $settings[ 'sepsize' ] : $cff_sep_size = 1);

    //***CUSTOM TEXT / TRANSLATE***
    isset($custom['seemoretext']) ? $cff_see_more_text = $custom[ 'seemoretext' ] : (isset($settings['seemoretext']) ? $cff_see_more_text = $settings[ 'seemoretext' ] : $cff_see_more_text = 'See more');
    isset($custom['seelesstext']) ? $cff_see_less_text = $custom[ 'seelesstext' ] : (isset($settings['seelesstext']) ? $cff_see_less_text = $settings[ 'seelesstext' ] : $cff_see_less_text = 'See less');
    isset($custom['facebooklinktext']) ? $cff_facebook_link_text = $custom[ 'facebooklinktext' ] : (isset($settings['facebooklinktext']) ? $cff_facebook_link_text = $settings[ 'facebooklinktext' ] : $cff_facebook_link_text = 'View on Facebook');
    isset($custom['maptext']) ? $cff_map_text = $custom[ 'maptext' ] : (isset($settings['maptext']) ? $cff_map_text = $settings[ 'maptext' ] : $cff_map_text = 'Map');
    isset($custom['buyticketstext']) ? $cff_buy_tickets_text = $custom[ 'buyticketstext' ] : (isset($settings['buyticketstext']) ? $cff_buy_tickets_text = $settings[ 'buyticketstext' ] : $cff_buy_tickets_text = 'Buy tickets');
    //Translate - social
    isset($custom['previouscommentstext']) ? $cff_translate_view_previous_comments_text = $custom[ 'previouscommentstext' ] : (isset($settings['previouscommentstext']) ? $cff_translate_view_previous_comments_text = $settings[ 'previouscommentstext' ] : $cff_translate_view_previous_comments_text = 'View previous comments');
    isset($custom['commentonfacebooktext']) ? $cff_translate_comment_on_facebook_text = $custom[ 'commentonfacebooktext' ] : (isset($settings['commentonfacebooktext']) ? $cff_translate_comment_on_facebook_text = $settings[ 'commentonfacebooktext' ] : $cff_translate_comment_on_facebook_text = 'Comment on Facebook');
    isset($custom['photostext']) ? $cff_translate_photos_text = $custom[ 'photostext' ] : (isset($settings['photostext']) ? $cff_translate_photos_text = $settings[ 'photostext' ] : $cff_translate_photos_text = 'photos');
    isset($custom['likesthistext']) ? $cff_translate_likes_this_text = $custom[ 'likesthistext' ] : (isset($settings['likesthistext']) ? $cff_translate_likes_this_text = $settings[ 'likesthistext' ] : $cff_translate_likes_this_text = 'likes this');
    isset($custom['likethistext']) ? $cff_translate_like_this_text = $custom[ 'likethistext' ] : (isset($settings['likethistext']) ? $cff_translate_like_this_text = $settings[ 'likethistext' ] : $cff_translate_like_this_text = 'like this');
    isset($custom['andtext']) ? $cff_translate_and_text = $custom[ 'andtext' ] : (isset($settings['andtext']) ? $cff_translate_and_text = $settings[ 'andtext' ] : $cff_translate_and_text = 'and');
    isset($custom['othertext']) ? $cff_translate_other_text = $custom[ 'othertext' ] : (isset($settings['othertext']) ? $cff_translate_other_text = $settings[ 'othertext' ] : $cff_translate_other_text = 'other');
    isset($custom['otherstext']) ? $cff_translate_others_text = $custom[ 'otherstext' ] : (isset($settings['otherstext']) ? $cff_translate_others_text = $settings[ 'otherstext' ] : $cff_translate_others_text = 'others');
    //Translate - date
    isset($custom['second']) ? $cff_translate_second = $custom[ 'second' ] : (isset($settings['second']) ? $cff_translate_second = $settings[ 'second' ] : $cff_translate_second = 'second');
    isset($custom['seconds']) ? $cff_translate_seconds = $custom[ 'seconds' ] : (isset($settings['seconds']) ? $cff_translate_seconds = $settings[ 'seconds' ] : $cff_translate_seconds = 'seconds');
    isset($custom['minute']) ? $cff_translate_minute = $custom[ 'minute' ] : (isset($settings['minute']) ? $cff_translate_minute = $settings[ 'minute' ] : $cff_translate_minute = 'minute');
    isset($custom['minutes']) ? $cff_translate_minutes = $custom[ 'minutes' ] : (isset($settings['minutes']) ? $cff_translate_minutes = $settings[ 'minutes' ] : $cff_translate_minutes = 'minutes');
    isset($custom['hour']) ? $cff_translate_hour = $custom[ 'hour' ] : (isset($settings['hour']) ? $cff_translate_hour = $settings[ 'hour' ] : $cff_translate_hour = 'hour');
    isset($custom['hours']) ? $cff_translate_hours = $custom[ 'hours' ] : (isset($settings['hours']) ? $cff_translate_hours = $settings[ 'hours' ] : $cff_translate_hours = 'hours');
    isset($custom['day']) ? $cff_translate_day = $custom[ 'day' ] : (isset($settings['day']) ? $cff_translate_day = $settings[ 'day' ] : $cff_translate_day = 'day');
    isset($custom['days']) ? $cff_translate_days = $custom[ 'days' ] : (isset($settings['days']) ? $cff_translate_days = $settings[ 'days' ] : $cff_translate_days = 'days');
    isset($custom['week']) ? $cff_translate_week = $custom[ 'week' ] : (isset($settings['week']) ? $cff_translate_week = $settings[ 'week' ] : $cff_translate_week = 'week');
    isset($custom['weeks']) ? $cff_translate_weeks = $custom[ 'weeks' ] : (isset($settings['weeks']) ? $cff_translate_weeks = $settings[ 'weeks' ] : $cff_translate_weeks = 'weeks');
    isset($custom['month']) ? $cff_translate_month = $custom[ 'month' ] : (isset($settings['month']) ? $cff_translate_month = $settings[ 'month' ] : $cff_translate_month = 'month');
    isset($custom['months']) ? $cff_translate_months = $custom[ 'months' ] : (isset($settings['months']) ? $cff_translate_months = $settings[ 'months' ] : $cff_translate_months = 'months');
    isset($custom['year']) ? $cff_translate_year = $custom[ 'year' ] : (isset($settings['year']) ? $cff_translate_year = $settings[ 'year' ] : $cff_translate_year = 'year');
    isset($custom['years']) ? $cff_translate_years = $custom[ 'years' ] : (isset($settings['years']) ? $cff_translate_years = $settings[ 'years' ] : $cff_translate_years = 'years');
    isset($custom['ago']) ? $cff_translate_ago = $custom[ 'ago' ] : (isset($settings['ago']) ? $cff_translate_ago = $settings[ 'ago' ] : $cff_translate_ago = 'ago');

    //Compile an array to pass to date functions
    $date_translate_arr = array(
        '$cff_translate_second' => $cff_translate_second,
        '$cff_translate_seconds' => $cff_translate_seconds,
        '$cff_translate_minute' => $cff_translate_minute,
        '$cff_translate_minutes' => $cff_translate_minutes,
        '$cff_translate_hour' => $cff_translate_hour,
        '$cff_translate_hours' => $cff_translate_hours,
        '$cff_translate_day' => $cff_translate_day,
        '$cff_translate_days' => $cff_translate_days,
        '$cff_translate_week' => $cff_translate_week,
        '$cff_translate_weeks' => $cff_translate_weeks,
        '$cff_translate_month' => $cff_translate_month,
        '$cff_translate_months' => $cff_translate_months,
        '$cff_translate_year' => $cff_translate_year,
        '$cff_translate_years' => $cff_translate_years,
        '$cff_translate_ago' => $cff_translate_ago,
    );

    //STANDALONE ONLY
    if( $access_token == $default_token ) $cff_show_access_token = true;
    $cff_ext_multifeed_active = false;
    $cff_ext_date_active = false;
    $cff_featured_post_active = false;
    $cff_album_active = false;

    //COMPILE OPTIONS
    
    /********** GENERAL **********/
    $cff_is_group = false;
    if ($cff_page_type == 'group') $cff_is_group = true;

    if ( empty($cff_locale) || !isset($cff_locale) || $cff_locale == '' ) $cff_locale = 'en_US';
    //Compile feed styles
    $cff_feed_styles = 'style="';
    if ( !empty($cff_feed_width) ) $cff_feed_styles .= 'width:' . $cff_feed_width . '; ';
    if ( !empty($cff_feed_height) ) $cff_feed_styles .= 'height:' . $cff_feed_height . '; ';
    if ( !empty($cff_feed_padding) ) $cff_feed_styles .= 'padding:' . $cff_feed_padding . '; ';
    if ( !empty($cff_bg_color) ) $cff_feed_styles .= 'background-color:#' . $cff_bg_color . '; ';
    $cff_feed_styles .= '"';
    //Like box
    //Open links in new window?
    $target = 'target="_blank"';

    //EVENTS ONLY
    $cff_events_only = false;
    if ( empty($cff_events_source) || !isset($cff_events_source) ) $cff_events_source = 'eventspage';
    //Are we showing ONLY events?
    if ($cff_show_event_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type) $cff_events_only = true;

    //PHOTOS ONLY
    $cff_photos_only = false;
    if ( ($cff_show_photos_type && $cff_photos_source == 'photospage') && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_event_type && !$cff_show_status_type && !$cff_show_albums_type) $cff_photos_only = true;

    //ALBUMS ONLY
    $cff_albums_only = false;
    if ($cff_show_albums_type && !$cff_show_links_type && !$cff_show_video_type && !$cff_show_photos_type && !$cff_show_status_type && !$cff_show_event_type) $cff_albums_only = true;


    //Default is thumbnail layout
    $cff_thumb_layout = false;
    $cff_half_layout = false;
    $cff_full_layout = true;
    if (($cff_preset_layout == 'thumb' || empty($cff_preset_layout)) && $cff_show_media) {
        $cff_thumb_layout = true;
    } else if ($cff_preset_layout == 'half'  && $cff_show_media) {
        $cff_half_layout = true;
    } else {
        $cff_full_layout = true;
    }
    if ( $cff_thumb_layout || $cff_half_layout) $cff_media_position = 'below';
    
    /********** META **********/
    $cff_meta_styles = 'style="';
    if ( !empty($cff_meta_text_color) ) $cff_meta_styles .= 'color:#' . $cff_meta_text_color . ';';
    if ( !empty($cff_meta_bg_color) ) $cff_meta_styles .= 'background-color:#' . $cff_meta_bg_color . ';';
    $cff_meta_styles .= '"';

    $cff_meta_link_color = 'style="color:#' . str_replace('#', '', $cff_meta_link_color) . ';"';

    /********** TYPOGRAPHY **********/
    //Author
    $cff_author_styles = 'style="';
    if ( !empty($cff_author_size) && $cff_author_size != 'inherit' ) $cff_author_styles .=  'font-size:' . $cff_author_size . 'px; ';
    if ( !empty($cff_author_color) ) $cff_author_styles .= 'color:#' . str_replace('#', '', $cff_author_color) . ';';
    $cff_author_styles .= '"';
    //Title
    if (empty($cff_title_format)) $cff_title_format = 'p';
    $cff_title_styles = 'style="';
    if ( !empty($cff_title_size) && $cff_title_size != 'inherit' ) $cff_title_styles .=  'font-size:' . $cff_title_size . 'px; ';
    if ( !empty($cff_title_weight) && $cff_title_weight != 'inherit' ) $cff_title_styles .= 'font-weight:' . $cff_title_weight . '; ';
    if ( !empty($cff_title_color) ) $cff_title_styles .= 'color:#' . $cff_title_color . ';';
    $cff_title_styles .= '"';
    //Description
    $cff_body_styles = 'style="';
    if ( !empty($cff_body_size) && $cff_body_size != 'inherit' ) $cff_body_styles .=  'font-size:' . $cff_body_size . 'px; ';
    if ( !empty($cff_body_weight) && $cff_body_weight != 'inherit' ) $cff_body_styles .= 'font-weight:' . $cff_body_weight . '; ';
    if ( !empty($cff_body_color) ) $cff_body_styles .= 'color:#' . $cff_body_color . ';';
    $cff_body_styles .= '"';
    //Event Title
    $cff_event_title_styles = 'style="';
    if ( !empty($cff_event_title_size) && $cff_event_title_size != 'inherit' ) $cff_event_title_styles .=  'font-size:' . $cff_event_title_size . 'px; ';
    if ( !empty($cff_event_title_weight) && $cff_event_title_weight != 'inherit' ) $cff_event_title_styles .= 'font-weight:' . $cff_event_title_weight . '; ';
    if ( !empty($cff_event_title_color) ) $cff_event_title_styles .= 'color:#' . $cff_event_title_color . ';';
    $cff_event_title_styles .= '"';
    //Event Date
    $cff_event_date_styles = 'style="';
    if ( !empty($cff_event_date_size) && $cff_event_date_size != 'inherit' ) $cff_event_date_styles .=  'font-size:' . $cff_event_date_size . 'px; ';
    if ( !empty($cff_event_date_weight) && $cff_event_date_weight != 'inherit' ) $cff_event_date_styles .= 'font-weight:' . $cff_event_date_weight . '; ';
    if ( !empty($cff_event_date_color) ) $cff_event_date_styles .= 'color:#' . $cff_event_date_color . ';';
    $cff_event_date_styles .= '"';
    //Event Details
    $cff_event_details_styles = 'style="';
    if ( !empty($cff_event_details_size) && $cff_event_details_size != 'inherit' ) $cff_event_details_styles .=  'font-size:' . $cff_event_details_size . 'px; ';
    if ( !empty($cff_event_details_weight) && $cff_event_details_weight != 'inherit' ) $cff_event_details_styles .= 'font-weight:' . $cff_event_details_weight . '; ';
    if ( !empty($cff_event_details_color) ) $cff_event_details_styles .= 'color:#' . $cff_event_details_color . ';';
    $cff_event_details_styles .= '"';
    //Date
    if (!isset($cff_date_position)) $cff_date_position = 'author';
    $cff_date_styles = 'style="';
    if ( !empty($cff_date_size) && $cff_date_size != 'inherit' ) $cff_date_styles .=  'font-size:' . $cff_date_size . 'px; ';
    if ( !empty($cff_date_weight) && $cff_date_weight != 'inherit' ) $cff_date_styles .= 'font-weight:' . $cff_date_weight . '; ';
    if ( !empty($cff_date_color) ) $cff_date_styles .= 'color:#' . $cff_date_color . ';';
    $cff_date_styles .= '"';

    //Shared link title
    $cff_link_title_styles = 'style="';
    if ( !empty($cff_link_title_size) && $cff_link_title_size != 'inherit' ) $cff_link_title_styles .=  'font-size:' . $cff_link_title_size . 'px;';
    $cff_link_title_styles .= '"';

    //Shared link box
    $cff_link_box_styles = 'style="';
    if ( !empty($cff_link_border_color) ) $cff_link_box_styles .=  'border: 1px solid #' . str_replace('#', '', $cff_link_border_color) . '; ';
    if ( !empty($cff_link_bg_color) ) $cff_link_box_styles .= 'background-color: #' . str_replace('#', '', $cff_link_bg_color) . ';';
    $cff_link_box_styles .= '"';

    //Link to Facebook
    $cff_link_styles = 'style="';
    if ( !empty($cff_link_size) && $cff_link_size != 'inherit' ) $cff_link_styles .=  'font-size:' . $cff_link_size . 'px; ';
    if ( !empty($cff_link_weight) && $cff_link_weight != 'inherit' ) $cff_link_styles .= 'font-weight:' . $cff_link_weight . '; ';
    if ( !empty($cff_link_color) ) $cff_link_styles .= 'color:#' . $cff_link_color . ';';
    $cff_link_styles .= '"';
    /********** MISC **********/
    //Like Box styles
    $cff_like_box_colorscheme = 'light';
    if ($cff_like_box_text_color == 'white') $cff_like_box_colorscheme = 'dark';
    $cff_likebox_height = preg_replace('/px$/', '', $cff_likebox_height);

    if ( !isset($cff_likebox_width) || empty($cff_likebox_width) || $cff_likebox_width == '' ) $cff_likebox_width = '100%';
    if ( !isset($cff_like_box_faces) || empty($cff_like_box_faces) ) $cff_like_box_faces = 'false';
    if ($cff_like_box_border) {
        $cff_like_box_border = 'true';
    } else {
        $cff_like_box_border = 'false';
    }

    //Compile Like box styles
    $cff_likebox_styles = 'style="width: ' . $cff_likebox_width . ';';
    if ( !empty($cff_likebox_bg_color) ) $cff_likebox_styles .= 'background-color: #' . $cff_likebox_bg_color . ';';
    if ( empty($cff_likebox_bg_color) && $cff_like_box_faces == 'false' ) $cff_likebox_styles .= ' margin-left: -10px;';
    $cff_likebox_styles .= '"';

    //Compile feed header styles
    $cff_header_styles = 'style="';
    if ( !empty($cff_header_bg_color) ) $cff_header_styles .= 'background-color: #' . $cff_header_bg_color . ';';
    if ( !empty($cff_header_padding) ) $cff_header_styles .= ' padding: ' . $cff_header_padding . ';';
    if ( !empty($cff_header_text_size) ) $cff_header_styles .= ' font-size: ' . $cff_header_text_size . 'px;';
    if ( !empty($cff_header_text_weight) ) $cff_header_styles .= ' font-weight: ' . $cff_header_text_weight . ';';
    if ( !empty($cff_header_text_color) ) $cff_header_styles .= ' color: #' . $cff_header_text_color . ';';
    $cff_header_styles .= '"';


    //Video
    //Separating Line
    if (empty($cff_sep_color)) $cff_sep_color = 'ddd';
    if (empty($cff_sep_size)) $cff_sep_size = 0;
    //CFF item styles
    $cff_item_styles = 'style="';
    $cff_item_styles .= 'border-bottom: ' . $cff_sep_size . 'px solid #' . $cff_sep_color . '; ';
    $cff_item_styles .= '"';


    //Post styling
    ($cff_post_bg_color !== '#' && $cff_post_bg_color !== '') ? $cff_post_bg_color_check = true : $cff_post_bg_color_check = false;
    ($cff_sep_color !== '#' && $cff_sep_color !== '') ? $cff_sep_color_check = true : $cff_sep_color_check = false;

    //CFF item styles
    $cff_item_styles = '';
    if( $cff_sep_color_check || $cff_post_bg_color_check ){
        $cff_item_styles = 'style="';
        if($cff_sep_color_check && !$cff_post_bg_color_check) $cff_item_styles .= 'border-bottom: ' . $cff_sep_size . 'px solid #' . str_replace('#', '', $cff_sep_color) . '; ';
        if($cff_post_bg_color_check) $cff_item_styles .= 'background-color: ' . $cff_post_bg_color . '; ';
        if(isset($cff_post_rounded)) $cff_item_styles .= '-webkit-border-radius: ' . $cff_post_rounded . 'px; -moz-border-radius: ' . $cff_post_rounded . 'px; border-radius: ' . $cff_post_rounded . 'px; ';
        $cff_item_styles .= '"';
    }

   
    //Text limits
    if (!isset($title_limit)) $title_limit = 9999;

    //Set user's timezone based on setting
    $cff_orig_timezone = date_default_timezone_get();
    if(!empty($cff_timezone)) date_default_timezone_set($cff_timezone);

    //Assign the Access Token and Page ID variables
    //Get show posts attribute. If not set then default to 25
    if (empty($show_posts)) $show_posts = 25;
    if ( $show_posts == 0 || $show_posts == 'undefined' ) $show_posts = 25;
    //Check whether the Access Token is present and valid
    if ($access_token == '') {
        echo 'Please enter a valid Access Token into the fbfeed-settings.php file.<br /><br />';
        return false;
    }

    //If user pastes their full URL into the Page ID field then strip it out
    $cff_facebook_string = 'facebook.com';
    ( stripos($page_id, $cff_facebook_string) !== false) ? $cff_page_id_url_check = true : $cff_page_id_url_check = false;
    
    if ( $cff_page_id_url_check === true ) {
        //Remove trailing slash if exists
        $page_id = preg_replace('{/$}', '', $page_id);
        //Get last part of url
        $page_id = substr( $page_id, strrpos( $page_id, '/' )+1 );
    }

    //If the Page ID contains a query string at the end then remove it
    if ( stripos( $page_id, '?') !== false ) $page_id = substr($page_id, 0, strrpos($page_id, '?'));

    //Check whether a Page ID has been defined
    if ($page_id == '') {
        echo "Please enter the Page ID of the Facebook feed you'd like to display. You can do this in either the fbfeed-settings.php file or in the 'fbFeed' function itself.";
        return false;
    }

    //If the limit isn't set then set it to be 5 more than the number of posts defined
    if ( empty($cff_post_limit) || $cff_post_limit == '' ) {
        $cff_post_limit = intval(intval($show_posts) + 7);
    }

    //Is it SSL?
    if ($cff_ssl) $cff_ssl = '&return_ssl_resources=true';

    //Use posts? or feed?
    $graph_query = 'posts';
    $cff_show_only_others = false;

    //If 'others' shortcode option is used then it overrides any other option
    if ($show_others) {

        //Show posts by everyone
        if ( $show_others == 'on' || $show_others == 'true' || $show_others == true || $cff_is_group ) $graph_query = 'feed';
        //Only show posts by me
        if ( $show_others == false ) $graph_query = 'posts';

    } else {
    //Else use the settings page option or the 'showpostsby' shortcode option

        //Only show posts by me
        if ( $show_posts_by == 'me' ) $graph_query = 'posts';

        //Show posts by everyone
        if ( $show_posts_by == 'others' || $cff_is_group ) $graph_query = 'feed';

        //Show posts ONLY by others
        if ( $show_posts_by == 'onlyothers' && !$cff_is_group ) {
            $graph_query = 'feed';
            $cff_show_only_others = true;
        }

    }


    //Set like box variable
    $like_box = '<div class="cff-likebox';
    if ($cff_like_box_outside) $like_box .= ' cff-outside';
    $like_box .= ($cff_like_box_position == 'top') ? ' top' : ' bottom';
    $like_box .= '" ' . $cff_likebox_styles . '><script src="https://connect.facebook.net/' . $cff_locale . '/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/' . $page_id . '" show_faces="'.$cff_like_box_faces.'" stream="false" header="false" colorscheme="'. $cff_like_box_colorscheme .'" show_border="'. $cff_like_box_border .'" data-height="'.$cff_likebox_height.'"></fb:like-box><div id="fb-root"></div></div>';
    //Don't show like box if it's a group
    if($cff_is_group) $like_box = '';


    //Feed header
    $cff_header = '<h3 class="cff-header';
    if ($cff_header_outside) $cff_header .= ' cff-outside';
    $cff_header .= '"' . $cff_header_styles . '>';
    if( $cff_header_icon !== 'none' ) {
        $cff_header .= '<i class="fa fa-' . $cff_header_icon . '"';
        if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size)) $cff_header .= ' style="';
        if(!empty($cff_header_icon_color)) $cff_header .= 'color: #' . $cff_header_icon_color . ';';
        if(!empty($cff_header_icon_size)) $cff_header .= ' font-size: ' . $cff_header_icon_size . 'px;';
        if(!empty($cff_header_icon_color) || !empty($cff_header_icon_size))$cff_header .= '"';
        $cff_header .= '></i>';
    }
    $cff_header .= $cff_header_text;
    $cff_header .= '</h3>';

    //***START FEED***
    $cff_content = '';

    //Add the page header to the outside of the top of feed
    if ($cff_show_header && $cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the outside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //Create CFF container HTML
    $cff_content .= '<div class="cff-wrapper">';
    $cff_content .= '<div id="cff" ';
    if( !empty($title_limit) ) $cff_content .= 'rel="'.$title_limit.'" ';
    $cff_content .= 'class="';
    if( !empty($cff_class) ) $cff_content .= $cff_class . ' ';
    if ( !empty($cff_feed_height) ) $cff_content .= 'cff-fixed-height ';
    if ( $cff_thumb_layout ) $cff_content .= 'cff-thumb-layout ';
    if ( $cff_half_layout ) $cff_content .= 'cff-half-layout ';
    if ( !$cff_enable_narrow ) $cff_content .= 'cff-disable-narrow';
    $cff_content .= '" ' . $cff_feed_styles . '>';

    //Add the page header to the inside of the top of feed
    if ($cff_show_header && !$cff_header_outside) $cff_content .= $cff_header;

    //Add like box to the inside of the top of feed
    if ($cff_like_box_position == 'top' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
    //Limit var
    $i = 0;


    //Multifeed extension
    ( $cff_ext_multifeed_active ) ? $page_ids = cff_multifeed_ids($page_id) : $page_ids = array($page_id);

    //Define array for post items
    $cff_posts_array = array();

    //LOOP THROUGH PAGE IDs
    foreach ( $page_ids as $page_id ) {
    
        //EVENTS ONLY
        if ($cff_events_only && $cff_events_source == 'eventspage'){
            //Get the user's ID
            $get_page_info = cff_fetchUrl('https://graph.facebook.com/' . $page_id . '?access_token=' . $access_token);
            $page_info = json_decode($get_page_info);
            //Get user ID
            $u_id = $page_info->id;

            //Add 6 hours to the current time. This means events will still be shown for 6 hours after their start time has passed.
            $cff_event_offset_time = '-' . $cff_event_offset . ' hours';
            $curtimeplus = strtotime($cff_event_offset_time, time());

            //Start time string
            $cff_start_time_string = "start_time>=".$curtimeplus;

            //Set the query
            $fql = "SELECT%20eid,name,attending_count,pic_big,pic_cover,start_time,end_time,timezone,venue,location,description,ticket_uri%20FROM%20event%20WHERE%20eid%20IN%20(SELECT%20eid%20FROM%20event_member%20WHERE%20uid='".$u_id."')%20AND%20".$cff_start_time_string."%20ORDER%20BY%20start_time%20&access_token=" . $access_token . '&format=json-strings' . $cff_ssl;
            //https://graph.facebook.com/fql?q=SELECT%20eid,name,attending_count,ticket_uri,pic_big,start_time,end_time,timezone,venue,location,description%20FROM%20event%20WHERE%20eid%20IN%20(SELECT%20eid%20FROM%20event_member%20WHERE%20uid='539051002877739')%20AND%20start_time>=now()%20ORDER%20BY%20start_time%20&format=json-strings%20&access_token=439271626171835|-V79s0TIUVsjj_5lgc6ydVvaFZ8
            
            // Get any existing copy of our transient data
            $cff_events_json_url = "https://graph.facebook.com/fql?q=" . $fql;
            $events_json = cff_fetchUrl($cff_events_json_url);
            

            //Interpret data with JSON
            //Convert eid integer to a string otherwise json_decode returns it as a float
            $events_json = preg_replace('/"eid":(\d+)/', '"eid":"$1"', $events_json);
            $events_json = preg_replace('/"id":(\d+)/', '"id":"$1"', $events_json);
            $event_data = json_decode($events_json);
            //EVENTS LOOP
            foreach ($event_data->data as $event )
            {
                //Only create posts for the amount of posts specified
                // if ( $i == $show_posts ) break;
                $i++;
                isset($event->eid) ? $eid = $event->eid : $eid = '';
                isset($event->name) ? $event_name = $event->name : $event_name = '';
                isset($event->attending_count) ? $attending_count = $event->attending_count : $attending_count = '';
                // isset($event->ticket_uri) ? $ticket_uri = $event->ticket_uri : $ticket_uri = '';
                //Picture source
                ( $cff_event_image_size == 'cropped' ) ? $crop_event_pic = true : $crop_event_pic = false;
                ( isset($event->pic_cover) && !$crop_event_pic ) ? $pic_big = $event->pic_cover->source : $pic_big = $event->pic_big;

                isset($event->start_time) ? $start_time = $event->start_time : $start_time = '';
                isset($event->end_time) ? $end_time = $event->end_time : $end_time = '';
                isset($event->timezone) ? $timezone = $event->timezone : $timezone = '';
                //Venue
                isset($event->venue->latitude) ? $venue_latitude = $event->venue->latitude : $venue_latitude = '';
                isset($event->venue->longitude) ? $venue_longitude = $event->venue->longitude : $venue_longitude = '';
                isset($event->venue->city) ? $venue_city = $event->venue->city : $venue_city = '';
                isset($event->venue->state) ? $venue_state = $event->venue->state : $venue_state = '';
                isset($event->venue->country ) ? $venue_country = $event->venue->country : $venue_country = '';
                isset($event->venue->id) ? $venue_id = $event->venue->id : $venue_id = '';
                $venue_link = 'https://facebook.com/' . $venue_id;
                isset($event->venue->street) ? $venue_street = $event->venue->street : $venue_street = '';
                isset($event->venue->zip) ? $venue_zip = $event->venue->zip : $venue_zip = '';
                isset($event->location) ? $location = $event->location : $location = '';
                isset($event->description) ? $description = $event->description : $description = '';
                $event_link = 'https://facebook.com/events/' . $eid;
                isset($event->ticket_uri) ? $ticket_uri = $event->ticket_uri : $ticket_uri = '';

                //Event date
                $event_time = $start_time;
                //If timezone migration is enabled then remove last 5 characters
                if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);


                if (!empty($start_time)) $cff_event_date = '<p class="cff-date" '.$cff_event_date_styles.'>' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom);
                if( isset($event->end_time) ) $cff_event_date .= ' - ' . cff_eventdate(strtotime($end_time), $cff_event_date_formatting, $cff_event_date_custom);
                $cff_event_date .= '</p>';


                //Event title
                $cff_event_title = '';
                if ($cff_event_title_link) $cff_event_title .= '<a href="'.$event_link.'" '.$target.'>';
                $cff_event_title .= '<' . $cff_event_title_format . ' ' . $cff_event_title_styles . '>' . $event_name . '</' . $cff_event_title_format . '>';
                if ($cff_event_title_link) $cff_event_title .= '</a>';
                
                //***************************//
                //***CREATE THE EVENT HTML***//
                //***************************//
                $cff_post_item = '<div class="cff-item cff-event author-'. cff_to_slug($page_id) . '" ' . $cff_item_styles . '>';
                //Picture
                if($cff_show_media) $cff_post_item .= '<a title="' . $cff_facebook_link_text . '" class="cff-photo" href="'.$event_link.'" '.$target.'><img src="'. $pic_big .'" border="0" /></a>';
                //Start text wrapper
                if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_post_item .= '<div class="cff-details">';
                    //show event date above title
                    if ($cff_show_date && $cff_event_date_position == 'above') $cff_post_item .= $cff_event_date;
                    //Show event title
                    if ($cff_show_event_title && !empty($event_name)) $cff_post_item .= $cff_event_title;
                    //show event date below title
                    if ($cff_show_date && $cff_event_date_position !== 'above') $cff_post_item .= $cff_event_date;
                    //Show event details
                    if ($cff_show_event_details){
                        if (!empty($location)) $cff_post_item .= '<p class="cff-location" ' . $cff_event_details_styles . '>';
                        if (!empty($venue_id)) $cff_post_item .= '<a href="'. $venue_link .'" '.$target.' style="color:#' . str_replace('#', '', $cff_event_link_color) . ';">';
                        if (!empty($location)) $cff_post_item .= '<b>' . $location . '</b>';
                        if (!empty($venue_id)) $cff_post_item .= '</a>';
                        if (!empty($venue_street)) $cff_post_item .= '<br />' . $venue_street;
                        if (!empty($venue_city)) $cff_post_item .= '<br />' . $venue_city . ', ' . $venue_state . ' &nbsp;' . $venue_zip;
                        if (!empty($venue_latitude)) $cff_post_item .= ' <a href="https://maps.google.com/maps?q=' . $venue_latitude . ',+' . $venue_longitude . '" '.$target.' style="color:#' . str_replace('#', '', $cff_event_link_color) . ';">'.$cff_map_text.'</a>';
                        if (!empty($location)) $cff_post_item .= '</p>';
                        if (!empty($description)){
                            if (!empty($body_limit)) {
                                if (strlen($description) > $body_limit) $description = substr($description, 0, $body_limit) . '...';
                            }
                            $cff_post_item .= '<p class="cff-desc" ' . $cff_event_details_styles . '>' . cff_autolink($description, $link_color=str_replace('#', '', $cff_event_link_color)) . '</p>';
                        }
                    }
                //End details
                if ( ($cff_thumb_layout || $cff_half_layout) ) $cff_post_item .= '</div>';
                $cff_post_item .= '<div class="cff-meta-links">';
                if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                if($cff_show_link) $cff_post_item .= '<a class="cff-viewpost" href="' . $event_link . '" ' . $target . ' ' . $cff_link_styles . '>'.$cff_facebook_link_text.'</a>';
                // if ( $ticket_uri ) $cff_post_item .= '<a class="cff-viewpost" href="' . $ticket_uri . '" ' . $target . ' ' . $cff_link_styles . '>'.$cff_buy_tickets_text.'</a>';
                $cff_post_item .= '</div></div><div class="cff-clear"></div>';


                //Create a string from the event title, location and address to use in the filter check below
                $cff_event_address_string = $cff_event_title . $location . $venue_street . $venue_city . $venue_state . $venue_zip;

                $cff_show_post = true;
                if ( $cff_filter_string != '' ){
                    //Explode it into multiples
                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_address = true;
                    $string_in_desc = true;
                    if ( cff_stripos_arr($cff_event_address_string, $cff_filter_strings_array) === false ) $string_in_address = false;
                    if ( cff_stripos_arr($description, $cff_filter_strings_array) === false ) $string_in_desc = false;

                    if( $string_in_address == false && $string_in_desc == false ) $cff_show_post = false;
                }

                if ( $cff_exclude_string != '' ){
                    //Explode it into multiples
                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_address = false;
                    $string_in_desc = false;

                    if ( cff_stripos_arr($cff_event_address_string, $cff_exclude_strings_array) !== false ) $string_in_address = true;
                    if ( cff_stripos_arr($description, $cff_exclude_strings_array) !== false ) $string_in_desc = true;

                    if( $string_in_address == true || $string_in_desc == true ) $cff_show_post = false;
                }

                //PUSH TO ARRAY if the post should be shown
                if( $cff_show_post !== false ) $cff_posts_array = cff_array_push_assoc($cff_posts_array, strtotime($event_time), $cff_post_item);

            } // End the loop

            //Sort all of the events by all page IDs to show the most recent upcoming events first
            ksort($cff_posts_array);

        } //End EVENTS ONLY
        
        //ALL POSTS
        if (!$cff_events_only || ($cff_events_only && $cff_events_source == 'timeline') ){

            $cff_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/' . $graph_query . '?access_token=' . $access_token . '&limit=' . $cff_post_limit . '&locale=' . $cff_locale . $cff_ssl;

            //PHOTOS ONLY
            if($cff_photos_only){
                //Get the user's ID
                $get_page_info = cff_fetchUrl('https://graph.facebook.com/' . $page_id . '?access_token=' . $access_token);
                $page_info = json_decode($get_page_info);
                //Get user ID
                $u_id = $page_info->id;

                //PHOTOS ONLY
                if($cff_is_group){
                    //For groups
                    $cff_posts_json_url = "https://graph.facebook.com/fql?q=SELECT%20pid,created,src_big,link%20FROM%20photo%20WHERE%20pid%20IN%20(SELECT%20pid%20FROM%20photo_tag%20WHERE%20subject='".$u_id."')%20OR%20pid%20IN%20(SELECT%20pid%20FROM%20photo%20WHERE%20aid%20IN%20(SELECT%20aid%20FROM%20album%20WHERE%20owner='".$u_id."'%20AND%20type!='profile'))%20LIMIT%20".$cff_post_limit;
                } else {
                    //For pages
                    $cff_posts_json_url = "https://graph.facebook.com/fql?q=SELECT%20pid,created,src_big,link%20FROM%20photo%20WHERE%20pid%20IN%20(SELECT%20pid%20FROM%20photo%20WHERE%20owner='".$u_id."')%20LIMIT%20".$cff_post_limit;
                }
            }

            //ALBUMS ONLY
            if($cff_albums_only && $cff_albums_source == 'photospage') $cff_posts_json_url = 'https://graph.facebook.com/' . $page_id . '/albums?access_token=' . $access_token . '&limit=' . $cff_post_limit;

        
            $posts_json = cff_fetchUrl($cff_posts_json_url);
            

            if ( $cff_show_only_others ) {
                //Get the numeric ID of the page so can compare it to the author of each post
                $page_object = cff_fetchUrl('https://graph.facebook.com/' . $page_id);
                $page_object = json_decode($page_object);
                $numeric_page_id = $page_object->id;
            }
            
            //Interpret data with JSON
            $FBdata = json_decode($posts_json);

            //If there's no data then show a pretty error message
            if( empty($FBdata->data) ) {
                $cff_content .= '<div class="cff-error-msg"><p>Unable to display Facebook posts.<br/><a href="javascript:void(0);" id="cff-show-error" onclick="cffShowError()">Show error</a>';
                $cff_content .= '<script type="text/javascript">function cffShowError() { document.getElementById("cff-error-reason").style.display = "block"; document.getElementById("cff-show-error").style.display = "none"; }</script>';
                $cff_content .= '</p><div id="cff-error-reason">';
                
                if( isset($FBdata->error->message) ) $cff_content .= 'Error: ' . $FBdata->error->message;
                if( isset($FBdata->error->type) ) $cff_content .= '<br />Type: ' . $FBdata->error->type;
                if( isset($FBdata->error->code) ) $cff_content .= '<br />Code: ' . $FBdata->error->code;
                if( isset($FBdata->error->error_subcode) ) $cff_content .= '<br />Subcode: ' . $FBdata->error->error_subcode;

                if( isset($FBdata->error_msg) ) $cff_content .= 'Error: ' . $FBdata->error_msg;
                if( isset($FBdata->error_code) ) $cff_content .= '<br />Code: ' . $FBdata->error_code;
                
                if($FBdata == null) $cff_content .= 'Error: Server configuration issue';

                if( empty($FBdata->error) && empty($FBdata->error_msg) && $FBdata !== null ) $cff_content .= 'Error: No posts available for this Facebook ID';

                $cff_content .= '<br />Please refer to our <a href="https://smashballoon.com/custom-facebook-feed/docs/errors/" target="_blank">Error Message Reference</a>.</div>';

                echo $cff_content;
                return;
            }

            //***STARTS POSTS LOOP***
            //If the Featured Post extension is active then adjust the loop as there is no 'data'
            $fbdata_string = $FBdata->data;
            foreach ($fbdata_string as $news)
            {
                $cff_post_item = '';

                //Explode News and Page ID's into 2 values
                isset($news->id) ? $PostID = explode("_", $news->id) : $PostID = '';
                //Check the post type
                isset($news->type) ? $cff_post_type = $news->type : $cff_post_type = '';
                if ($cff_post_type == 'link') {
                    isset($news->story) ? $story = $news->story : $story = '';
                    //Check whether it's an event
                    $event_link_check = "facebook.com/events/";
                    $event_link_check = stripos($news->link, $event_link_check);
                    if ( $event_link_check ) $cff_post_type = 'event';
                }

                //Set the post link
                isset($news->link) ? $link = htmlspecialchars($news->link) : $link = '';

                //If there's no link provided then link to the individual post
                if (empty($news->link)) {
                    //Link to individual post
                    $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];
                }

                //Is it an album?
                $cff_album = false;
                $album_string = 'relevant_count=';
                $relevant_count = stripos($link, $album_string);

                if ( $relevant_count ) {
                    //If relevant_count is larger than 1 then there are multiple photos
                    $relevant_count = explode('relevant_count=', $link);
                    $num_photos = intval($relevant_count[1]);
                    if ( $num_photos > 1 ) {
                        $cff_album = true;
                    
                        //Link to the album instead of the photo
                        $album_link = str_replace('photo.php?','media/set/?',$link);
                        $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];

                        //If the album link is a new format then link it to the post
                        $album_link_check = 'media/set/?';
                        if( stripos($album_link, $album_link_check) !== true ) $album_link = $link;
                    }
                }

                //Should we show this post or not?
                $cff_show_post = false;
                switch ($cff_post_type) {
                    case 'link':
                        if ( $cff_show_links_type ) $cff_show_post = true;
                        break;
                    case 'event':
                        if ( $cff_show_event_type ) $cff_show_post = true;
                        break;
                    case 'video':
                         if ( $cff_show_video_type ) $cff_show_post = true;
                        break;
                    case 'swf':
                         if ( $cff_show_video_type ) $cff_show_post = true;
                        break;
                    case 'photo':
                         if ( $cff_show_photos_type && !$cff_album ) $cff_show_post = true;
                         if ( $cff_show_albums_type && $cff_album ) $cff_show_post = true;
                        break;
                    case 'offer':
                        //Show offer posts if links are shown
                         if ( $cff_show_links_type ) $cff_show_post = true;
                        break;
                    case 'music':
                        //Show music posts if statuses are shown
                         if ( $cff_show_status_type ) $cff_show_post = true;
                        break;
                    case 'status':
                        //Check whether it's a status (author comment or like)
                        if ( $cff_show_status_type && !empty($news->message) ) $cff_show_post = true;
                        break;
                }

                //ONLY show posts by others
                if ( $cff_show_only_others ) {
                    //If the post author's ID is the same as the page ID then don't show the post
                    if ( $numeric_page_id == $news->from->id ) $cff_show_post = false;
                }

                //Only show posts containing specified string
                //Get post text
                $post_text = '';
                if (!empty($news->story)) $post_text = $news->story;
                if (!empty($news->message)) $post_text = $news->message;
                if (!empty($news->name) && empty($news->story) && empty($news->message)) $post_text = $news->name;

                //Get description text
                if( isset($news->description) ){
                    $description_text = $news->description;
                } else {
                    isset( $news->caption ) ? $description_text = $news->caption : $description_text = '';
                }

                if ( $cff_filter_string != '' ){
                    //Explode it into multiples
                    $cff_filter_strings_array = explode(',', $cff_filter_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_post_text = true;
                    $string_in_desc = true;
                    if ( cff_stripos_arr($post_text, $cff_filter_strings_array) === false ) $string_in_post_text = false;
                    if ( cff_stripos_arr($description_text, $cff_filter_strings_array) === false ) $string_in_desc = false;

                    if( $string_in_post_text == false && $string_in_desc == false ) $cff_show_post = false;
                }

                if ( $cff_exclude_string != '' ){
                    //Explode it into multiples
                    $cff_exclude_strings_array = explode(',', $cff_exclude_string);
                    //Hide the post if both the post text and description don't contain the string
                    $string_in_post_text = false;
                    $string_in_desc = false;

                    if ( cff_stripos_arr($post_text, $cff_exclude_strings_array) !== false ) $string_in_post_text = true;
                    if ( cff_stripos_arr($description_text, $cff_exclude_strings_array) !== false ) $string_in_desc = true;

                    if( $string_in_post_text == true || $string_in_desc == true ) $cff_show_post = false;
                }


                //Is it a duplicate post?
                if (!isset($prev_post_message)) $prev_post_message = '';
                if (!isset($prev_post_link)) $prev_post_link = '';
                if (!isset($prev_post_description)) $prev_post_description = '';
                isset($news->message) ? $pm = $news->message : $pm = '';
                isset($news->link) ? $pl = $news->link : $pl = '';
                isset($news->description) ? $pd = $news->description : $pd = '';

                if ( ($prev_post_message == $pm) && ($prev_post_link == $pl) && ($prev_post_description == $pd) ) $cff_show_post = false;

                //ALBUMS ONLY
                if($cff_albums_only && $cff_albums_source == 'photospage') $cff_show_post = true;

                //PHOTOS ONLY
                if($cff_photos_only) $cff_show_post = true;

                //Check post type and display post if selected
                if ( $cff_show_post ) {
                    //If it isn't then create the post
                    //Only create posts for the amount of posts specified
                    // if ( $i == $show_posts ) break;
                    $i++;
                    //********************************//
                    //***COMPILE SECTION VARIABLES***//
                    //********************************//
                    //Change image size based on layout
                    if (!empty($news->picture) && !empty($news->object_id)) {
                        $object_id = $news->object_id;
                        $picture = 'https://graph.facebook.com/'.$object_id.'/picture?type=normal&width=9999&height=9999';
                    }

                    //DATE
                    isset($news->created_time) ? $post_time = $news->created_time : $post_time = '';
                    $cff_date = '<p class="cff-date" '.$cff_date_styles.'>'. $cff_date_before . ' ' . cff_getdate(strtotime($post_time), $cff_date_formatting, $cff_date_custom, $date_translate_arr) . ' ' . $cff_date_after;
                    $cff_date .= '</p>';


                    //Only run if NOT only showing photos from the photos page
                    if(!$cff_photos_only){

                        //POST AUTHOR
                        $cff_author = '<div class="cff-author">';
                        
                        //Author text
                        $cff_author .= '<a href="https://facebook.com/' . $news->from->id . '" '.$target.' title="'.$news->from->name.' on Facebook" '.$cff_author_styles.'><div class="cff-author-text">';

                        if($cff_show_date && $cff_date_position !== 'above' && $cff_date_position !== 'below'){
                            $cff_author .= '<p class="cff-page-name cff-author-date">'.$news->from->name.'</p>';
                            $cff_author .= $cff_date;
                        } else {
                            $cff_author .= '<span class="cff-page-name">'.$news->from->name.'</span>';
                        }

                        $cff_author .= '</div>';

                        //Author image
                        //Set the author image as a variable. If it already exists then don't query the api for it again.
                        $cff_author_img_var = '$cff_author_img_' . $news->from->id;
                        if ( !isset($$cff_author_img_var) ) $$cff_author_img_var = 'https://graph.facebook.com/' . $news->from->id . '/picture?type=square';
                        $cff_author .= '<div class="cff-author-img"><img src="'.$$cff_author_img_var.'" title="'.$news->from->name.'" alt="'.$news->from->name.'" width=40 height=40></div>';

                        $cff_author .= '</a></div>'; //End .cff-author


                        //POST TEXT
                        if (!isset($cff_translate_photos_text) || empty($cff_translate_photos_text)) $cff_translate_photos_text = 'photos';
                        $cff_post_text = '<' . $cff_title_format . ' class="cff-post-text" ' . $cff_title_styles . '>';
                        //__ shared __'s photo
                        // if ($news->type == 'photo' && !empty($news->story) ) $cff_post_text .= '<span class="cff-byline" '.$cff_body_styles.'>' . $news->story . '</span>';
                        // $cff_post_text = '<div class="cff-post-text" ' . $cff_title_styles . '>';
                        $cff_post_text .= '<span class="cff-text" rel="'.str_replace('#', '', $cff_posttext_link_color ).'">';
                        if ($cff_title_link) $cff_post_text .= '<a class="cff-post-text-link" '.$cff_title_styles.' href="'.$link.'" '.$target.'>';
                        //Which content should we use?
                        $cff_post_text_type = '';
                        //Use the story
                        if (!empty($news->story)) {
                            $post_text = htmlspecialchars($news->story);
                            $cff_post_text_type = 'story';
                        }
                        //Use the message
                        if (!empty($news->message)) {
                            $post_text = htmlspecialchars($news->message);
                            $cff_post_text_type = 'message';
                        }
                        //Use the name
                        if (!empty($news->name) && empty($news->story) && empty($news->message)) {
                            $post_text = htmlspecialchars($news->name);
                            $cff_post_text_type = 'name';
                        }
                        if ($cff_album) {
                            if (!empty($news->name)) {
                                $post_text = htmlspecialchars($news->name);
                                $cff_post_text_type = 'name';
                            }
                            if (!empty($news->message) && empty($news->name)) {
                                $post_text = htmlspecialchars($news->message);
                                $cff_post_text_type = 'message';
                            }
                            $post_text .= ' (' . $num_photos . ' '.$cff_translate_photos_text.')';
                        }


                        //OFFER TEXT
                        if ($cff_post_type == 'offer'){
                            isset($news->story) ? $post_text = htmlspecialchars($news->story) . '<br /><br />' : $post_text = '';
                            $post_text .= htmlspecialchars($news->name);
                            $cff_post_text_type = 'story';
                        }


                        //MESSAGE TAGS
                        //Add message and story tags if there are any and the post text is the message or the story
                        if( $cff_post_tags && ( isset($news->message_tags) || isset($news->story_tags) ) && ($cff_post_text_type == 'message' || $cff_post_text_type == 'story')  && !$cff_title_link){
                            //Use message_tags or story_tags?
                            ( isset($news->message_tags) )? $text_tags = $news->message_tags : $text_tags = $news->story_tags;

                            //If message tags and message is being used as the post text, or same with story. This stops story tags being used to replace the message inadvertently.
                            if( ( $cff_post_text_type == 'message' && isset($news->message_tags) ) || ( $cff_post_text_type == 'story' && !isset($news->message_tags) ) ) {

                                //Does the Post Text contain any html tags? - the & symbol is the best indicator of this
                                $cff_html_check_array = array('&lt;', '’', '“', '&quot;', '&amp;');

                                //always use the text replace method
                                if( cff_stripos_arr($post_text, $cff_html_check_array) !== false ) {
                                    //Loop through the tags
                                    foreach($text_tags as $message_tag ) {
                                        $tag_name = $message_tag[0]->name;
                                        $tag_link = '<a href="http://facebook.com/' . $message_tag[0]->id . '" style="color: #'.str_replace('#', '', $cff_posttext_link_color).';" '.$target.'>' . $message_tag[0]->name . '</a>';

                                        $post_text = str_replace($tag_name, $tag_link, $post_text);
                                    }

                                } else {
                                //If it doesn't contain HTMl tags then use the offset to replace message tags
                                    $message_tags_arr = array();

                                    $i = 0;
                                    foreach($text_tags as $message_tag ) {
                                        $i++;
                                        $message_tags_arr = cff_array_push_assoc(
                                            $message_tags_arr,
                                            $i,
                                            array(
                                                'id' => $message_tag[0]->id,
                                                'name' => $message_tag[0]->name,
                                                'type' => $message_tag[0]->type,
                                                'offset' => $message_tag[0]->offset,
                                                'length' => $message_tag[0]->length
                                            )
                                        );
                                    }

                                    for($i = count($message_tags_arr); $i >= 1; $i--) {
                                       
                                        $b = '<a href="http://facebook.com/' . $message_tags_arr[$i]['id'] . '" style="color: #'.str_replace('#', '', $cff_posttext_link_color).';" '.$target.'>' . $message_tags_arr[$i]['name'] . '</a>';
                                        $c = $message_tags_arr[$i]['offset'];
                                        $d = $message_tags_arr[$i]['length'];

                                        $post_text = cff_mb_substr_replace( $post_text, $b, $c, $d);

                                    }   

                                } // end if/else

                            } // end message check

                        } //END MESSAGE TAGS


                        //Check to see whether it's an embedded video so that we can show the name above the post text if necessary
                        $cff_is_video_embed = false;
                        if ($news->type == 'video'){
                            $url = $news->source;
                            //Embeddable video strings
                            $youtube = 'youtube';
                            $youtu = 'youtu';
                            $vimeo = 'vimeo';
                            $youtubeembed = 'youtube.com/embed';
                            //Check whether it's a youtube video
                            $youtube = stripos($url, $youtube);
                            $youtu = stripos($url, $youtu);
                            $youtubeembed = stripos($url, $youtubeembed);
                            //Check whether it's a youtube video
                            if($youtube || $youtu || $youtubeembed || (stripos($url, $vimeo) !== false)) {
                                $cff_is_video_embed = true;
                            }

                            //If the name exists and it's a non-embedded video then show the name at the top of the post text
                            if( isset($news->name) && !$cff_is_video_embed ){
                                if (!$cff_title_link) $cff_post_text .= '<a href="'.$link.'" '.$target.' style="color: #'.str_replace('#', '', $cff_posttext_link_color).'">';
                                $cff_post_text .= htmlspecialchars($news->name);
                                if (!$cff_title_link) $cff_post_text .= '</a>';
                                $cff_post_text .= '<br />';
                            }
                        }

                        //Replace line breaks in text (needed for IE8)
                        $post_text = preg_replace("/\r\n|\r|\n/",'<br/>', $post_text);

                        //If the text is wrapped in a link then don't hyperlink any text within
                        if ($cff_title_link) {
                            //Wrap links in a span so we can break the text if it's too long
                            $cff_post_text .= cff_wrap_span( $post_text ) . ' ';
                        } else {
                            //Don't use htmlspecialchars for post_text as it's added above so that it doesn't mess up the message_tag offsets
                            $cff_post_text .= cff_autolink( $post_text, $link_color=str_replace('#', '', $cff_posttext_link_color) ) . ' ';
                        }
                        
                        if ($cff_title_link) $cff_post_text .= '</a>';
                        $cff_post_text .= '</span>';
                        //'See More' link
                        $cff_post_text .= '<span class="cff-expand">... <a href="#" style="color: #'.str_replace('#', '', $cff_posttext_link_color).'"><span class="cff-more">' . $cff_see_more_text . '</span><span class="cff-less">' . $cff_see_less_text . '</span></a></span>';
                        $cff_post_text .= '</' . $cff_title_format . '>';
                        // $cff_post_text .= '</div>';

                        //DESCRIPTION
                        $cff_description = '';
                        if ( !empty($news->description) || !empty($news->caption) ) {
                            $description_text = '';
                            if ( !empty($news->description) ) {
                                $description_text = $news->description;
                            } else {
                                $description_text = $news->caption;
                            }

                            if (!empty($body_limit)) {
                                if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                            }

                            $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>' . cff_autolink( htmlspecialchars($description_text) ) . '</span></p>';
                        }

                        //LINK
                        $cff_shared_link = '';
                        //Display shared link
                        if ($cff_post_type == 'link') {
                            $cff_shared_link .= '<div class="cff-shared-link';
                            if($cff_disable_link_box) $cff_shared_link .= ' cff-no-styles"';
                            if(!$cff_disable_link_box) $cff_shared_link .= '" ' . $cff_link_box_styles;
                            $cff_shared_link .= '>';

                            if ( isset($news->picture) ){

                                if (!empty($news->picture)) {
                                    $picture = $news->picture;

                                    /*If the image doesn't have a _b version then the URL looks like this:
                                    http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                    So check for this kind of string below and don't replace _s. with _b.
                                    */
                                    $bigjpg = '_s.jpg?';
                                    $bigpng = '_s.png?';
                                    $biggif = '_s.gif?';
                                    $bigbmp = '_s.bmp?';
                                    $bigtjpg = '_t.jpg?';
                                    $bigtpng = '_t.png?';
                                    $bigtgif = '_t.gif?';
                                    $bigtbmp = '_t.bmp?';
                                    $imagecheck1 = stripos($picture, $bigjpg);
                                    $imagecheck2 = stripos($picture, $bigpng);
                                    $imagecheck3 = stripos($picture, $biggif);
                                    $imagecheck4 = stripos($picture, $bigbmp);
                                    $imagecheck5 = stripos($picture, $bigtjpg);
                                    $imagecheck6 = stripos($picture, $bigtpng);
                                    $imagecheck7 = stripos($picture, $bigtgif);
                                    $imagecheck8 = stripos($picture, $bigtbmp);

                                    if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                        //Show larger image
                                        $picture = str_replace('_s.','_b.',$picture);
                                        $picture = str_replace('_q.','_b.',$picture);
                                        $picture = str_replace('_t.','_b.',$picture);
                                    }
                                }

                                //Check whether the image is a 1x1 placeholder
                                $cff_link_image = true;
                                $cff_one_x_one = '1x1.';
                                if( stripos($news->picture, $cff_one_x_one) == true || empty($news->picture) ) $cff_link_image = false;

                                //If there's a picture accompanying the link then display it
                                if ($cff_link_image && $cff_show_media) {
                                    $cff_shared_link .= '<a class="cff-link" href="'.$link.'" '.$target.'>';
                                    $cff_shared_link .= '<img src="'. $picture .'" border="0" />';
                                    $cff_shared_link .= '</a>';
                                }
                            }

                            //Display link name and description
                            // if (!empty($news->description)) {
                                $cff_shared_link .= '<div class="cff-text-link ';
                                if (!$cff_link_image) $cff_shared_link .= 'cff-no-image';
                                //The link title:
                                $cff_shared_link .= '"><'.$cff_link_title_format.' class="cff-link-title" '.$cff_link_title_styles.'><a href="'.$link.'" '.$target.' style="color:#' . str_replace('#', '', $cff_link_title_color) . ';">'. $news->name . '</a></'.$cff_link_title_format.'>';
                                //The link source:
                                if(!empty($news->caption)) $cff_shared_link .= '<p class="cff-link-caption" style="color:#' . str_replace('#', '', $cff_link_url_color) . ';">'.$news->caption.'</p>';
                                if ($cff_show_desc) {
                                    $cff_shared_link .= $cff_description;
                                }
                                $cff_shared_link .= '</div>';
                            // }

                            $cff_shared_link .= '</div>';

                        }

                        //EVENT
                        $cff_event = '';
                        if ($cff_show_event_title || $cff_show_event_details) {
                            //Check for media
                            if ($cff_post_type == 'event') {

                                //Get the event id from the event URL. eg: http://www.facebook.com/events/123451234512345/
                                $event_url = parse_url($link);
                                $url_parts = explode('/', $event_url['path']);
                                //Get the id from the parts
                                $eventID = $url_parts[count($url_parts)-2];

                                //Get the contents of the event
                                $event_json_url = 'https://graph.facebook.com/'.$eventID.'?access_token=' . $access_token . $cff_ssl;

                                $event_json = cff_fetchUrl($event_json_url);
                                

                                //Interpret data with JSON
                                $event_object = json_decode($event_json);
                                //Picture
                                if($cff_show_media) $cff_event .= '<a title="'.$cff_facebook_link_text.'" class="cff-event-thumb" href="'.$link.'" '.$target.'><img border="0" src="https://graph.facebook.com/'.$eventID.'/picture?width=200&height=200" /></a>';

                                //Event date
                                $event_time = $event_object->start_time;
                                isset($event_object->end_time) ? $event_end_time = ' - ' . cff_eventdate(strtotime($event_object->end_time), $cff_event_date_formatting, $cff_event_date_custom) : $event_end_time = '';
                                //If timezone migration is enabled then remove last 5 characters
                                if ( strlen($event_time) == 24 ) $event_time = substr($event_time, 0, -5);
                                if (!empty($event_time)) $cff_event_date = '<p class="cff-date" '.$cff_event_date_styles.'>' . cff_eventdate(strtotime($event_time), $cff_event_date_formatting, $cff_event_date_custom) . $event_end_time.'</p>';

                                //EVENT
                                //Display the event details
                                $cff_event .= '<div class="cff-details">';
                                //show event date above title
                                if ($cff_event_date_position == 'above') $cff_event .= $cff_event_date;
                                //Show event title
                                if ($cff_show_event_title && !empty($event_object->name)) {
                                    if ($cff_event_title_link) $cff_event .= '<a href="'.$link.'" '.$target.'>';
                                    $cff_event .= '<' . $cff_event_title_format . ' ' . $cff_event_title_styles . '>' . $event_object->name . '</' . $cff_event_title_format . '>';
                                    if ($cff_event_title_link) $cff_event .= '</a>';
                                }
                                //show event date below title
                                if ($cff_event_date_position !== 'above') $cff_event .= $cff_event_date;
                                //Show event details
                                if ($cff_show_event_details){
                                    //Location
                                    if (!empty($event_object->location)) $cff_event .= '<p class="cff-where" ' . $cff_event_details_styles . '>' . $event_object->location . '</p>';
                                    //Description
                                    if (!empty($event_object->description)){
                                        $description = $event_object->description;
                                        if (!empty($body_limit)) {
                                            if (strlen($description) > $body_limit) $description = substr($description, 0, $body_limit) . '...';
                                        }
                                        $cff_event .= '<p class="cff-info" ' . $cff_event_details_styles . '>' . cff_autolink($description, $link_color=str_replace('#', '', $cff_event_link_color) ) . '</p>';
                                    }
                                }
                                $cff_event .= '</div>';
                                
                            }
                        }
                        //MEDIA
                        $cff_media = '';
                        //If it's a photo or a Featured post which is an image
                        if ($news->type == 'photo' || $news->type == 'offer' ) {
                            if ($cff_post_type == 'offer' && !empty($news->picture)){
                                $picture = $news->picture;
                                /*If the image doesn't have a _b version then the URL looks like this:
                                http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                So check for this kind of string below and don't replace _s. with _b.
                                */
                                $bigjpg = '_s.jpg?';
                                $bigpng = '_s.png?';
                                $biggif = '_s.gif?';
                                $bigbmp = '_s.bmp?';
                                $bigtjpg = '_t.jpg?';
                                $bigtpng = '_t.png?';
                                $bigtgif = '_t.gif?';
                                $bigtbmp = '_t.bmp?';
                                $imagecheck1 = stripos($picture, $bigjpg);
                                $imagecheck2 = stripos($picture, $bigpng);
                                $imagecheck3 = stripos($picture, $biggif);
                                $imagecheck4 = stripos($picture, $bigbmp);
                                $imagecheck5 = stripos($picture, $bigtjpg);
                                $imagecheck6 = stripos($picture, $bigtpng);
                                $imagecheck7 = stripos($picture, $bigtgif);
                                $imagecheck8 = stripos($picture, $bigtbmp);

                                if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                    //Show larger image
                                    $picture = str_replace('_s.','_b.',$picture);
                                    $picture = str_replace('_q.','_b.',$picture);
                                    $picture = str_replace('_t.','_b.',$picture);
                                }
                            }
                            if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                            $link_text = $cff_facebook_link_text;

                            $cff_media = '<a title="'.$link_text.'" class="cff-photo';
                            if($cff_media_position == 'above') $cff_media .= ' cff-media-above';
                            $cff_media .= '" href="';

                            //If it's an album then link the photo to the album
                            if ($cff_album) {
                                $cff_media .= $album_link;
                            } else {
                                $cff_media .= $link;
                            }
                            $cff_media .= '" '.$target.'>';

                            //Alt text
                            isset( $news->caption ) ? $cff_alt_text = $news->caption : $cff_alt_text = $cff_facebook_link_text;

                            if ($cff_album) $cff_media .= '<div class="cff-album-icon">'.$num_photos.'</div>';
                            $cff_media .= '<img src="'. $picture .'" border="0" alt="'.$cff_alt_text.'" />';
                            $cff_media .= '</a>';
                        }
                        if ($news->type == 'swf') {

                            if (!empty($news->picture)) {
                                $picture = $news->picture;

                                /*If the image doesn't have a _b version then the URL looks like this:
                                http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                So check for this kind of string below and don't replace _s. with _b.
                                */
                                $bigjpg = '_s.jpg?';
                                $bigpng = '_s.png?';
                                $biggif = '_s.gif?';
                                $bigbmp = '_s.bmp?';
                                $bigtjpg = '_t.jpg?';
                                $bigtpng = '_t.png?';
                                $bigtgif = '_t.gif?';
                                $bigtbmp = '_t.bmp?';
                                $imagecheck1 = stripos($picture, $bigjpg);
                                $imagecheck2 = stripos($picture, $bigpng);
                                $imagecheck3 = stripos($picture, $biggif);
                                $imagecheck4 = stripos($picture, $bigbmp);
                                $imagecheck5 = stripos($picture, $bigtjpg);
                                $imagecheck6 = stripos($picture, $bigtpng);
                                $imagecheck7 = stripos($picture, $bigtgif);
                                $imagecheck8 = stripos($picture, $bigtbmp);

                                if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                    //Show larger image
                                    $picture = str_replace('_s.','_b.',$picture);
                                    $picture = str_replace('_q.','_b.',$picture);
                                    $picture = str_replace('_t.','_b.',$picture);
                                }
                            }

                            $cff_swf_url = 'http://www.facebook.com/permalink.php?story_fbid='.$PostID["1"].'&amp;id='.$PostID['0'];
                            $cff_media = '<a href="'.$cff_swf_url.'" class="cff-photo';
                            if($cff_media_position == 'above') $cff_media .= ' cff-media-above';
                            $cff_media .= '" ' . $target . '><img src="' . $picture . '" border="0" /></a>';
                        }

                        if ($news->type == 'video') {

                            if (!empty($news->picture)) {
                                $picture = $news->picture;

                                /*If the image doesn't have a _b version then the URL looks like this:
                                http://photos-h.ak.fbcdn.net/hphotos-ak-prn1/v/1600273_348160658659104_383135394_s.jpg?oh=23124db338cd899962fa7fb2d7285306&oe=52D5F9BE&__gda__=1389770591_64da0df3e725ca2d1fd026b0e922c58b
                                So check for this kind of string below and don't replace _s. with _b.
                                */
                                $bigjpg = '_s.jpg?';
                                $bigpng = '_s.png?';
                                $biggif = '_s.gif?';
                                $bigbmp = '_s.bmp?';
                                $bigtjpg = '_t.jpg?';
                                $bigtpng = '_t.png?';
                                $bigtgif = '_t.gif?';
                                $bigtbmp = '_t.bmp?';
                                $imagecheck1 = stripos($picture, $bigjpg);
                                $imagecheck2 = stripos($picture, $bigpng);
                                $imagecheck3 = stripos($picture, $biggif);
                                $imagecheck4 = stripos($picture, $bigbmp);
                                $imagecheck5 = stripos($picture, $bigtjpg);
                                $imagecheck6 = stripos($picture, $bigtpng);
                                $imagecheck7 = stripos($picture, $bigtgif);
                                $imagecheck8 = stripos($picture, $bigtbmp);

                                if ( !($imagecheck1 || $imagecheck2 || $imagecheck3 || $imagecheck4 || $imagecheck5 || $imagecheck6 || $imagecheck7 || $imagecheck8) ) {
                                    //Show larger image
                                    $picture = str_replace('_s.','_b.',$picture);
                                    $picture = str_replace('_q.','_b.',$picture);
                                    $picture = str_replace('_t.','_b.',$picture);
                                }
                            }

                            // url of video
                            $url = $news->source;
                            
                            //Check whether it's a youtube video
                            if($youtube || $youtu || $youtubeembed) {
                                //Get the unique video id from the url by matching the pattern
                                if ($youtube || $youtubeembed) {
                                    if (preg_match("/v=([^&]+)/i", $url, $matches)) {
                                        $id = $matches[1];
                                    }   elseif(preg_match("/\/v\/([^&]+)/i", $url, $matches)) {
                                        $id = $matches[1];
                                    }   elseif(preg_match("/\/embed\/([^&]+)/i", $url, $matches)) {
                                        $id = $matches[1];
                                    }
                                } elseif ($youtu) {
                                    $id = end(explode('/', $url));
                                }
                                $id = substr($id, 0, strrpos($id, '?'));
                                // this is your template for generating embed codes
                                $code = '<iframe class="youtube-player" type="text/html" src="https://www.youtube.com/embed/{id}" allowfullscreen frameborder="0"></iframe>';
                                // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                $code = str_replace('{id}', $id, $code);
                                $cff_media = '<div class="cff-iframe-wrap"';
                                if(!empty($cff_video_height)) $cff_media .= 'style="height: '. $cff_video_height . '"';
                                $cff_media .= '>' . $code . '</div>';

                            //Check whether it's a vimeo
                            } else if(stripos($url, $vimeo) !== false) {
                                if (isset($news->source)) {
                                    //http://vimeo.com/moogaloop.swf?clip_id=101557016&autoplay=1
                                    $query = parse_url($news->source, PHP_URL_QUERY);
                                    parse_str($query, $params);
                                    $clip_id = $params['clip_id'];

                                    $cff_media = '<div class="cff-iframe-wrap"';
                                    if(!empty($cff_video_height)) $cff_media .= 'style="height: '. $cff_video_height . '"';
                                    $cff_media .= '><iframe src="https://player.vimeo.com/video/'.$clip_id.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
                                }
                            //Else link to the video file
                            } else {
                                //Show play button over video thumbnail
                                $vid_link = $news->source;
                                //Check whether the video source contains an mp4, as the HTML5 video player can't play any other type
                                $cff_mp4_check = stripos($vid_link, '.mp4');

                                if ($cff_video_action == 'facebook') $vid_link = $link;

                                //Title & alt text
                                isset( $news->name ) ? $vid_title = $news->name : $vid_title = $cff_facebook_link_text;

                                if (empty($picture)) {
                                    $cff_is_video_embed = true;
                                    $cff_media = '<a class="cff-playbtn-solo" title="' . $vid_title . '" href="' . $vid_link . '" target="_blank"><i class="fa fa-play cff-playbtn no-poster"></i></a>';
                                }

                                //If the video action is file then add the HTML5 video tags
                                if ($cff_video_action !== 'facebook' && $cff_mp4_check) $cff_media = '<div class="cff-html5-video"><a href="javascript:void(0);" class="cff-html5-play"><i class="fa fa-play cff-playbtn"></i></a><video src="'.$vid_link.'" poster="'.$picture.'" >';
                                $cff_media .= '<a title="' . $vid_title . '" class="cff-vidLink" href="' . $link . '" '.$target.'><i class="fa fa-play cff-playbtn"></i><img class="cff-poster" src="' . $picture . '" alt="' . $vid_title . '" /></a>';
                                if ($cff_video_action !== 'facebook' && $cff_mp4_check) $cff_media .= '</video></div>';

                            }
                            //Add the name to the description if it's a video embed
                            if($cff_is_video_embed) {
                                $cff_description = '<div class="cff-desc-wrap ';
                                if (empty($picture)) $cff_description .= 'cff-no-image';
                                $cff_description .= '"><'.$cff_link_title_format.' class="cff-link-title" '.$cff_link_title_styles.'><a href="'.$link.'" '.$target.' style="color:#' . str_replace('#', '', $cff_link_title_color) . ';">'. $news->name . '</a></'.$cff_link_title_format.'>';

                                if (!empty($body_limit)) {
                                    if (strlen($description_text) > $body_limit) $description_text = substr($description_text, 0, $body_limit) . '...';
                                }

                                $cff_description .= '<p class="cff-post-desc" '.$cff_body_styles.'><span>' . cff_autolink( htmlspecialchars($description_text) ) . '</span></p></div>';
                            }
                        }
                        //META
                        //how many comments are there?
                        $comment_count = 0;
                        $comment_count_display = '0';
                        if (!empty($news->comments)) {
                            $comment_count = count($news->comments->data);
                            $comment_count_display = $comment_count;
                            if ($comment_count > 20) $comment_count_display = '<div class="cff-loader fa-spin"></div><span class="cff-replace">20+</span>';
                        }

                        $cff_meta_total = '<div class="cff-meta-wrap">';
                        //Check for likes
                        $cff_meta = '';
                        $cff_meta .= '<a href="javaScript:void(0);" class="cff-view-comments" ' . $cff_meta_styles . '><ul class="cff-meta ';
                        $cff_meta .= $cff_icon_style;
                        $cff_meta .= '"><li class="cff-likes"><span class="cff-icon">Likes:</span> <span class="cff-count">';
                        //How many likes are there?
                        if (!empty($news->likes)) {
                            $like_count = count($news->likes->data);
                        } else {
                            $like_count = '0';
                        }
                        //If there is no likes then display zero
                        if ($like_count == 0) {
                            $cff_meta .= '0';
                        } else if ($like_count < 25) {
                            $cff_meta .= $like_count;
                        } else {
                            $cff_meta .= '<div class="cff-loader fa-spin"></div>';
                            $cff_meta .= '<span class="cff-replace">' . $like_count . '+</span>';
                        }
                        //Check for shares
                        $cff_meta .= '</span></li><li class="cff-shares"><span class="cff-icon">Shares:</span> <span class="cff-count">';
                        if (empty($news->shares->count)) { $cff_meta .= '0'; }
                            else { $cff_meta .= $news->shares->count; }
                        //Check for comments
                        $cff_meta .= '</span></li><li class="cff-comments"><span class="cff-icon">Comments:</span> <span class="cff-count">';
                        //How many comments are there?
                        $cff_meta .= $comment_count_display;
                        $cff_meta .= '</span></li></ul></a>';
                        //Display the link to the Facebook post or external link
                        $cff_link = '';
                        //Default link
                        $cff_viewpost_class = 'cff-viewpost-facebook';
                        if ($cff_facebook_link_text == '') $cff_facebook_link_text = 'View on Facebook';
                        $link_text = $cff_facebook_link_text;

                        //Link to the Facebook post if it's a link or a video
                        if($cff_post_type == 'link' || $cff_post_type == 'video') $link = "https://www.facebook.com/" . $page_id . "/posts/" . $PostID[1];


                        if ($cff_post_type == 'offer') $link_text = 'View Offer';
                        $cff_link = '<a class="' . $cff_viewpost_class . '" href="' . $link . '" title="' . $link_text . '" ' . $target . ' ' . $cff_link_styles . '>' . $link_text . '</a>';
                        
                        //Compile the meta and link if included
                        if ($cff_show_link) $cff_meta_total .= $cff_link;
                        if ($cff_show_meta) $cff_meta_total .= $cff_meta;
                        $cff_meta_total .= '</div>';
                        $cff_comments = '';

                        if (!isset($cff_translate_view_previous_comments_text) || empty($cff_translate_view_previous_comments_text)) $cff_translate_view_previous_comments_text = 'View previous comments';
                        if (!isset($cff_translate_comment_on_facebook_text) || empty($cff_translate_comment_on_facebook_text)) $cff_translate_comment_on_facebook_text = 'Comment on Facebook';
                        if (!isset($cff_translate_likes_this_text) || empty($cff_translate_likes_this_text)) $cff_translate_likes_this_text = 'likes this';
                        if (!isset($cff_translate_like_this_text) || empty($cff_translate_like_this_text)) $cff_translate_like_this_text = 'like this';
                        if (!isset($cff_translate_and_text) || empty($cff_translate_and_text)) $cff_translate_and_text = 'and';
                        if (!isset($cff_translate_other_text) || empty($cff_translate_other_text)) $cff_translate_other_text = 'other';
                        if (!isset($cff_translate_others_text) || empty($cff_translate_others_text)) $cff_translate_others_text = 'others';


                        //Create the comments box
                        $cff_comments .= '<div class="cff-comments-box ' . $cff_icon_style;
                        if( $comment_count == 0 || $cff_comments_num == 0 ) $cff_comments .= ' cff-no-comments';
                        $cff_comments .= '"';

                        //Expand comments box initially
                        if( $cff_expand_comments ) $cff_comments .= ' style="display: block;"';
                        //Number of comments to show initially
                        $cff_comments .= ' rel="' . $cff_comments_num . '"';
                        $cff_comments .= '>';
                        
                        //Get the likes
                        if (!empty($news->likes->data)){

                            $liker_one = '';
                            $liker_two = ''; 

                            if ( $news->likes->data[0] ) $liker_one = '<a href="https://facebook.com/'.$news->likes->data[0]->id.'" '.$cff_meta_link_color.' '.$target.'>' . $news->likes->data[0]->name . '</a>';
                            if ( $like_count > 1 ) $liker_two = '<a href="https://facebook.com/'.$news->likes->data[1]->id.'" '.$cff_meta_link_color.' '.$target.'>' . $news->likes->data[1]->name . '</a>';

                            if ($like_count > 0) $cff_comments .= '<p class="cff-comment-likes cff-likes" ' . $cff_meta_styles . '><span class="cff-icon"></span>';
                            if ($like_count == 1){
                                $cff_comments .= $liker_one.' '.$cff_translate_likes_this_text;
                            } else if ($like_count == 2){
                                $cff_comments .= $liker_one.' '.$cff_translate_and_text.' '.$liker_two.' '.$cff_translate_like_this_text;
                            } else if ($like_count == 3){
                                $cff_comments .= $liker_one.', '.$liker_two.' '.$cff_translate_and_text.' 1 '.$cff_translate_other_text.' '.$cff_translate_like_this_text;
                            } else {
                                $cff_comments .= $liker_one.', '.$liker_two.' '.$cff_translate_and_text.' ';
                                if ($like_count == 25) $cff_comments .= '<span class="cff-comment-likes-count">';
                                $cff_comments .= intval($like_count)-2;
                                if ($like_count == 25) $cff_comments .= '</span>';
                                $cff_comments .= ' '.$cff_translate_others_text.' '.$cff_translate_like_this_text;
                            }
                            if ($like_count > 0) $cff_comments .= '</p>';

                        }

                        //Show more comments
                        if ( $comment_count > $cff_comments_num ) $cff_comments .= '<p class="cff-comments cff-show-more-comments" ' . $cff_meta_styles . '><a href="javascript:void(0);" '.$cff_meta_link_color.'><span class="cff-icon"></span>'.$cff_translate_view_previous_comments_text.'</a></p>';

                        //Get the comments
                        if (!empty($news->comments->data)){
                            //Give the comment an index so we know which one it is
                            $comment_index = 0;

                            //Loop through comments
                            foreach ($news->comments->data as $comment_item ) {
                                $comment_likes = $comment_item->like_count;
                                $comment = htmlspecialchars($comment_item->message);

                                //MESSAGE TAGS
                                if( $cff_post_tags && isset($comment_item->message_tags) ){

                                    //Loop through the tags and use the name to replace them
                                    foreach($comment_item->message_tags as $message_tag ) {
                                        if( isset($message_tag->name) ) {
                                            $tag_name = $message_tag->name;
                                            $tag_link = '<a href="http://facebook.com/' . $message_tag->id . '" '.$target.' '.$cff_meta_link_color.'>' . $tag_name . '</a>';

                                            $comment = str_replace($tag_name, $tag_link, $comment);
                                        }
                                    }

                                } //END MESSAGE TAGS

                                //Create comments
                                $cff_comments .= '<div class="cff-comment" id="'.$comment_item->from->id.'" ' . $cff_meta_styles . '>';

                                $cff_comments .= '<div class="cff-comment-text-wrapper">';
                                $cff_comments .= '<div class="cff-comment-text';
                                if( $cff_hide_comment_avatars ) $cff_comments .= ' cff-no-image';
                                $cff_comments .= '"><a href="https://facebook.com/'. $comment_item->from->id .'" class="cff-name" '.$target.' ' . $cff_meta_link_color . '>' . $comment_item->from->name . '</a>' . cff_autolink( $comment, $link_color=str_replace('#', '', $cff_meta_link_color) );
                                $cff_comments .= '<span class="cff-time">';
                                $cff_comments .= cff_timeSince(strtotime($comment_item->created_time), $date_translate_arr) . ' ' . $cff_date_after;
                                if ( $comment_likes > 0 ) $cff_comments .= '<span class="cff-comment-likes">&nbsp; &middot; &nbsp;<b></b>' . $comment_likes . '</span>';
                                $cff_comments .= '</span>';
                                $cff_comments .= '</div>'; //End .cff-comment-text
                                $cff_comments .= '</div>'; //End .cff-comment-text-wrapper

                                $cff_comments .= '<div class="cff-comment-img"><a href="https://facebook.com/'. $comment_item->from->id .'" '.$target. '>';

                                //Only load the comment avatars if they're being displayed initially, otherwise load via JS on click
                                if( !$cff_hide_comment_avatars ){
                                    if( $cff_expand_comments && ($comment_index >= $comment_count - $cff_comments_num) ) {
                                        $cff_comments .= '<img src="https://graph.facebook.com/'.$comment_item->from->id.'/picture" width=32 height=32>';
                                    } else {
                                        $cff_comments .= '<img width=32 height=32>';
                                    }
                                }

                                $cff_comments .= '</a></div>';
                                $cff_comments .= '</div>'; //End .cff-comment

                                $comment_index++;
                            }
                            
                        }
                        $cff_comments .= '<p class="cff-comments cff-comment-on-facebook" ' . $cff_meta_styles . '><a href="'.$link.'" '.$target.' '.$cff_meta_link_color.'><span class="cff-icon"></span>'.$cff_translate_comment_on_facebook_text.'</a></p>';
                        $cff_comments .= '</div>';
                        
                        //Compile comments if meta is included
                        if ($cff_show_meta) $cff_meta_total .= $cff_comments;


                        //**************************//
                        //***CREATE THE POST HTML***//
                        //**************************//
                        //Start the container
                        $cff_post_item .= '<div class="cff-item ';
                        if ($cff_post_type == 'link') $cff_post_item .= 'cff-link-item';
                        if ($cff_post_type == 'event') $cff_post_item .= 'cff-timeline-event';
                        if ($cff_post_type == 'photo') $cff_post_item .= 'cff-photo-post';
                        if ($cff_post_type == 'video') $cff_post_item .= 'cff-video-post';
                        if ($cff_is_video_embed) $cff_post_item .= ' cff-embedded-video';
                        if ($cff_post_type == 'swf') $cff_post_item .= 'cff-swf-post';
                        if ($cff_post_type == 'status') $cff_post_item .= 'cff-status-post';
                        if ($cff_post_type == 'offer') $cff_post_item .= 'cff-offer-post';
                        if ($cff_album) $cff_post_item .= ' cff-album';
                        if ($cff_post_bg_color_check) $cff_post_item .= ' cff-box';
                        $cff_post_item .=  ' author-'. cff_to_slug($news->from->name) .'" id="'. $news->id .'" ' . $cff_item_styles . '>';

                        //POST AUTHOR
                        $cff_is_video_embed = false;
                        if($cff_is_video_embed){
                            if($cff_show_author) $cff_post_item .= $cff_author;
                            //DATE ABOVE
                            if ($cff_show_date && $cff_date_position == 'above') $cff_post_item .= $cff_date;
                            //If embedded video then show post text above the wrapper
                            if($cff_show_text) $cff_post_item .= $cff_post_text;
                            
                            $cff_post_item .= '<div class="cff-embed-wrap">';
                        }

                        //Start text wrapper
                        if ( ($cff_thumb_layout || $cff_half_layout) && !empty($news->picture) ) $cff_post_item .= '<div class="cff-text-wrapper">';
                            //POST AUTHOR
                            if($cff_show_author && !$cff_is_video_embed) $cff_post_item .= $cff_author;
                            //MEDIA
                            if($cff_show_media && $cff_media_position == 'above'){
                                $cff_post_item .= $cff_media;
                            }
                            //DATE ABOVE
                            if ($cff_show_date && $cff_date_position == 'above' && !$cff_is_video_embed) $cff_post_item .= $cff_date;
                            //POST TEXT
                            if($cff_show_text && !$cff_is_video_embed) $cff_post_item .= $cff_post_text;
                            //DESCRIPTION
                            if($cff_show_desc && $cff_post_type != 'offer' && $cff_post_type != 'link') $cff_post_item .= $cff_description;
                            //LINK
                            if($cff_show_shared_links) $cff_post_item .= $cff_shared_link;
                            //DATE BELOW
                            if ( (!$cff_show_author && $cff_date_position == 'author') || $cff_show_date && $cff_date_position == 'below' && !$cff_is_video_embed ) {
                                if($cff_show_date && $cff_post_type !== 'event') $cff_post_item .= $cff_date;
                            }

                        //End text wrapper
                        if ( ($cff_thumb_layout || $cff_half_layout) && !empty($news->picture) ) $cff_post_item .= '</div>';
                        
                        //EVENT
                        if($cff_show_event_title || $cff_show_event_details) $cff_post_item .= $cff_event;
                        //MEDIA
                        if($cff_show_media && $cff_media_position !== 'above') {
                            $cff_post_item .= $cff_media;
                            if($cff_is_video_embed) $cff_post_item .= '</div>';
                        }
                        //DATE BELOW
                        if ($cff_show_date && $cff_date_position == 'below' && $cff_is_video_embed) $cff_post_item .= $cff_date;
                        if($cff_show_date && $cff_post_type == 'event' && ($cff_date_position == 'below' || ($cff_date_position == 'author' && !$cff_show_author) ) ){
                            $cff_post_item .= $cff_date;
                        }
                        //META
                        if($cff_show_meta || $cff_show_link) $cff_post_item .= $cff_meta_total;
                        //End the post item
                        $cff_post_item .= '</div>';
                        // $cff_post_item .= '<div class="cff-clear"></div>';

                    } // End !$cff_photos_only
                    

                    //ALBUMS ONLY
                    if($cff_albums_only && $cff_albums_source == 'photospage'){

                        //GROUP ALBUMS
                        if($cff_is_group){
                            //Cover photos aren't available for group albums
                            $cff_post_item = '<div class="cff-album-item cff-col-';
                            $cff_post_item .= $cff_album_cols;
                            $cff_post_item .= '">';
                            $cff_post_item .= '<h4><a href="' . $news->link . '" '.$target.'>' . $news->name . '</a></h4>';
                            $cff_post_item .= '</div>';

                            //Group albums use 'created' instead of 'created_time' like other posts
                            $post_time = $news->created;
                        } else {
                            ( isset($news->cover_photo) ) ? $thumb = 'https://graph.facebook.com/' . $news->cover_photo . '/picture' : $thumb = '';

                            $cff_post_item = '<div class="cff-album-item cff-col-';
                            $cff_post_item .= $cff_album_cols;
                            $cff_post_item .= '">';
                            $cff_post_item .= '<a href="' . $news->link . '" class="cff-album-cover" '.$target.'><img src="'.$thumb.'" alt="' . $news->name . '" /></a>';
                            if($cff_show_album_title || $cff_show_album_number) $cff_post_item .= '<div class="cff-album-info">';
                            if($cff_show_album_title) $cff_post_item .= '<h4><a href="' . $news->link . '" '.$target.'>' . $news->name . '</a></h4>';
                            if( $cff_show_album_number && isset($news->count) ) $cff_post_item .= '<p>' . $news->count . ' photos</p>';
                            if($cff_show_album_title || $cff_show_album_number) $cff_post_item .= '</div>';
                            $cff_post_item .= '</div>';

                            //If there's no photos in the album then don't show it
                            if( !isset($news->cover_photo) ) $cff_post_item = '';
                        }
                        
                    }

                    if($cff_photos_only){
                        //PHOTOS ONLY
                        $cff_post_item = '<div class="cff-album-item cff-col-'.$cff_photos_cols.'">';
                        $cff_post_item .= '<a href="'.$news->link.'" class="cff-album-cover" '.$target.'><img src="'. $news->src_big .'" /></a>';
                        $cff_post_item .= '</div>';

                        if($cff_is_group){
                            //FOR GROUPS
                            $post_time = $news->created;
                            $cff_posts_array = cff_array_push_assoc_photos($cff_posts_array, $i, $cff_post_item, $post_time);
                        } else {
                            //FOR PAGES
                            $cff_content .= $cff_post_item;
                        }                        

                    } else {
                        //PUSH POSTS TO ARRAY
                        $cff_posts_array = cff_array_push_assoc($cff_posts_array, $post_time, $cff_post_item);
                    }
                    

                } // End post type check
                if (isset($news->message)) $prev_post_message = $news->message;
                if (isset($news->link))  $prev_post_link = $news->link;
                if (isset($news->description))  $prev_post_description = $news->description;
            } // End the loop

            
            if($cff_photos_only){
                //PHOTOS ONLY
                usort($cff_posts_array, 'sortByOrder');
            } else {
                //Sort the array in reverse order (newest first)
                krsort($cff_posts_array);
            }

        } // End ALL POSTS


    } // END PAGE_IDS LOOP

    //Output the posts array
    if($cff_photos_only){
        //PHOTOS ONLY
        $p = 0;
        foreach ($cff_posts_array as $post ) {
            if ( $p == $show_posts ) break;
            $cff_content .= $post['post'];
            $p++;
        }
    } else {
        $p = 0;
        foreach ($cff_posts_array as $post ) {
            if ( $p == $show_posts ) break;
            $cff_content .= $post;
            $p++;
        }
    }

    //Reset the timezone
    date_default_timezone_set( $cff_orig_timezone );
    //Add the Like Box inside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && !$cff_like_box_outside) $cff_content .= $like_box;
    //End the feed
    $cff_content .= '</div><div class="cff-clear"></div>';
    //Add the Like Box outside
    if ($cff_like_box_position == 'bottom' && $cff_show_like_box && $cff_like_box_outside) $cff_content .= $like_box;

    //Pass linkhashtags var via JS
    ($cff_link_hashtags == 'true' || $cff_link_hashtags == 1) ? $cff_link_hashtags = 'true' : $cff_link_hashtags = 'false';
    if($cff_title_link == 'true' || $cff_title_link == 1) $cff_link_hashtags = 'false';
    $cff_content .= '<script type="text/javascript">var cffpath = "' . $settings[ 'path' ] . '", cfflinkhashtags = "' . $cff_link_hashtags . '";</script>';

    //If using Ajax then add JS file to end of the content
    if ($cff_ajax) $cff_content .= '<script type="text/javascript" src="' . $settings[ 'path' ] . '/core/js/cff.js?2"></script>';

    $cff_content .= '</div>';
    
    //Return our feed HTML to display
    echo $cff_content;
}


//FUNCTIONS
function sortByOrder($a, $b) {
    return $b['post_time'] - $a['post_time'];
}

//Get JSON object of feed data
function cff_fetchUrl($url){
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
    } elseif ( ini_get('allow_url_fopen') || ini_get('allow_url_fopen') == 1 || ini_get('allow_url_fopen') === TRUE ) {
        $feedData = @file_get_contents($url);
    } else {
        echo "Please enable either <b>'cURL'</b> or <b>'allow_url_fopen'</b> in your server php.ini file.";
    }
    
    if(isset($feedData)) return $feedData;
}

//Make links into span instead when the post text is made clickable
function cff_wrap_span($text) {
    $pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
    return preg_replace_callback($pattern, 'cff_wrap_span_callback', $text);
}
function cff_wrap_span_callback($matches) {
    $max_url_length = 50;
    $max_depth_if_over_length = 2;
    $ellipsis = '&hellip;';
    $target = 'target="_blank"';
    $url_full = $matches[0];
    $url_short = '';
    if (strlen($url_full) > $max_url_length) {
        $parts = parse_url($url_full);
        $url_short = $parts['scheme'] . '://' . preg_replace('/^www\./', '', $parts['host']) . '/';
        $path_components = explode('/', trim($parts['path'], '/'));
        foreach ($path_components as $dir) {
            $url_string_components[] = $dir . '/';
        }
        if (!empty($parts['query'])) {
            $url_string_components[] = '?' . $parts['query'];
        }
        if (!empty($parts['fragment'])) {
            $url_string_components[] = '#' . $parts['fragment'];
        }
        for ($k = 0; $k < count($url_string_components); $k++) {
            $curr_component = $url_string_components[$k];
            if ($k >= $max_depth_if_over_length || strlen($url_short) + strlen($curr_component) > $max_url_length) {
                if ($k == 0 && strlen($url_short) < $max_url_length) {
                    // Always show a portion of first directory
                    $url_short .= substr($curr_component, 0, $max_url_length - strlen($url_short));
                }
                $url_short .= $ellipsis;
                break;
            }
            $url_short .= $curr_component;
        }
    } else {
        $url_short = $url_full;
    }
    return "<span class='cff-break-word'>$url_short</span>";
}

function cff_mb_substr_replace($string, $replacement, $start, $length=NULL) {
    if (is_array($string)) {
        $num = count($string);
        // $replacement
        $replacement = is_array($replacement) ? array_slice($replacement, 0, $num) : array_pad(array($replacement), $num, $replacement);
        // $start
        if (is_array($start)) {
            $start = array_slice($start, 0, $num);
            foreach ($start as $key => $value)
                $start[$key] = is_int($value) ? $value : 0;
        }
        else {
            $start = array_pad(array($start), $num, $start);
        }
        // $length
        if (!isset($length)) {
            $length = array_fill(0, $num, 0);
        }
        elseif (is_array($length)) {
            $length = array_slice($length, 0, $num);
            foreach ($length as $key => $value)
                $length[$key] = isset($value) ? (is_int($value) ? $value : $num) : 0;
        }
        else {
            $length = array_pad(array($length), $num, $length);
        }
        // Recursive call
        return array_map(__FUNCTION__, $string, $replacement, $start, $length);
    }
    preg_match_all('/./us', (string)$string, $smatches);
    preg_match_all('/./us', (string)$replacement, $rmatches);
    if ($length === NULL) $length = mb_strlen($string);
    array_splice($smatches[0], $start, $length, $rmatches[0]);
    return join($smatches[0]);
}

//Display date - used for posts
function cff_getdate($original, $date_format, $custom_date, $date_translate_arr) {

    switch ($date_format) {
        
        case '2':
            $print = date('F jS, g:i a', $original);
            break;
        case '3':
            $print = date('F jS', $original);
            break;
        case '4':
            $print = date('D F jS', $original);
            break;
        case '5':
            $print = date('l F jS', $original);
            break;
        case '6':
            $print = date('D M jS, Y', $original);
            break;
        case '7':
            $print = date('l F jS, Y', $original);
            break;
        case '8':
            $print = date('l F jS, Y - g:i a', $original);
            break;
        case '9':
            $print = date("l M jS, 'y", $original);
            break;
        case '10':
            $print = date('m.d.y', $original);
            break;
        case '11':
            $print = date('m/d/y', $original);
            break;
        case '12':
            $print = date('d.m.y', $original);
            break;
        case '13':
            $print = date('d/m/y', $original);
            break;

        default:
            
            $periods = array(
                $date_translate_arr['$cff_translate_second'],
                $date_translate_arr['$cff_translate_minute'],
                $date_translate_arr['$cff_translate_hour'],
                $date_translate_arr['$cff_translate_day'],
                $date_translate_arr['$cff_translate_week'],
                $date_translate_arr['$cff_translate_month'],
                $date_translate_arr['$cff_translate_year'],
                "decade"
            );
            $periods_plural = array(
                $date_translate_arr['$cff_translate_seconds'],
                $date_translate_arr['$cff_translate_minutes'],
                $date_translate_arr['$cff_translate_hours'],
                $date_translate_arr['$cff_translate_days'],
                $date_translate_arr['$cff_translate_weeks'],
                $date_translate_arr['$cff_translate_months'],
                $date_translate_arr['$cff_translate_years'],
                "decade"
            );

            $lengths = array("60","60","24","7","4.35","12","10");
            $now = time();
            
            // is it future date or past date
            if($now > $original) {    
                $difference = $now - $original;
                $tense = $date_translate_arr['$cff_translate_ago'];
            } else {
                $difference = $original - $now;
                $tense = $date_translate_arr['$cff_translate_ago'];
            }
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            if($difference != 1) {
                $periods[$j] = $periods_plural[$j];
            }
            $print = "$difference $periods[$j] {$tense}";
            break;
        
    }
    if ( !empty($custom) ){
        $print = date($custom, $original);
    }
    return $print;
}

//Display date in event format
function cff_eventdate($original, $date_format, $custom_date) {
    switch ($date_format) {
        
        case '2':
            $print = date('F jS, g:ia', $original);
            break;
        case '3':
            $print = date('g:ia - F jS', $original);
            break;
        case '4':
            $print = date('g:ia, F jS', $original);
            break;
        case '5':
            $print = date('l F jS - g:ia', $original);
            break;
        case '6':
            $print = date('D M jS, Y, g:iA', $original);
            break;
        case '7':
            $print = date('l F jS, Y, g:iA', $original);
            break;
        case '8':
            $print = date('l F jS, Y - g:ia', $original);
            break;
        case '9':
            $print = date("l M jS, 'y", $original);
            break;
        case '10':
            $print = date('m.d.y - g:iA', $original);
            break;
        case '11':
            $print = date('m/d/y, g:ia', $original);
            break;
        case '12':
            $print = date('d.m.y - g:iA', $original);
            break;
        case '13':
            $print = date('d/m/y, g:ia', $original);
            break;

        default:
            $print = date('F j, Y, g:ia', $original);
            break;
    }
    if ( !empty($custom_date) ){
        $print = date($custom_date, $original);
    }
    return $print;
}


//Time stamp function - used for comments
function cff_timeSince($original, $date_translate_arr) {
            
    $periods = array(
        $date_translate_arr['$cff_translate_second'],
        $date_translate_arr['$cff_translate_minute'],
        $date_translate_arr['$cff_translate_hour'],
        $date_translate_arr['$cff_translate_day'],
        $date_translate_arr['$cff_translate_week'],
        $date_translate_arr['$cff_translate_month'],
        $date_translate_arr['$cff_translate_year'],
        "decade"
    );
    $periods_plural = array(
        $date_translate_arr['$cff_translate_seconds'],
        $date_translate_arr['$cff_translate_minutes'],
        $date_translate_arr['$cff_translate_hours'],
        $date_translate_arr['$cff_translate_days'],
        $date_translate_arr['$cff_translate_weeks'],
        $date_translate_arr['$cff_translate_months'],
        $date_translate_arr['$cff_translate_years'],
        "decade"
    );

    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    
    // is it future date or past date
    if($now > $original) {    
        $difference = $now - $original;
        $tense = $date_translate_arr['$cff_translate_ago'];
    } else {
        $difference = $original - $now;
        $tense = $date_translate_arr['$cff_translate_ago'];
    }
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j] = $periods_plural[$j];
    }
    return "$difference $periods[$j] {$tense}";
            
}

//Verify license against database
global $cff_license;
function cff_verify_license( $data ) {

    $api_params = array(
        'url'           => $data['url'],
        'license'       => $data['license'],
        'name'          => $data['item_name']
    );
    $validate = array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params );
    $request = false;
    if ($validate == 'valid') $request = file_get_contents( $api_params['url'] . '/' . $api_params['name'] );

    if ( $request ):
        $request = json_decode( remote_retrieve_body( $request ) );
        if( $request && $validate )
            $request->sections = unserialize( $request->sections );
        return $request;
    else:
        return false;
    endif;
}

cff_verify_license( array(
        'url'       => 'https://license.smashballoon.com',
        'license'   => $cff_license,
        'item_name' => 'Custom Facebook Feed Standalone Version',
        'author'    => 'Smash Balloon'
    )
);
function cff_system_info(){
    $info = '<h4><u>System Info:</u></h4>';
    $info .= '<p>PHP Version: <b>' . PHP_VERSION .'</b></p>';
    $info .= 'Web Server Info: <b>' . $_SERVER["SERVER_SOFTWARE"] . '</b></p>';

    //allow_url_fopen
    $info .= '<p>PHP allow_url_fopen: <b>';
    if (ini_get( "allow_url_fopen" ) ) {
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }   
    $info .= '</b></p>';

    //cURL
    $info .= '<p>PHP cURL: <b>';
    if ( is_callable("curl_init") ) {
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }
    $info .= '</b></p>';

    //JSON
    $info .= '<p>JSON: <b>';
    if ( function_exists("json_decode") ){
        $info .= '<span style="color: green;">Yes</span>';
    } else {
        $info .= '<span style="color: red;">No</span>';
    }
    $info .= '</b></p>';
    echo $info;
}

//Use custom stripos function if it's not available (only available in PHP 5+)
if(!is_callable('stripos')){
    function stripos($haystack, $needle){
        return strpos($haystack, stristr( $haystack, $needle ));
    }
}
function cff_stripos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, ltrim($what) ))!==false) return $pos;
    }
    return false;
}
//Push to assoc array
function cff_array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
}
//Convert string to slug
function cff_to_slug($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

?>

<?php //Link to the plugin stylesheets ?>
<link rel="stylesheet" type="text/css" href="<?php echo $fbfeed_path ?>/core/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $fbfeed_path ?>/core/css/cff.css?20">