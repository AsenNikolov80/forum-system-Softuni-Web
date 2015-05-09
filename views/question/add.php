<?php if (isset($_SESSION['errorMsg'])) {    ?>
    <div id="errorDiv"><?= $_SESSION['errorMsg']; ?></div>
    
    <?php unset($_SESSION['errorMsg']);
}
?>
<form action="" method="POST" class="addQuestion">
    <div><div>Title:</div> <input type="text" name="title" required/></div>
    <div><div>Description:</div> <textarea name="text" required></textarea></div>
    <div>
        <div>Category: </div>
        <select name="categoryId" required >
            <option selected value="0">Choose category</option>
            <?php foreach ($categories as $key => $value) { ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php }
            ?>
        </select>
    </div>
    <div>
        <div>Tags:</div> <input type="text" name="tags" required pattern="[a-zA-Zа-яА-Я ,]{1,}"/>

    </div>
    <div style="text-align: center"><input type="submit" name="add" value="Ask question" required/></div>
    <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" />
</form>