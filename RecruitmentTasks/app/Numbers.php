<?php

declare(strict_types=1);

namespace RecruitmentTasks\app;

use RecruitmentTasks\app\Exceptions\FileNotExistException;
use RecruitmentTasks\app\Exceptions\NotNumberException;
use RecruitmentTasks\app\NumbersInterface;

class Numbers implements NumbersInterface
{
    /**
     * @var int
     */
    private const ROWS_NUMBER = 3;

    /**
     * @var array
     */
    private array $numbersFromFile = [];

    /**
     * @param string $pathToFile
     * @return void
     * @throws FileNotExistException
     */
    private function loadNumbersFromFile(string $pathToFile): void
    {
        $file = fopen($pathToFile, 'r');
        if (!$file) {
            throw new FileNotExistException('An invalid key file path ' .  $pathToFile, 100);
        }
        $index = 0;
        while ($row = fgets($file)) {
            $rowArray = str_split($row);
            $this->numbersFromFile[$index] = $rowArray;
            $index++;
        }
    }

    /**
     * @param string $numbers
     * @return void
     * @throws NotNumberException
     */
    private function printDigits(string $numbers): void
    {
        for ($i = 0; $i < self::ROWS_NUMBER; $i++) {
            foreach (str_split($numbers) as $number) {
                if (!is_numeric($number)) {
                    throw new NotNumberException($number . ' is not a number.', 5);
                } else {
                    echo
                        $this->numbersFromFile[$i][(int)$number * 3] .
                        $this->numbersFromFile[$i][(int)$number * 3 + 1] .
                        $this->numbersFromFile[$i][(int)$number * 3 + 2];
                }
            }
            echo "\n";
        }
    }

    /**
     * @param string $pathToFile
     * @param string $number
     * @return void
     */
    public function displayNumber(string $pathToFile, string $number): void
    {
        try {
            $this->loadNumbersFromFile($pathToFile);
            $this->printDigits($number);
        } catch (NotNumberException | FileNotExistException $exception) {
            echo $exception->getMessage();
        }
    }
}