<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeService
 *
 * @author 001288282
 */
class EmailTypeService {
    
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailTypeDAO;
    private $_EmailTypeModel;
    
    public function __construct($db, $util, $validator, $emailTypeDAO, $emailtypeModel) {
        $this->_DB = $db;
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailTypeDAO = $emailTypeDAO;
        $this->_EmailTypeModel = $emailtypeModel;
    }
    
    public function saveFrom(){
        if (!$this->_Util->isPostRequest()){
            return false;
        }
        
        $this->validateForm();
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } 
        else {
            if (  $this->_EmailTypeDAO->save($this->_EmailTypeModel) ) {
                echo 'Email Added';
            } else {
                echo 'Email could not be added Added';
            }
           
        }
    }
    
    public function validateForm(){
        if($this->_Util->isPostRequest()){
            $this->_errors = array();
            if( !$this->_Validator->emailTypeIsValid($this->_EmailTypeModel->getEmailtype()) ) {
                 $this->_errors[] = 'Email Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_EmailTypeModel->getActive()) ) {
                 $this->_errors[] = 'Active is invalid';
            } 
        }
    }
    public function displayErrors() {
       
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
         
    }
    public function hasErrors() {        
        return ( count($this->_errors) > 0 );        
    }
    public function displayEmails() {        
       
        $stmt = $this->_DB->prepare("SELECT * FROM emailtype");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['emailtype'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
    }
    
}
