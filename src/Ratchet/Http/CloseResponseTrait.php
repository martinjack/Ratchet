<?php
namespace Ratchet\Http;

use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Response;
use Ratchet\ConnectionInterface;

trait CloseResponseTrait
{
    /**
     * Close a connection with an HTTP response
     * @param \Ratchet\ConnectionInterface $conn
     * @param int                          $code HTTP status code
     * @return null
     */
    private function close(ConnectionInterface $conn, $code = 400, array $additional_headers = [])
    {
        $response = new Response($code, array_merge([
            'X-Powered-By' => \Ratchet\VERSION,
        ], $additional_headers));

        $conn->send(Message::toString($response));
        $conn->close();
    }
}
