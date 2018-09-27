<?php
namespace app\http\entities\base;

use app\entities\base\BaseEntity;
use Assert\Assertion;
use Psr\Http\Message\StreamInterface;

abstract class BaseStream extends BaseEntity implements StreamInterface
{
    public function assert($value)
    {
        Assertion::isResource($value);
    }

    public function __toString()
    {
        return stream_get_contents($this->value);
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    /**
     * {@inheritdoc}
     */
    public function detach()
    {
        $resource = $this->value;
        $this->value = null;
        return $resource;
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
    }

    public function tell()
    {
        // TODO: Implement tell() method.
    }

    public function eof()
    {
        // TODO: Implement eof() method.
    }

    public function isSeekable()
    {
        // TODO: Implement isSeekable() method.
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function isWritable()
    {
        // TODO: Implement isWritable() method.
    }

    public function write($string)
    {
        // TODO: Implement write() method.
    }

    public function isReadable()
    {
        // TODO: Implement isReadable() method.
    }

    public function read($length)
    {
        // TODO: Implement read() method.
    }

    public function getContents()
    {
        // TODO: Implement getContents() method.
    }

    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }

}