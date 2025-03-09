<?php


use Jeffryhui\Rabbitmq\Producer;

if (file_exists(__DIR__ . '/../../../../../vendor/autoload.php')) {
    require __DIR__ . '/../../../../../vendor/autoload.php';
} else {
    require __DIR__ . '/../../vendor/autoload.php';
}


$config = require __DIR__ . '/../config.php';
$log = require __DIR__ . '/../log.php';

// for ($i = 0; $i < 10; $i++) {
    Producer::connect($config, $log)->publishSync('Hello World!', '', '', 'hello');
// }

echo " [x] Sent 'Hello World!'\n";

