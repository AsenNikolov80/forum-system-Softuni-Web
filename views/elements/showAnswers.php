<?php
if (!empty($answers)) {
    foreach ($answers as $key => $value) {
        ?>
        <div class="questions">
            <div>
                <div>User: <?= htmlspecialchars($value['username']) ?></div>
                <div><?= htmlspecialchars($value['date']) ?></div>
            </div>
            <div><?= htmlspecialchars($value['text']) ?></div>
        </div>  
        <?php
    }
} else {
    echo 'No answers yet!';
}
?>