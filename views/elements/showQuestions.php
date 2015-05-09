<?php
if (!empty($questions)) {
    foreach ($questions as $key => $value) {
        ?>
        <div class="questions">
            <div><strong><a href="<?= ROOT_URL . 'question/view/' . $value['id'] ?>"><?= htmlspecialchars($value['title']); ?></a></strong></div>
            <div>
                <div>User: <?= htmlspecialchars($value['username']) ?></div>
                <div><?= htmlspecialchars($value['date']) ?></div>
                <div>Category: <?= htmlspecialchars($value['categoryName']) ?></div>
                <div>Visited: <?= htmlspecialchars($value['visits']) ?> times</div>
            </div>
        </div>  
    <?php }
    ?>
    <div id="pages">
        <?php for ($i = 1; $i <= $pages; $i++) {
            if ($i == $page) {
                ?>
                <button id="b<?= $i ?>" class="active pageClass" onclick="newPage(<?= $categoryId . ',' . $i ?>)"><?= $i ?></button>
            <?php } else { ?>
                <button id="b<?= $i ?>" class="inactive pageClass" onclick="newPage(<?= $categoryId . ',' . $i ?>)"><?= $i ?></button>
            <?php }
        }
        ?>
    </div>

    <?php
} else {
    echo 'No questions yet!';
}
?>
