<div class="categories">
    <ul>
        <?php foreach ($categories as $id => $name) { ?>
            <li><a class="inactive" id="a<?= $id ?>" onclick="setActive(<?= $id; ?>)"><?= $name ?></a></li>
        <?php }
        ?>
    </ul>
</div>
<div id="questionContainer"></div>
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

        }).error(function () {
            alert(33);
        });
    }
    setActive(0);
</script>