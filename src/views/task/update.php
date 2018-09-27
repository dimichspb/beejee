<?php

/** @var $form \app\forms\task\UpdateForm*/

$title = 'Update task';
?>
<h1><?= $title ?></h1>
<div class="row">
    <div class="col-sm-12">
        <?php if ($form->hasErrors()): ?>
            <h4>Validation errors:</h4>
            <?php foreach ($form->getErrors() as $attribute => $message): ?>
                <p><?= $attribute ?>: <?= implode("\n", $message) ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <form method="post">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Description" required><?= $form->description; ?></textarea>
                <small id="descriptionHelp" class="form-text text-muted">Please type the description of the task</small>
            </div>
            <div class="form-group">
                <label for="done">Done</label>
                <input type="checkbox" class="form-control" id="done" name="done" aria-describedby="doneHelp" placeholder="Done" <?= $form->done? 'checked': ''; ?>>
                <small id="doneHelp" class="form-text text-muted">Please check if the task is done</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
