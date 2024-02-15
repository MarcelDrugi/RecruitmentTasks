<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use RecruitmentTasks\app\Numbers;

const NUMBER_FILE_PATH = '/data/numbers.txt';

$numbers = new Numbers();

$numbers->displayNumber(dirname(__FILE__) . NUMBER_FILE_PATH, '0123456789');

$userNumber = readline("Enter your own number to display: ");
$numbers->displayNumber(dirname(__FILE__) . NUMBER_FILE_PATH, $userNumber);