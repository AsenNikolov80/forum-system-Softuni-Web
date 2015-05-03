Здравей,
<?php
echo htmlspecialchars($this->userLogged['fullname']);
?>
<div>
    <a href="<?= ROOT_URL . 'secure/edit' ?>">Редакция на профила</a>
</div>