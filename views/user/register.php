<?php if (isset($_SESSION['errorMsg'])) {    ?>
    <div id="errorDiv"><?= $_SESSION['errorMsg']; ?></div>
    
    <?php unset($_SESSION['errorMsg']);
}
?>
<form method="POST" action="<?=ROOT_URL.'user/register'?>">
    <h1>Register here!</h1>
        
    <input type="text" name="fullname" placeholder="Full name..." required/>
    <input type="email" name="email" placeholder="Email..." required/>
    <input type="text" name="username" placeholder="Username..." required/>
    <input type="password" name="password" placeholder="password..." required/>
    <input type="password" name="password2" placeholder="retype password..." required/>
    <input type="submit" name="register" value="Register" />
    <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" />
</form>