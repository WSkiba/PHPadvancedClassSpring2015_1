<?php

include'./bootstrap.php';
$util= new Util();

$dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');     
$pdo = new DB($dbConfig);     
$db = $pdo->getDB();

$emailTypeModel = new EmailTypeModel();
$emailTypeDAO = new EmailTypeDAO($db);

if($util->isPostRequest()){
    $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
    $emailTypeModel->setEmailtypeid($emailtypeid);
    $emailTypeEntered = filter_input(INPUT_POST, 'emailtype');
    $emailTypeModel->setEmailtype($emailTypeEntered);
    $emailTypeActive = filter_input(INPUT_POST, 'active');
    $emailTypeModel->setActive($emailTypeActive);
    
    $emailTypeDAO->save($emailTypeModel);
    
    header('Location:emailtype-test.php');
}else{
    $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
    $emailTypeModel = $emailTypeDAO->getById($emailtypeid);
    $emailTypeEntered = $emailTypeModel->getEmailtype();
    $emailTypeActive = $emailTypeModel->getActive();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
        <h3>Add Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailTypeEntered; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $emailTypeActive; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>