<?php
namespace app\assets;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class BootstrapAsset implements AssetInterface
{
    public static function init(): void
    {
        $origin = dirname(dirname(__DIR__)) . '/vendor/twbs/bootstrap/dist';
        $destination = dirname(dirname(__DIR__)) . '/web/assets/bootstrap';

        if (!is_dir($destination)) {
            mkdir($destination, 0777, true);
        }


        foreach (
            $iterator = new RecursiveIteratorIterator(
                $directoryIterator = new RecursiveDirectoryIterator($origin, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST) as $item) {

            if ($item->isDir()) {
                if (!is_dir($destination . DIRECTORY_SEPARATOR . $directoryIterator->getSubPathName())) {
                    mkdir($destination . DIRECTORY_SEPARATOR . $directoryIterator->getSubPathName());
                }
            } else  {
                if (!file_exists($destination . DIRECTORY_SEPARATOR . $directoryIterator->getSubPathName() . DIRECTORY_SEPARATOR . $item->getFileName())) {
                    copy($item->getRealPath(), $destination . DIRECTORY_SEPARATOR . $directoryIterator->getSubPathName() . DIRECTORY_SEPARATOR . $item->getFileName());
                }
            }

        }
    }
}