<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Controller\PluginManager;
use MStripe;
use MCommons\Controller\AbstractRestfulController;
use MCommons\StaticOptions;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model\JsonModel;
use Zend\Mvc\MvcEvent;

class TestController extends AbstractRestfulController {

    public function getList() {
        //$object = new StaticOptions();
        //$config = $object->getConfig();
        $config = $this->getConfig();
        print_r($config['notification']);die;
        //echo "ADSD";die;
        $data = $this->initFacebook();
        // print_r($data);die;
        //self::initGoogle();
        // self::initGoogleAnalytics();
        // self::initPubnub();
        //self::initRedis();
        //self::initMongodb();
        // self::initTwitter();
        // self::initStripe();
        // self::initNetcore();
        // 
        //  self::initAws();
        return $data;
    }

//    public function setEventManager(EventManagerInterface $events) {
//        parent::setEventManager($events);
//        $events->attach('dispatch', array($this, 'getConfig'), 10);
//    }
//
//    public function getConfig($event) {
//        $config = $event->getApplication()->getServiceManager()->get('Config');
//        print_r($config);
//        die;
//        // print_r($config);die;
//        return $config;
//    }

    public function initFacebook() {
        $config = $this->getConfig();
        print_r($config);die;
        //$config = \MCommons\StaticOptions::getGlobalConfig();
        //print_r($config);die;
        //echo "dsadsa";die;
        $array = ["name" => "manoj", "age" => 26];
        //echo "saadsdas";die;
        return $array;
//        $sl = $e->getApplication()->getServiceManager();
//        var_dump($sl);die;
//        $config = $sl->get('config');
//        
//        
//        $services = new ServiceManager();
//        //$services->setAllowOverride(true);
//        $services->get($name);
//        $services->setService('config', $this->updateConfig($services->get('config')));
//        var_dump($services);die;
//        $services->setService(AlbumTable::class, $this->mockAlbumTable()->reveal());
//
//        $services->setAllowOverride(false);
//        $serviceManager = new ServiceManager([
//    'factories' => [
//        stdClass::class => InvokableFactory::class,
//    ],
//]);
//        $facebookObject = new \Facebook\Facebook([
//            'app_id' => facebook_facebook_app_key,
//            'app_secret' => facebook_app_secret,
//            'default_graph_version' => '',
//        ]);
//        var_dump($facebookObject);
        // die;
    }

    protected function updateConfig($config) {
        $config['db'] = [];

        return $config;
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
        var_dump($client);
        die;
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
        var_dump($pubnub);
        die;
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

    public static function initMongodb() {
        $mongo = new \Zend\Session\SaveHandler\MongoDB($mongoClient, $options);
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

        $collection = new MongoDB\Collection($manager, "testcollection", "items");
        $initialCollectionCount = $collection->count();
    }

    public static function initTwitter() {
        $twitterObject = new \TwitterOAuth(TWITTER_APP_KEY, TWITTER_SECRET_KEY);
        var_dump($twitterObject);
        die;
        //$twitteroauth = new TwitterOAuth(TWITTER_APP_KEY, TWITTER_SECRET_KEY, $twitter_auth_token, $twitter_auth_secret_token);
        // $access_token = $twitterObject->getAccessToken($oauth_verifier);
        //$user_info = $twitterObject->get('account/verify_credentials');
    }

    public static function initStripe() {
        try {
            $stripeModel = new \MStripe();
            var_dump($stripeModel);
        } catch (\Exception $ex) {
            echo "dasds";
            die;
            throw new \Exception($ex->getMessage(), 400);
        }

//        \Stripe_Customer::retrieve($id);
//        echo "dadasd";die;
//        $get = \Stripe::getApiKey();
//        $stripe = \Stripe::setApiKey(stripe_secret_key);
//        var_dump($stripe);
        //$stripeObject = new \Stripe_Card();
    }

    public static function initNetcore() {
        //echo "asdasd";die;
        $netcore = new \Netcore();
        echo $netcore;
        die;
        //$event = $netcore->uploadEvent($data);
        var_dump($netcore);
        die;
    }

    public static function initResque() {
        
    }

    public static function initAws() {
        $config = ['version' => 'latest', 'region' => 'us-east-1'];

        $aws = new Aws\Resource\Aws($config);
        var_dump($aws);
        die;
        $s3 = $aws->s3;
    }

}
