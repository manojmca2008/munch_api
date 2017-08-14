<?php

namespace City;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\CityTable::class        => function ($container) {
                    $tableGateway = $container->get('Model\CityTableGateway');
                    return new Model\CityTable($tableGateway);
                },
                'Model\CityTableGateway' => function ($container) {
                    $dbAdapter          = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\City());

                    return new TableGateway('cities', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\CityController::class => function ($container) {
                    return new Controller\CityController(
                        $container->get(Model\CityTable::class)
                    );
                },
            ],
        ];
    }
}