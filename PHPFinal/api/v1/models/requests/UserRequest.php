<?php

namespace API\models\services;

use API\models\interfaces\IRequest;
use API\models\interfaces\IService;
use API\models\interfaces\IModel;

class UserRequest implements IRequest {
    protected  $service;
    
    public function __construct(IService $service) {
        $this->service = $service;
    }
    public function POST(IModel $model){
        $userModel = $this->service->getNewUserModel();
        $userModel->map($model->getRequestData());
        if($this->service->create($userModel)){
            throw new ContentCreatedException('Created');
        }
        $errors = $this->service->validate($userModel);
        if(count($errors) > 0){
            throw new ValidationException($errors, 'User Not Created');
        }
        throw new ConflictRequestException('User Not Created');
    }
    public function GET(IModel $model){
        $id = intval($model->getId());
        if($id > 0) {
            if($this->service->idExist($model->getId())){
                return $this->service->read($model-getId())->getAllPropteries();
            } else {
                throw new NoContentRequestException($id . ' ID does not exist');
            }
        }
        $data = $this->service->getAllRows();
        $values = array();
        foreach ($data as $value) {
            $values[] = $value->getAllPropteries();
        }
        return $values;
    }
    public function PUT(IModel $model){
        $id = intval($model->getId());
        $userModel = $this->service->getNewUserModel();
        $userModel->map($model->getRequestData());
        $userModel->setUserid($id);
        if(!$this->service->idExist($id)){
            throw new NoContentRequestException($id . ' ID does not exist');
        }
        if($this->service->update($userModel)){
            throw new ContentCreatedException('Created');
        }
        $errors = $this->service->validate($userModel);
        if(count($errors) > 0){
            throw new ValidationException($errors, 'User Not Updated');
        }
        throw new ConflictRequestException('New User Not Update On ID ' . $id);
    }
    public function DELETE(IModel $model) {
        $id = intval($model->getId());
        if($this->service->delete($id)) {
            return null;
        }
        throw new ConflictRequestException($id . ' ID User Not Deleted');
    }
}