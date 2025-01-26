<?php

use App\Repositories\MedicationRepository;
use App\Core\App;
use App\Core\Container;
use App\Core\Database;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

$container = new Container();

$container->bind('App\Core\Database', function () {
    $config = require base_path('config.php');
    return new Database($config['database']);
});

$container->bind('App\Repositories\MedicationRepository', function() {
    return new MedicationRepository();
});

App::setContainer($container);
