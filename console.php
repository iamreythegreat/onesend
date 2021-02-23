#!/usr/bin/env php
<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Console\App\Commands\HelloworldCommand;
use Console\App\Commands\ConsultantLists;
use Console\App\Commands\ConsultantAdd;


$app = new Application();
$app->add(new consultantLists());
$app->add(new consultantAdd());
$app->run();


