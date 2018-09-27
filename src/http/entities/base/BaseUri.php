<?php
namespace app\http\entities\base;

use app\entities\base\BaseEntity;
use Assert\Assertion;
use Psr\Http\Message\UriInterface;

abstract class BaseUri extends BaseEntity implements UriInterface
{
    /**
     * @var string
     */
    private $scheme = '';

    /**
     * @var string
     */
    private $userInfo = '';

    /**
     * @var string
     */
    private $host = '';

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $path = '';

    /**
     * @var string
     */
    private $query = '';

    /**
     * @var string
     */
    private $fragment = '';

    public function __construct($value = null)
    {
        parent::__construct($value);
        $this->parseUri($value);
    }

    public function assert($value)
    {
        Assertion::string($value);
    }


    private function parseUri($uri)
    {
        $parts = parse_url($uri);

        if (false === $parts) {
            throw new \InvalidArgumentException(
                'The source URI string appears to be malformed'
            );
        }

        $this->scheme    = isset($parts['scheme']) ? $parts['scheme'] : '';
        $this->userInfo  = isset($parts['user']) ? $parts['user'] : '';
        $this->host      = isset($parts['host']) ? strtolower($parts['host']) : '';
        $this->port      = isset($parts['port']) ? $parts['port'] : null;
        $this->path      = isset($parts['path']) ? $parts['path'] : '';
        $this->query     = isset($parts['query']) ? $parts['query'] : '';
        $this->fragment  = isset($parts['fragment']) ? $parts['fragment'] : '';

        if (isset($parts['pass'])) {
            $this->userInfo .= ':' . $parts['pass'];
        }
    }

    public function getScheme()
    {
        return $this->scheme;
    }

    public function getAuthority()
    {
        // TODO: Implement getAuthority() method.
    }

    public function getUserInfo()
    {
        return $this->userInfo;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getFragment()
    {
        return $this->fragment;
    }

    public function withScheme($scheme)
    {
        $new = clone $this;
        $new->scheme = $scheme;
        return $new;
    }

    public function withUserInfo($user, $password = null)
    {
        $new = clone $this;
        $new->userInfo = $user . ':' . $password;
        return $new;
    }

    public function withHost($host)
    {
        $new = clone $this;
        $new->host = $host;
        return $new;
    }

    public function withPort($port)
    {
        $new = clone $this;
        $new->port = $port;
        return $new;
    }

    public function withPath($path)
    {
        $new = clone $this;
        $new->path = $path;
        return $new;
    }

    public function withQuery($query)
    {
        $new = clone $this;
        $new->query = $query;
        return $new;
    }

    public function withFragment($fragment)
    {
        $new = clone $this;
        $new->fragment = $fragment;
        return $new;
    }

    public function __toString()
    {
        return self::createUriString($this->scheme,
            $this->getAuthority(),
            $this->getPath(), // Absolute URIs should use a "/" for an empty path
            $this->query,
            $this->fragment
        );
    }


    private static function createUriString($scheme, $authority, $path, $query, $fragment)
    {
        $uri = '';

        if ($scheme !== '') {
            $uri .= sprintf('%s:', $scheme);
        }

        if ($authority !== '') {
            $uri .= '//' . $authority;
        }

        if ($path !== '' && substr($path, 0, 1) !== '') {
            $path = '/' . $path;
        }

        $uri .= $path;


        if ($query !== '') {
            $uri .= sprintf('?%s', $query);
        }

        if ($fragment !== '') {
            $uri .= sprintf('#%s', $fragment);
        }

        return $uri;
    }

}