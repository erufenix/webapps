<?php
error_reporting(E_ALL ^ (E_WARNING | E_DEPRECATED) );
ini_set('display_errors', 1);
ini_set('date.timezone', 'America/Mexico_City');

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';
$app->run();
