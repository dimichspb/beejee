<?php
namespace app\http\router\entities\route;

class Route
{
    /**
     * @var MethodCollection
     */
    protected $methods;

    /**
     * @var Path
     */
    protected $path;

    /**
     * @var Handler
     */
    protected $handler;

    public function __construct(MethodCollection $methods, Path $path, Handler $handler)
    {
        $this->methods = $methods;
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return Handler
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return MethodCollection
     */
    public function getMethods()
    {
        return $this->methods;
    }
}
