<?php
    include'./bootstrap.php';
    
    $emailid = filter_input(INPUT_GET, 'emailid');
    $dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');   
    $pdo = new DB($dbConfig);
    $emaildao = new EmailDAO($pdo->getDB());
    
    $emaildao->delete($emailid);
    header('Location:email-test.php')
?>

