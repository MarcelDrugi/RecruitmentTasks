<?php

declare(strict_types=1);

namespace RecruitmentTasks\app\Exceptions;

use Exception;
use Throwable;

class NotNumberException extends Exception {

    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message,
        int $code = 0,
        Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}