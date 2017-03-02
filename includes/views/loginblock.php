<?php if(is_auth()):?>
Hello, <?= get_user_login() ?>.
<form method="post">
    <input type="submit" name="logout" value="exit"/>
</form>
<?php else: ?>
<?php include 'authform.php';?>
<?php endif;