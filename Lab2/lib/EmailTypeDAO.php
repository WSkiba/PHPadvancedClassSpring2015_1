<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeDAO
 *
 * @author 001288282
 */
class EmailTypeDAO implements IDAO{
    
    private $DB = null;
    
    public function __construct(PDO $db){
        $this->setDB($db);
    }
    
    function getDB() {
        return $this->DB;
    }

    function setDB($DB) {
        $this->DB = $DB;
    }

     public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
         
        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function getById($id) {
        $model = new EmailTypeModel();
        $db = $this->getDB();
        
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
        
        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);            
         }
         return $model;
    }
    
    public function save(IModel $model) {
        $db = $this->getDB();
        
        $values = array(":emailtype" => $model->getEmailtype(),
                        ":active" => $model->getActive());
        
        if($this->idExisit($model->getEmailtypeid())){
            $values[":emailtypeid"] = $model->getEmailtypeid();
            $stmt = $db->prepare("UPDATE emailtype SET emailtype = :emailtype, active = :active WHERE emailtypeid = :emailtypeid");
        }
        else{
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype, active = :active");
        }
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
         }
         
         return false;
    }
    
    public function delete($id){
        $db = $this->getDb();
        $stmt = $db->prepare("DELETE FROM emailtype WHERE emailtypeid = :emailtypeid");
        
        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
    
    public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value) {
               $model = new EMAILTypeModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        else{
            
        }     
        
        $stmt->closeCursor();         
        return $values;
    }
}
