<?php
//echo '<pre>' . print_r($question, true) . '</pre>';
if (isset($_SESSION['errorMsg'])) {
    ?>
    <div id="errorDiv"><?= $_SESSION['errorMsg']; ?></div>

    <?php
    unset($_SESSION['errorMsg']);
}
?>
<div class="categories">
    <h2>Categories</h2>
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
            <?php if (!empty($this->userLogged) && $this->userLogged['username'] === $question['username']) { ?>
                <span style="margin-left: 10px;">
                    <img class="opener" id="<?= $question['id'] ?>" src="<?= ROOT_URL . 'img/edit.gif'; ?>" style="width: 20px" />
                </span>  
            <?php }
            ?>
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
    <button onclick="addNewAnswer()" style="margin-left: 5%">Add new answer</button>
</div>

<div id="dialog" title="Edit question"></div>
<script>
    $(function () {
        $.ajax({
            url: '<?= ROOT_URL . 'answer/showAnswers/' . $question['id'] ?>',
            method: 'GET'
        }).success(function (data) {
            $('#answers').html(data);
        });
        
        $("#dialog").dialog({
            autoOpen: false,
            resizable: false,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "explode",
                duration: 1000
            },
            width: "auto",
            position: {my: "left top", at: "left+30% top", of: window},
            modal: true
        });

        $(".opener").click(function (event) {
            var idQuestion = event.target.id;
            $("#dialog").dialog("open");
            fillData(idQuestion);
        });
    });
    
    function fillData(idQuestion) {
        $('#dialog').html('');
        $.ajax({
            url: "<?= ROOT_URL . 'question/edit/' ?>"+idQuestion,
            method: "GET"
        }).success(function (data){
            $('#dialog').append(data);
        });
    }
    
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

        });
    }
    setActive(0);
    function addNewAnswer() {
        $('#addForm').remove();
        $.ajax({
            url: '<?= ROOT_URL . 'answer/addNew/' . $question["id"] ?>',
            method: "GET"
        }).success(function (data) {
            $('#outer').append(data);
        });
    }
    function newPage(id, pageNumber) {
        $.ajax({
            url: '<?= ROOT_URL . 'question/showQuestions/' ?>' + id + '/' + pageNumber,
            method: "GET"
        }).success(function (data)
        {
            $('#questionContainer').html(data);
        });
    }

    
</script>