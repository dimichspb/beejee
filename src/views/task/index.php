<?php

/** @var $models \app\models\task\TaskCollection */
/** @var $pager \app\helpers\Pager */
$title = 'Tasks list';

$current = $pager->getPage();
$pagesCount = $pager->getPagesCount();

?>
<h1><?= $title ?></h1>

<div class="row">
    <div class="col-sm-12">
        <a href="/task/create" class="btn btn-info">Task create</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">E-mail</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Done</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model): ?>
            <tr>
                <td><?= $model->getUser() ?></td>
                <td><?= $model->getEmail() ?></td>
                <td><?= $model->getDescription() ?></td>
                <td><?= $model->getImage() ?></td>
                <td><?= $model->getDone() ?></td>
                <td><a href="/task/<?= $model->getId(); ?>">View</a><br><a href="/task/update/<?= $model->getId(); ?>">Update</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php if ($pagesCount > 0): ?>

        <ul class="pagination">
            <?php if ($current > 1):?>
            <li class="page-item">
                <a class="page-link" href="<?= $current == 2 ? '/tasks' : '/tasks/' . $current ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </span>
            </li>
            <?php endif; ?>

            <?php for($page = 1; $page <= $pagesCount; $page++): ?>
            <li class="page-item <?= $page == $current? 'active': ''?>">
                <a class="page-link" href="<?= $page == 1? '/tasks': '/tasks/' . $page?>"><?= $page ?></a>
            </li>
            <?php endfor; ?>

            <?php if ($current < $pagesCount): ?>
            <li class="page-item">
                <a class="page-link" href="<?= '/tasks/' . ($current + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <?php else: ?>
            <li class="page-item disabled">
                <span class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </span>
            </li>
            <?php endif; ?>
        </ul>

        <?php endif; ?>
    </div>
</div>