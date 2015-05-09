<?php if (isset($_SESSION['errorMsg'])) {    ?>
    <div id="errorDiv"><?= $_SESSION['errorMsg']; ?></div>
    
    <?php unset($_SESSION['errorMsg']);
}
?>
<form method="POST">
    <h1>Login here</h1>
    <input type="text" name="username" placeholder="Username..." />
    <input type="password" name="password" placeholder="Password..." />
    <input type="submit" name="login" value="Login!"/>
    <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" />
</form>