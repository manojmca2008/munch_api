<?php
namespace Search;


use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Application\Util\Translator;
use Zend\Validator\AbstractValidator;
use Zend\I18n\Translator\Resources;
use Zend\Mvc\ModuleRouteListener;
use Zend\View\Model\JsonModel;

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
        
        
        
        /* ----------------  Error Handler Code [ starts : Athar]------------------ */
        /*$eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'), 0);
        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, array($this, 'onRenderError'), 0);*/
        
        /* ----------------  Error Handler Code [ ends : Athar]  ------------------ */ 
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
                Controller\MobSearchController::class => function($container) {
                    return new Controller\MobSearchController();
                }        
            ],
        ];
    }
    
    
    public function onDispatchError($e)
    {
        return $this->getJsonModelError($e);
    }

    public function onRenderError($e)
    {
        return $this->getJsonModelError($e);
    }

    public function getJsonModelError($e)
    {   
        $error = $e->getError();
        if (!$error) {
            return;
        }

        $response = $e->getResponse();
        $exception = $e->getParam('exception');
        $exceptionJson = array();
        if ($exception) {
            $exceptionJson = array(
                'class' => get_class($exception),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'stacktrace' => $exception->getTraceAsString(),
                'errorCode' => $exception->getCode()
            );
        }

        $errorJson = array(
            'message'   => 'An error occurred during execution; please try again later.',
            'error'     => $error,
            'exception' => $exceptionJson,
        );
        if ($error == 'error-router-no-match') {
            $errorJson['message'] = 'Resource not found.';
        }
        
        $finalOutput = array();
        $finalOutput['status']      = 'failure';
        $finalOutput['code']        = '200';
        $finalOutput['data']        = [];
        $finalOutput['errors']      = array($errorJson);
        $finalOutput['msg']         = 'Something went wrong! please try after sometime';
        $finalOutput['has_error']   = 1;
        $finalOutput['time']        = date('d-m-y h:i:s',time());
        
        $model = new JsonModel($finalOutput);

        $e->setResult($model);

        return $model;
    }

}