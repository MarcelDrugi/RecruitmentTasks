<?php

declare(strict_types=1);

namespace RecruitmentTasks\app;

interface DecryptionInterface
{
    /**
     * @param string $message
     * @param string $key
     * @return string
     */
    public function decrypt(string $message, string $key): string;

    /**
     * @param string $message
     * @param string $key
     * @param string $destination
     * @return string
     */
    public function encrypt(string $message, string $key, string $destination): string;
}