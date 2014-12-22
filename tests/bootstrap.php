<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/guzzlehttp/ringphp/tests/Client/Server.php';
require __DIR__ . '/../vendor/guzzlehttp/guzzle/tests/Server.php';

GuzzleHttp\Tests\Server::start();

register_shutdown_function(function () {
    GuzzleHttp\Tests\Server::stop();
});
