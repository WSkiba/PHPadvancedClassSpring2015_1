<?php

namespace API\models\services;

use API\models\interfaces\IDAO;
use API\models\interfaces\IModel;
use API\models\interfaces\ILogging;
use \PDO;

class UserDAO extends BaseDAO implements IDAO{
    public function __construct(PDO $db, IModel $model,ILogging $log) {
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    public function idExisit($id){
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT userid FROM user WHERE userid = :userid");
        if($stmt->execute(array(':userid' => $id)) && $stmt->rowCount() > 0 ){
            return true;
        }
        return false;
    }
    public function read($id){
        $model = clone $this-getModel();
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT userid, email, username, thepassword, admin, active WHERE userid = :userid");
        if($stmt->execute(array(':userid' => $id)) && $stmt->rowCount() > 0){
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $model->map($results);
        }
        return $model;
    }
    public function create(IModel $model){
        $db = $this->getDB();
        $binds = array(":email" => $model->getUser(),
                       ":username" => $model->getUser(),
                       ":thepassword" => $model->getPassword(),
                       ":admin" => $model->getAdmin(),
                       ":active" => $modeel->getActive(),
                       );
        if(!$this->idExist($model->getUserid())){
            $stmt = $db->prepare("INSERT INTO user SET email = :email, username = :username, thepassword = :thepassword, admin = :admin, active = :active");
            if($stmt->execute($binds) && $stmt->rowCount() > 0){
                return true;
            }
        }
        return false;
    }
    public function update(IModel $model) {      
        $db = $this->getDB();
        $binds = array( ":email" => $model->getEmail(),
                       ":username" => $model->getUser(),
                       ":thepassword" => $model->getPassword(),
                       ":admin" => $model->getAdmin(),
                       ":active" => $modeel->getActive(),
                       ":userid" => $model->getUserid()
                    );
        if($this->idExisit($model->getUserid())){
            $stmt = $db->prepare("UPDATE user SET email = :email, username = :username, thepassword = :thepassword, admin = :admin, active = :active WHERE userid = :userid ");
            if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }            
        }
        return false;
    }
        public function delete($id) {
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM user WHERE userid = :userid");
        if ( $stmt->execute(array(':userid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         return false;
    }     
    public function getAllRows() {
       $db = $this->getDB();
       $values = array();
       $stmt = $db->prepare("SELECT userid, email, username, password, admin, active FROM user");
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        $stmt->closeCursor();
        return $values;
    }
}

