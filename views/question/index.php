
<?php
foreach ($questions as $key => $value) {
    ?>
    <div class="questions">
        <div><strong><a href="<?= ROOT_URL . 'question/view/'.$value['id'] ?>"><?= htmlspecialchars($value['title']); ?></a></strong></div>
        <div>
            <div>User: <?= htmlspecialchars($value['username']) ?></div>
            <div><?= htmlspecialchars($value['date']) ?></div>
            <div>Category: <?= htmlspecialchars($value['categoryName']) ?></div>
        </div>
    </div>  
<?php }
?>
