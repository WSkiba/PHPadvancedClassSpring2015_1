<?php


class IndexController extends BaseController implements IController {
    public function __construct() {
    }
    
    public function execute(IService $scope) { 
        $this->data["HELLO!"] = 'test';
        $scope->view = $this->data;
        return $this->view('index', $scope);
    }
}
