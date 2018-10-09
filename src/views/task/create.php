<?php

/** @var $form \app\forms\task\CreateForm*/

$title = 'Create task';
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
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user">User name</label>
                <input type="text" class="form-control" id="user" name="user" aria-describedby="usernameHelp" placeholder="Username" required value="<?= $form->user; ?>">
                <small id="usernameHelp" class="form-text text-muted">Please enter your username</small>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="E-mail" required value="<?= $form->email; ?>">
                <small id="emailHelp" class="form-text text-muted">Please enter your e-mail address</small>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="5" class="form-control" id="description" name="description" aria-describedby="descriptionHelp" placeholder="Description" required><?= $form->description; ?></textarea>
                <small id="descriptionHelp" class="form-text text-muted">Please type the description of the task</small>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" aria-describedby="imageHelp" placeholder="Image" accept="image/x-png,image/gif,image/jpeg" required>
                <small id="imageHelp" class="form-text text-muted">Please choose the image to upload</small>
            </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#preview-modal">Preview</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<div class="modal fade" id="preview-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task create preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="preview-user">User name</label>
                    <input type="text" class="form-control" id="preview-user" placeholder="" value="" readonly>
                </div>
                <div class="form-group">
                    <label for="preview-email">E-mail</label>
                    <input type="email" class="form-control" id="preview-email" placeholder="" value="" readonly>
                </div>
                <div class="form-group">
                    <label for="preview-description">Description</label>
                    <textarea rows="5" class="form-control" id="preview-description" placeholder="" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
