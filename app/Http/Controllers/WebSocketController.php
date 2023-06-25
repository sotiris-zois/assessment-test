<?php

namespace App\Http\Controllers;

use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class WebSocketController extends Controller implements MessageComponentInterface
{
    protected $clients;

    public function broadcast($message)
    {

        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection: {$conn->resourceId}\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection closed: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Sent response to {$from->resourceId}: $msg\n";
        foreach ($this->clients as $client) {

            $client->send($msg);
        }
    }
}
