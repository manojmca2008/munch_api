<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return [
    'db' => [
        'driver' => 'Pdo',
        'username' => 'manoj',
        'password' => 'abc@123',
        'dsn' => 'mysql:dbname=test;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ],
    'notification' => array(
        'sender' => 'notifications@munchado.com',
        'name' => 'Munch Ado'
    ),
    'pintrest' => array(
        'pintrest_url' => 'http://pinterest.com/munchado/feed.rss',
        'repin_url' => 'http://www.pinterest.com/pin/create/button/'
    ),
    'twitter' => array(
        'twitter_url' => 'http://www.twitter.com/',
        'twitterfeed_url' => 'https://api.twitter.com/1.1/statuses/user_timeline.json',
        'retweet_url' => 'https://twitter.com/intent/retweet'
    ),
    'facebook' => array(
        'facebook_url' => 'https://graph.facebook.com/',
        'facebookshare_url' => 'http://www.facebook.com/sharer.php'
    ),
    'google+' => array(
        'googleplus_url' => 'https://www.googleapis.com/plus/v1/people/',
        'googleshare_url' => 'https://plus.google.com/share'
    ),
    'blog' => array(
        'blog_url' => 'http://blog.munchado.com/feed/'
    ),
    'instagram' => array(
        'instagram_url' => 'https://api.instagram.com/v1/users'
    ),
    'resque-service' => 1, // 1 - enabled, 0 - disabled
    'clevertap_service'=>1,
    'resque-service-dashboard'=>1,
    'resque-service-salesmanago'=>0,
    'activity-log'=>0,
    's3' => array(

        'key' => 'AKIAISDHDHDHD3334EOWAQ',
        'secret' => 'Vral4B9NjB4BqnhAb/EuzCNyx/gTzjDhh6aoPILu',

        //'key' => 'sadsadsfdsfdsf',
        //'secret' => 'dsfsfsdfsdf/EuzCNyx/gTzjDhh6aoPILu',

        'acl' => 'public_read', // public_read, public_read_write, private
        'bucket_name' => 'munch_images'
    )
];
