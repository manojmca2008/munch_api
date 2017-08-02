<?php
namespace Search;


use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Application\Util\Translator;
use Zend\Validator\AbstractValidator;
use Zend\I18n\Translator\Resources;

class Module implements ConfigProviderInterface 
{
    public function onBootstrap(MvcEvent $e)
    {
        $translator = Translator::factory([ 'locale' => 'pt_BR', ]);
        $translator->addTranslationFilePattern(
            'phparray', // WARNING, NO UPPERCASE
            Resources::getBasePath(),
            Resources::getPatternForValidator()
        );
        AbstractValidator::setDefaultTranslator($translator);
    }
    
    public function getConfig() 
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() 
    {
        return [
            'factories' => [
                
            ],
        ];
    }

    public function getControllerConfig() 
    {
        return [
            'factories' => [
                Controller\SearchController::class => function($container) {
                    return new Controller\SearchController();
                },
            ],
        ];
    }

}