<?php

declare(strict_types=1);

namespace RecruitmentTasks\app;

interface NumbersInterface
{
    /**
     * @param string $pathToFile
     * @param string $number
     * @return void
     */
    public function displayNumber(string $pathToFile, string $number): void;
}