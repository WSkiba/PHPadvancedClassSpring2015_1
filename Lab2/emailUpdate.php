<!DOCTYPE html>
<?php
include'./bootstrap.php';
$util= new Util();



$dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');     
$pdo = new DB($dbConfig);     
$db = $pdo->getDB();

$emailModel = new EmailModel();
$emaildao = new EmailDAO($db);
$emailTypeDao = new EmailTypeDao($db);

if($util->isPostRequest()){
    $emailid = filter_input(INPUT_GET, 'emailid');
    $emailModel->setEmailid($emailid);
    
    $emailEntered = filter_input(INPUT_POST,'email');
    $emailModel->setEmail($emailEntered);
    
    $emailActive = filter_input(INPUT_POST, 'active');
    $emailModel->setActive($emailActive);
    
    $emailTypeEntered = filter_input(INPUT_POST, 'emailtypeid');
    $emailModel->setEmailtypeid($emailTypeEntered);
    
    $emaildao->save($emailModel);
    header('Location:email-test.php');
    
}else{
    $emailid = filter_input(INPUT_GET, 'emailid');
    $emailModel = $emaildao->getById($emailid);
    $emailEntered = $emailModel->getEmail();
    $emailActive = $emailModel->getActive();
    $emailTypeEntered = $emailModel->getEmailtype();
            
}

?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3>Add Email</h3>
        <form action="#" method="post">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $emailEntered; ?>" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $emailActive; ?>" />
            <br /><br />
            <label>Email Type:</label>
            <select name="emailtypeid" value="<?php echo $emailTypeEntered; ?> ">
            <?php 
                $emailTypes = $emailTypeDao->getAllRows();
                $emaildao->displayEmailtypeSelect($emailTypes, $emailModel->getEmailtypeid());
            ?>
            </select>
            <br /><br />
            <input type="submit" value="Submit" action="#"/>
        </form>
    </body>
</html>
