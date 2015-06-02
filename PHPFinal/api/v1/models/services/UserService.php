<?php

namespace API\models\services;

use API\models\interfaces\IDAO;
use API\models\interfaces\IService;
use API\models\interfaces\IModel;

class UserService implements IService{
    protected $userDAO;
    protected $userTypeService;
    protected $validator;
    protected $model;
    
    function setValidator(){
        $this->validator = $validator;
    }
    function getValidator(){
        return $this-validator;
    }
    function setUserDAO(IDAO $DAO){
        $this->userDAO = $DAO;
    }
    function getUserDAO(){
        return $this->userDAO;
    }
    //function setUserTypeService(IService $service){
    //    $this->userTypeService = $service;
    //}
    //function getUserTypeService(){
    //    $this->userTypeService = $service;
    //}
    function setModel(IModel $model){
        $this->model = $model;
    }
    function getModel(){
        return $this->model;
    }
    public function __construct(IDAO $userDAO, /*IService $userTypeService,*/ IService $validator, IModel $model) {
       $this->setUserDAO($userDAO);
    //   $this->setUserTypeService($userTypeService);
       $this->setValidator($validator);
       $this->setModel($model);
    }
    public function idExist($id){
        return $this->getUserDAO()->idExisit($id);
    }
    public function create(IModel $model){
        if(count($this->validate($model)) === 0) {
            return $this->getUserDAO()->create($model);
        }
        return false;
    }
    public function read($id){
        return $this->getUserDAO()->read($id);
    }
    public function update(IModel $model){
        if(count($this->validate($model)) === 0) {
            return $this->getUserDAO()->update($model);
        }
        return false;
    }
    public function delete($id){
        return $this->getUserDAO()->delete($id);
    }
    public function getNewUserModel(){
        return clone $this->getModel();
    }
    public function validate(IModel $model) {
        $errors = array();
    //    if(!$this->getUserTypeService()->idExist($model->getUsertypeid()) ) {
    //        $errors[] = 'User Type is invalid';
    //    }
        if(!$this->getValidator()->UserIsValid($model->getUser()) ) {
            $errors[] = 'User is invalid';
        }       
        if(!$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'User active is invalid';
        }
        return $errors;
    }
    public function getAllUserTypes(){
        return $this->getUserTypeService()->getAllRows();
    }
    public function getAllRows(){
        return $this->getUserDAO()->getAllRows();
    }
}
