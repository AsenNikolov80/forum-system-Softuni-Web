<?php
//echo '<pre>' . print_r($question, true) . '</pre>';
?>
<div class="categories">
    <ul>
        <?php foreach ($categories as $id => $name) { ?>
            <li><a class="inactive" id="a<?= $id ?>" onclick="setActive(<?= $id; ?>)"><?= $name ?></a></li>
        <?php }
        ?>
    </ul>
</div>
<div id="outer">
    <div class="container">
        <div>
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
    </div>
    <div id="answers"></div>
    <button onclick="addNewAnswer()">Add new answer</button>
</div>
<script>
    $(function () {
        $.ajax({
            url: '<?= ROOT_URL . 'answer/showAnswers/' . $question['id'] ?>',
            method: 'GET'
        }).success(function (data) {
            $('#answers').html(data);
        });
    });

    function setActive(id) {
        if (event != null) {
            $('.active').removeClass('active');
            $('.active').addClass('inactive');
            var link = $('#a' + id);
            link.addClass('active');
            $('#outer').remove();
            var questionContainer = $('<div id="questionContainer">');
            questionContainer.appendTo($('section'));
        }
        $.ajax({
            url: '<?= ROOT_URL . 'question/showQuestions/' ?>' + id,
            method: "GET"
        }).success(function (data)
        {
            $('#questionContainer').html(data);

        }).error(function () {
            alert(33);
        });
    }
    setActive(0);
    function addNewAnswer() {
        $.ajax({
            url: '<?= ROOT_URL . 'answer/addNew/' . $question["id"] ?>',
            method: "GET"
        }).success(function (data) {
            $('#outer').append(data);
        });
    }
</script>