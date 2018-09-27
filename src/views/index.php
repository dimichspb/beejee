<?php

/** @var $request \app\http\entities\request\Request */

$title = 'Tasks main page';
?>
<h1><?= $title; ?></h1>
<div class="row">
    <div class="col-sm-12">
        <p>Please choose your option</p>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="/tasks" class="btn btn-info">Tasks list</a>
        <a href="/task/create" class="btn btn-info">Create task</a>
    </div>
</div>
