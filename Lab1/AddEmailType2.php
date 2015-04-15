<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
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
        
        $emailDisplaySave = new EmailTypeDB();
        $emailDisplaySave->save($emailType);
        
        
        ?>
        
        <h3>Add An Email Type</h3>
        <form action="#" method="post">
            <label>Enter An Email Type:</label>
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder=""/>
            <input type="submit" value="Submit" />
        </form>
        
        <?php
        
        $emailDisplaySave->DisplayEmail();
        
        ?>
        
    </body>
</html>