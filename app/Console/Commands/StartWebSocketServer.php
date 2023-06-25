<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Server\IoServer;

use Ratchet\Http\HttpServer;

use Ratchet\WebSocket\WsServer;

use App\Http\Controllers\WebSocketController;


class StartWebSocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Web socket listening on port 3000';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return 0;

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketController()
                )
            ),
            3000
        );

        $server->run();
    }
}
