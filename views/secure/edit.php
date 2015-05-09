<?php if (isset($_SESSION['errorMsg'])) {    ?>
    <div id="errorDiv"><?= $_SESSION['errorMsg']; ?></div>
    
    <?php unset($_SESSION['errorMsg']);
}
?>
<form action="" method="POST">
    <table>
        <thead>
            <tr>
                <th>Property</th>
                <th>Old data</th>
                <th>Enter new data</th>
            </tr>
        </thead>
        <?php
        foreach ($this->userLogged as $key => $value) {
            if ($key != 'id') {
                ?>
                <tr>
                    <td><?= $key; ?></td>
                    <td><?= htmlspecialchars($value); ?></td>
                    <?php if ($key == 'email') { ?>
                        <td><input type="email" name="<?= $key ?>" placeholder="<?= $key ?>..." /></td>
                    <?php } else { ?>
                        <td><input type="text" name="<?= $key ?>" placeholder="<?= $key ?>..." /></td>
                    <?php }
                    ?>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    <input type="submit" name="edit" />
    <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" />
</form>