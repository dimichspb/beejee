<?php
namespace app\services\task;

interface FilesystemInterface
{
    public function getFileFromUploadBucket($filename);

    public function saveFileToUploadBucket($filename, $stream);
}