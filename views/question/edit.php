<link href="<?= ROOT_URL . 'css/style.css'; ?>" rel="stylesheet" type="text/css"/>
<form action="<?= ROOT_URL . 'question/edit/'.$question['id'] ?>" method="POST" class="editQuestion">
    <div><div>Title:</div> <input type="text" name="title" required value="<?= $question['title'] ?>" /></div>
    <div><div>Description:</div> <textarea name="text" required ><?= $question['text'] ?></textarea></div>
    <div>
        <div>Category: </div>
        <select name="categoryId" required >
            <?php
            foreach ($categories as $key => $value) {
                if ($key == $question['categoryId']) {
                    ?>
                    <option value="<?= $key ?>" selected><?= $value ?></option>
                <?php } else { ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div>
        <div>Tags:</div> <input type="text" name="tags" required value="<?= $question['tags'] ?>" pattern="[a-zA-Zа-яА-Я ,]{1,}"/>
    </div>
    <div style="text-align: center"><input type="submit" name="edit" value="Edit question" required/></div>
    <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token" />
</form>