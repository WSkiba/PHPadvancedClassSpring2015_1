<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailDAO
 *
 * @author 001288282
 */
class EmailDAO implements IDAO {
    
    private $DB = null;
    
    public function __construct ( PDO $db ){
        $this->setDB($db);
    }
    
    private function setDB( PDO $DB ){
        $this->DB = $DB;
    }
    
    private function getDB() {
        return $this->DB;
    }
    
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT emailid FROM email WHERE emailid = :emailid");
         
        if ( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function getById($id) {
        $model = new EmailModel();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT email.emailid, email.email, email. emailtypedid, emailtype.emailtypeid, email.emailtype, email.active as emailtypeactive, email.logged, email.lastupdated, email.active FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid WHERE emailid = :emailid");
        
        if ( $stmt->execute(array(':emaild' => $id)) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $model->map($results);
        }        
        
        return $model;
    }
    
    public function save(IModel $model) {
        $db = $this->getDB();
        
        $values = array(":email" => $model->getEmail(),
                          ":active" => $model->getActive(),
                          ":emailtypeid" => $model->getEmailtypeid());
        if($this->idExisit($model->getEmailid())){
            $values[":emailid"] = $model->getEmailid();
            $stmt = $db->prepare("UPDATE email SET email = :email, emailtypeid = :emailtypeid, active = :active, lastupdated = now(), WHERE email id = :emailid");
        }
        else {
            $stmt = $db->prepare("INSERT INTO email SET email = :email, emailtypeid = :emailtypeid, active = :active, logged = now(), lastupdated = now()");
        }
        
        if($stmt->execute($values) && $stmt->rowCount() > 0){
            return true;
        }
        return false;
    }
    
    public function delete($id){
        
        $db = $this->getDB();
        $stmt = $db->prepare("DELETE FROM email WHERE emailid = :emailid");
        
        if( $stmt->execute(array(':emailid' => $id)) && $stmt->rowCount() > 0){
            return true;
        }
        
        return false;
    }
    
    public function getAllRows() {
        
        
        $values = array();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT email.emailid, email.email, email.emailtypeid, emailtype.emailtype, emailtype.active as emailtypeactive, email.logged, email.lastupdated, email.active FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = new EmailModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {
            
        }
        $stmt->closeCursor();         
        return $values;
    }
}
