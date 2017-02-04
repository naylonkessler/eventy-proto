<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventy prototype</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100">
    <link rel="stylesheet" href="/assets/app.css">
</head>
<body>
    <nav class="main-menu">
        <h1 class="app-name">Modular Pluggable Prototype</h1>
        <a href="/App/Actions/Plugins.php">Plugins</a>
        <a href="/App/Actions/Contacts.php">Contacts</a>
        <?php \Lib\App::$pubSub->publishToRender('app.render.main-menu'); ?>
    </nav>