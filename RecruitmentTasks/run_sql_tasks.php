<?php

declare(strict_types=1);

use RecruitmentTasks\app\Lottery;

require 'vendor/autoload.php';

$env = parse_ini_file('.env');

if (isset($env['DATABASE'], $env['USER'], $env['PASSWORD'])) {
    $lottery = new Lottery($env['DATABASE'], $env['USER'], $env['PASSWORD']);
    $lottery->prepareDatabase(Lottery::CREATE_STRUCTURE_OPERATION);
    $lottery->prepareDatabase(Lottery::INSERT_DATA_OPERATION);
    echo "\n";
    $lottery->displayWinningTickets();
    echo "\n";
    $lottery->displaySummary();
    echo "\n";
} else {
    echo "Complete the database connection details in the .env file\n";
}
