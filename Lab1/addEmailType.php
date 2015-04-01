<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
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
        <?php
        
        $util = new Util();
        $validator = new Validator();
        
        $emailType = filter_input(INPUT_POST, 'emailtype');
        
        $errors = array();
        
        $dbConfig = array("DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',"DB_USER"=>'root',"DB_PASSWORD"=>'');
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
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
        
        
        
        ?>
        
        <h3>Add An Email Type</h3>
        <form action="#" method="post">
            <label>Enter An Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder=""/>
            <input type="submit" value="Submit" />
        </form>
        
        <?php
        
        $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
        
        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value)
            {
                if($value["active"] > 0)
                {
                    echo '<p><strong>', $value['emailtype'], '</strong></p>';
                }
                else
                {
                    echo '<p>', $value['emailtype'], '</p>';
                }
            }
    }   else 
        {
            echo '<p>No Data</p>';
        }
        
        ?>
        
    </body>
</html>
