<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forum system</title>
        <link href="<?= ROOT_URL . 'lib/jquery-ui.css'; ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= ROOT_URL . 'css/style.css'; ?>" rel="stylesheet" type="text/css"/>
        <script src="<?=ROOT_URL.'/lib/jquery-1.11.2.js';?>" type="text/javascript"></script>
        <script src="<?=ROOT_URL.'/lib/jquery-ui.js';?>" type="text/javascript"></script>
        <script src="<?=ROOT_URL.'/lib/script.js';?>" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <ul>                
                <li><a href="<?= ROOT_URL . 'question/all'; ?>">View questions</a></li>
                <li><a href="<?= ROOT_URL . 'user/login'; ?>">Login</a></li>
                <li><a href="<?= ROOT_URL . 'user/register'; ?>">Register</a></li>
            </ul>
        </header>
        <main>
            <section>