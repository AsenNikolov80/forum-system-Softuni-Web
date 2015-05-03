<?php
//echo '<pre>' . print_r($question, true) . '</pre>';
?>
<div class="container">
    <div id="first"><?= $question['title'] ?></div>
    <div id="second"><?= $question['date'] ?></div>
    <div class="clearfix"></div>
    <div class="innerContainer">
        <div>User: <?= $question['username'] ?></div>
        <div>Category: <?= $question['categoryName'] ?></div>
        <div>Visited: <?= $question['visits'] ?> times</div>
    </div>
    <div class="text">
        <?= $question['text']; ?>
    </div>
    <div>Tags: <?= $question['tags'] ?></div>
</div>