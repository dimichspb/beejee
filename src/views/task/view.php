<?php

/** @var $model \app\models\task\Task */

$title = 'View task';
?>
<h1><?= $title ?></h1>

<div class="row">
    <div class="col-sm-12">
        <a href="/tasks" class="btn btn-info">Tasks list</a>
        <a href="/task/update/<?= $model->getId() ?>" class="btn btn-info">Update task</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Attribute</th>
                <th scope="col">Value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">ID</th>
                <td><?= $model->getId() ?></td>
            </tr>
            <tr>
                <th scope="row">Username</th>
                <td><?= $model->getUser() ?></td>
            </tr>
            <tr>
                <th scope="row">E-mail</th>
                <td><?= $model->getEmail() ?></td>
            </tr>
            <tr>
                <th scope="row">Description</th>
                <td><?= $model->getDescription() ?></td>
            </tr>
            <tr>
                <th scope="row">Image</th>
                <td><img src="/task/image/<?= $model->getId() ?>"></td>
            </tr>
            <tr>
                <th scope="row">Done</th>
                <td><?= $model->getDone() ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
