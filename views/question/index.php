<script>
    function setActive(id) {
        if (event != null) {
            $('.active').removeClass('active');
            $('.active').addClass('inactive');
            var link = $('#a' + id);
            link.addClass('active');
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

<div class="categories">
    <h2>Categories</h2>
    <ul>
        <?php foreach ($categories as $id => $name) { ?>
            <li><a class="inactive" id="a<?= $id ?>" onclick="setActive(<?= $id; ?>)"><?= $name ?></a></li>
        <?php }
        ?>
    </ul>
</div>
<div id="questionContainer"></div>

