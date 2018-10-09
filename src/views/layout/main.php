<?php

/** @var $title string */
/** @var $template string */

\app\assets\BootstrapAsset::init();
\app\assets\JQueryAsset::init();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?= $title ?></title>

    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">Tasks</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<main role="main" class="container">
    <section class="content">
        <?= $template ?>
    </section>
</main>

<script type="text/javascript" src="/assets/jquery/jquery.js"></script>
<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/modal.js"></script>
</body>
</html>
