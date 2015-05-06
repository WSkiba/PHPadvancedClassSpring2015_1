<?php
    include'./bootstrap.php';
    
    $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
    $dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');   
    $pdo = new DB($dbConfig);
    $emaildao = new EmailTypeDAO($pdo->getDB());
    
    $emaildao->delete($emailtypeid);
    header('Location:emailtype-test.php');



