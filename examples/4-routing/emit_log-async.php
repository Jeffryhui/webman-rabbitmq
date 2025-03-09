<?php
use Bunny\Channel;
use Bunny\Message;
use Workerman\Worker;
use Jeffryhui\Rabbitmq\Producer;
use Jeffryhui\Rabbitmq\AbstractConsumer;

if (file_exists(__DIR__ . '/../../../../../vendor/autoload.php')) {
    require __DIR__ . '/../../../../../vendor/autoload.php';
} else {
    require __DIR__ . '/../../vendor/autoload.php';
}

$worker = new Worker();

$worker->onWorkerStart = function() {
    global $argv;
    unset($argv[1]);
    $argv = array_values($argv);
    $severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';
    $data = implode(' ', array_slice($argv, 2));
    if (empty($data)) {
        $data = "Hello World!";
    }

    $config = require __DIR__ . '/../config.php';
    $log = require __DIR__ . '/../log.php';

    Producer::connect($config, $log)->publishAsync($data, 'direct_logs', 'direct', $severity);
};

Worker::runAll();
