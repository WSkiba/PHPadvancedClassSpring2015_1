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
        
        $displayEmails = new EmailTypeDB();
        $emailType = filter_input(INPUT_POST, 'emailtype');
        
        $displayEmails->save($emailType);
        
        ?>
        
        <h3>Add An Email Type</h3>
        <form action="#" method="post">
            <label>Enter An Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder=""/>
            <input type="submit" value="Submit" />
        </form>
        
        <?php
        
        $displayEmails->DisplayEmail();
        
        ?>
        
    </body>
</html>
