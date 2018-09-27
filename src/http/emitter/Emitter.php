<?php
namespace app\http\emitter;

use Psr\Http\Message\ResponseInterface;

class Emitter implements EmitterInterface
{
    public function emit(ResponseInterface $response): void
    {
        $output = $this->createOutputStream();

        if (!$output) {
            throw new \RuntimeException("Failed to open output stream");
        }

        $response->getBody()->rewind();
        $handle = $response->getBody()->detach();
        foreach ($response->getHeaders() as $name => $value) {
            $this->addHeader($name, $value);
        }
        stream_copy_to_stream($handle, $output);
    }

    protected function createOutputStream()
    {
        return fopen('php://output', 'w');
    }

    protected function addHeader($name, $value = null)
    {
        if ($value) {
            header($name . ': ' . $value);
        } else {
            header($name);
        }
    }
}