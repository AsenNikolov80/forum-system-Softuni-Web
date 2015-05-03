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
        <div>Tags:</div> <input type="text" name="tags" required />
        
    </div>
    <div style="text-align: center"><input type="submit" name="add" value="Ask question" required/></div>

</form>