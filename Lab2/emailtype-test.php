<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
            
            $emailType = filter_input(INPUT_POST, 'emailtype');
            $active = filter_input(INPUT_POST, 'active');
            
            $util = new Util();
            $emailTypeDAO = new EmailTypeDAO($db);
            
            if ( $util->isPostRequest() ) {
                $validator = new Validator(); 
                $errors = array();
                if( !$validator->emailTypeIsValid($emailType) ) {
                    $errors[] = 'Email Type is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }

                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                
                    $emailtypeModel = new EmailTypeModel();
                    $emailtypeModel->setActive($active);
                    $emailtypeModel->setEmailtype($emailType);
                    
      
                    if ( $emailTypeDAO->save($emailtypeModel) ) {
                        echo 'Email Added';
                    }   
                }   
            }
            ?>
        
         <h3>Add Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         <?php         
             
            $emailTypes = $emailTypeDAO->getAllRows();
            foreach ($emailTypes as $value) {
                echo '<p>',$value->getEmailtype(),'</p>';
            }
         ?>
    </body>
</html>
