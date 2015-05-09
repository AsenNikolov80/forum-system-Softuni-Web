<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forum system</title>
        <link href="<?php echo ROOT_URL . 'lib/jquery-ui.css'; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ROOT_URL . 'css/style.css'; ?>" rel="stylesheet" type="text/css"/>
        <script src="<?=ROOT_URL.'/lib/jquery-1.11.2.js';?>" type="text/javascript"></script>
        <script src="<?=ROOT_URL.'/lib/jquery-ui.js';?>" type="text/javascript"></script>
        <script src="<?=ROOT_URL.'/lib/script.js';?>" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <ul>
                <li><a href="<?php echo ROOT_URL . 'question/add'; ?>">New Question</a></li>
                <li><a href="<?php echo ROOT_URL . 'question/all'; ?>">View Questions</a></li>
                <li><a href="<?php echo ROOT_URL . 'user/logout'; ?>">Logout</a></li>
                <li><a href="<?php echo ROOT_URL . 'secure/edit'; ?>">Потребител: <?=  htmlspecialchars($this->userLogged['fullname']);?></a></li>
            </ul>
            
        </header>
        <main>
            <section>
                