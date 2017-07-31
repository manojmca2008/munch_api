<?php
namespace User\Controller;

use User\Form\UserForm;
use User\InputFilter\FormUserFilter;
use User\Model\UserTable;
use User\Model\User;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\EventManager\EventManagerInterface;
//use MCommons\Controller\AbstractRestfulController;
use MCommons\StaticOptions;

class UserController extends AbstractRestfulController 
{

    private $table;

    public function __construct(UserTable $table) 
    {   
        $this->table = $table;
    }

    public function getList() 
    { //echo "dsads";die;
        //var_dump($this->getConfig());die;
        //$this->getConfig();
        $users = $this->table->fetchAll();
        $data = $userArr = [];
        $i = 0;
        foreach($users as $user) {
            $data[] = [
                //'codigo_torcedor' => $user->codigo_torcedor,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email
            ];
            $i++;
        }
        //print_r($data);die;
        if(!empty($data)){
            return new JsonModel($data);
        }
    }

    public function get($id) 
    {
        $data = ['name'=>"manoj","age"=>25];
        return new JsonModel($data);
        //return $data;
        $id = (int) $id;

        if (0 === $id) {
            $dataArr['status'] ='erro';
            $dataArr['message'] = 'Torcedor não existe';
            return new JsonModel($dataArr);
        }

        $objUser = $this->table->getUser($id);
   
        if (empty($objUser)) {
            $dataArr['status'] ='erro';
            $dataArr['message'] = 'Torcedor não existe';
            $dataArr['torcedorDetalhes'] = [];
            return new JsonModel($dataArr);
        }

        $data[] = [
            'nome' => $objUser->nome,
            'email' => $objUser->email
        ];
        
        $dataArr['status'] ='sucesso';
        $dataArr['message'] = 'Detalhes do torcedor estão disponíveis';
        $dataArr['torcedorDetalhes'] = $data;
        return new JsonModel($dataArr);

    }

    public function create($data) 
    {
        $form = new UserForm();
        $request = $this->getRequest();

        $inputfilter = new FormUserFilter();
        $form->setInputFilter($inputfilter);
        $form->setData($request->getPost());

        $dataArr=[];
        if ($form->isValid()) {
            $user = new User();
            $user->exchangeArray($form->getData());
            $this->table->saveUser($user);
            $dataArr['status'] ='sucesso';
            $dataArr['message'] = 'Torcedor adicionado com sucesso!';
            return new JsonModel($dataArr);
        }

        $dataArr['status'] ='erro';
        $messages = $form->getMessages();

        if (!empty($messages)) {
            $dataArr['message'] = $messages;    
        }

        return new JsonModel($dataArr);
    }

    public function update($id, $data) 
    {

        $id = (int) $id;

        $dataArr=[];
        if (0 === $id) {
            $dataArr['status'] ='erro';
            $dataArr['message'] = 'Torcedor não existe';
            return new JsonModel($dataArr);
        }

        $form = new UserForm();

        $inputfilter = new FormUserFilter();
        $form->setInputFilter($inputfilter);
        $data['id'] = $id;
        $form->setData($data);

        if ($form->isValid()) {
            $user = new User();
            $user->exchangeArray($form->getData());
            try{
                $this->table->saveUser($user);
                $dataArr['status'] ='sucesso';
                $dataArr['message'] = 'Torcedor atualizado com sucesso!';
                return new JsonModel($dataArr);
            } catch (\Exception $e) {
                $dataArr['status'] ='erro';
                $dataArr['message'] = 'Torcedor não existe';
                return new JsonModel($dataArr);
            }
        }

        $dataArr['status'] ='erro';
        $messages = $form->getMessages();

        if (!empty($messages)) {
            $dataArr['message'] = $messages;    
        }

        return new JsonModel($dataArr);

    }

    public function delete($id) 
    {
        $id = (int) $id;

        $dataArr=[];
        if (0 === $id) {
            $dataArr['status'] ='erro';
            $dataArr['message'] = 'Torcedor não existe';
            return new JsonModel($dataArr);
        }

        $user = $this->table->getUser($id);

        if($user){
            $this->table->deleteUser($id);
            $dataArr['status'] ='sucesso';
            $dataArr['message'] = 'Torcedor excluído com sucesso!';
            return new JsonModel($dataArr);
        }

        $dataArr['status'] ='erro';
        $dataArr['message'] = 'Torcedor não existe';
        return new JsonModel($dataArr);

    }
    public function setEventManager(EventManagerInterface $events) {
        parent::setEventManager($events);
        $events->attach('dispatch', array($this, 'getConfig'), 10);
    }

    public function getConfig() {
        $event = $this->getEvent();
        $config = $event->getApplication()->getServiceManager()->get('config');
        return $config;
    }

}