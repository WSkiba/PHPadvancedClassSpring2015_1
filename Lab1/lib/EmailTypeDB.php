
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailTypeDB
 *
 * @author 001288282
 */
class EmailTypeDB {  
    public function save($emailType){
        
        $util = new Util();
        $validator = new Validator();
        
        
        $errors = array();
        
        $db=$this->db();
        
        if ( $util->isPostRequest() )
        {
            if ( !$validator->emailTypeIsValid($emailType) ) 
            {
                $errors[] = 'Email type is not valid';
            }
        }
        
        if (count($errors) > 0)
        {
            foreach ($errors as $value)
            {
                echo '<p>',$value,'</p>';
            }
        }
        else
        {
            $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");
            
            $values = array(":emailtype"=>$emailType);
            
            if($stmt->execute($values) && $stmt->rowCount() > 0)
            {
            echo 'Email Added';
            }
    }
    }
    public function DisplayEmail(){ 
        $db = $this->db();
        $stmt = $db->prepare("SELECT * FROM emailtype");
        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value)
            {
                if($value["active"] > 0)
                {
                    echo '<p><strong>',$value['emailtype'],'</strong></p>';
                }
                else
                {
                    echo '<p>', $value['emailtype'],'</p>';
                }
            }
    }   else 
        {
            echo '<p>No Data</p>';
        }
    }
    
    public function db(){
        $dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        return $db;
    }
}
