<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

class TestController extends AbstractRestfulController {

    public function getList() {
        self::initFacebook();
        //self::initGoogle();
       // self::initGoogleAnalytics();
       // self::initPubnub();
       // self::initTwitter();
      // self::initStripe();
       //self::initRedis();
      // self::initNetcore();
      //  self::initMongodb();
     // 
     //self::initAws();
    }

    public static function initFacebook() {
        $config = $this->application()->getSettings();
        var_dump($config);die;
        $facebookObject = new \Facebook\Facebook([
            'app_id' => facebook_facebook_app_key,
            'app_secret' => facebook_app_secret,
            'default_graph_version' => '',
        ]);
        var_dump($facebookObject);
        die;
    }

    public static function initGoogle() {
        $googleObject = new \Google_Client();
        $googleObject->setApplicationName('Munchado');
        $googleObject->setScopes(array(
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/plus.me'
        ));
        $googleObject->setClientId(google_client_id);
        $googleObject->setClientSecret(google_client_secret);
        $googleObject->setRedirectUri(PROTOCOL . google_redirect_uri);
        $googleObject->setDeveloperKey(google_developer_key);
        $googleObject->setApprovalPrompt('auto');
        $googlePlusObject = new \Google_Service_Plus($googleObject);
        var_dump($googlePlusObject);
        die;
        //$this->googleplus = new \Google_Service_Plus($this->googleclient);
    }
    
    public static function initGoogleAnalytics() {
        $client = new \Google_Client();
            $client->setApplicationName('demomunch');
            $object = new \Google_Service_Analytics($client);
            $scopes = array(\Google_Service_Analytics::ANALYTICS_READONLY);
            $client->setScopes($scopes);
        var_dump($client);die;
        //$this->googleplus = new \Google_Service_Plus($this->googleclient);
    }
   public static function initPubnub() {
        $pnConfiguration = new \PubNub\PNConfiguration();
        $pnConfiguration->setSubscribeKey(PUBNUB_SUBSCRIBE_KEY);
        $pnConfiguration->setPublishKey(PUBNUB_PUBLISH_KEY);
        $pnConfiguration->setSecure(false);
        $pubnub = new \PubNub\PubNub($pnConfiguration);
        
        /*         * *****publish********* */

//        $result = $pubnub->publish()
//                ->channel("my_channel")
//                ->message(["hello", "there"])
//                ->usePost(true)
//                ->sync();
//
//        /*         * *****subscribe********* */
//        $pubnub->subscribe()
//                ->channels("my_channel")
//                ->execute();
        var_dump($pubnub);die;
    }
    
    public static function initTwitter() {
        $oauth_token = '';
        $oauth_token_secret = '';
        $twitterObject = new \TwitterOAuth(TWITTER_APP_KEY, TWITTER_SECRET_KEY, $oauth_token, $oauth_token_secret);
        var_dump($twitterObject);die;
        //$twitteroauth = new TwitterOAuth(TWITTER_APP_KEY, TWITTER_SECRET_KEY, $twitter_auth_token, $twitter_auth_secret_token);
       // $access_token = $twitterObject->getAccessToken($oauth_verifier);
        //$user_info = $twitterObject->get('account/verify_credentials');
    }

    public static function initStripe() {
        $get = \Stripe::getApiKey();
        $stripe = \Stripe::setApiKey(stripe_secret_key);
        var_dump($stripe);die;
        //$stripeObject = new \Stripe_Card();
    }

    public static function initRedis() {
        $redis = new \Zend\Cache\Storage\Adapter\Redis();
        if ($redis) {
            //$redisConfig = $config['constants']['redis'];
            try {
                $redis_options = new \Zend\Cache\Storage\Adapter\RedisOptions();
                $redis_options->setServer($redisConfig);
                $redis_options->setLibOptions(array(
                    \Redis::OPT_SERIALIZER => \Redis::SERIALIZER_PHP
                ));
                $redis_cache = new \Zend\Cache\Storage\Adapter\Redis($redis_options);
                $space = $redis_cache->getTotalSpace();
            } catch (\Exception $ex) {
                $redis_cache = false;
            }
        }
        var_dump($redis);
        die;
    }

    public static function initNetcore() {
        //echo "asdasd";die;
        $netcore = new \Netcore();
        echo $netcore;die;
        //$event = $netcore->uploadEvent($data);
        var_dump($netcore);die;
    }

    public static function initMongodb() {
        $mongo = new \Zend\Session\SaveHandler\MongoDB($mongoClient, $options);
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

        $collection = new MongoDB\Collection($manager, "testcollection", "items");
        $initialCollectionCount = $collection->count();
    }

    public static function initResque() {
        
    }

   
    public static function initAws() {
        $config = ['version' => 'latest', 'region' => 'us-east-1'];

        $aws = new Aws\Resource\Aws($config);
        var_dump($aws);die;
        $s3 = $aws->s3;
    }

}
