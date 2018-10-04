<?php
namespace app\services\task;

use app\helpers\ImageProcessor;
use app\http\exceptions\NotFoundException;

class Filesystem implements FilesystemInterface
{
    /**
     * @var \League\Flysystem\FilesystemInterface
     */
    protected $filesystem;

    /**
     * @var ImageProcessor
     */
    protected $imageProcessor;

    /**
     * @var string
     */
    protected $uploadBucketName;

    /**
     * Filesystem constructor.
     * @param \League\Flysystem\FilesystemInterface $filesystem
     * @param ImageProcessor $imageProcessor
     * @param string $uploadBucketName
     */
    public function __construct(\League\Flysystem\FilesystemInterface $filesystem, ImageProcessor $imageProcessor, $uploadBucketName = 'upload')
    {
        $this->filesystem = $filesystem;
        $this->imageProcessor = $imageProcessor;

        $this->uploadBucketName = $uploadBucketName;
    }

    /**
     * Get File from Upload Bucket
     * @param $filename
     * @return false|resource
     * @throws NotFoundException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function getFileFromUploadBucket($filename)
    {
        $path = $this->buildPath($this->uploadBucketName, $filename);

        if (!$this->filesystem->has($path)) {
            throw new NotFoundException('File not found: ' . $path);
        }

        return $this->filesystem->readStream($this->buildPath($this->uploadBucketName, $filename));
    }

    /**
     * Save file to Upload Bucket
     * @param $filename
     * @param $stream
     * @return bool
     * @throws \League\Flysystem\FileExistsException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function saveFileToUploadBucket($filename, $stream)
    {
        $path = $this->buildPath($this->uploadBucketName, $filename);
        if ($this->filesystem->has($path)) {
            return $this->filesystem->updateStream($this->buildPath($this->uploadBucketName, $filename), $this->imageProcessor->resize($stream, 320, 240));
        } else {
            return $this->filesystem->writeStream($this->buildPath($this->uploadBucketName, $filename), $this->imageProcessor->resize($stream, 320, 240));
        }
    }

    /**
     * Build path to file
     * @param $bucketName
     * @param $filename
     * @return string
     */
    protected function buildPath($bucketName, $filename)
    {
        $bucketName = trim($bucketName, "\t\n\r\0\x0B\\\/");
        $filename = trim($filename, "\t\n\r\0\x0B\\\/");

        return implode(DIRECTORY_SEPARATOR, [
            $bucketName,
            $filename
        ]);
    }

}