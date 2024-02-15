<?php

declare(strict_types=1);

namespace RecruitmentTasks\app;

use RecruitmentTasks\app\DecryptionInterface;
use RecruitmentTasks\app\Exceptions\FileNotExistException;
use RecruitmentTasks\app\Exceptions\CantSaveFileException;

class Decryption implements DecryptionInterface
{
    /**
     * @param string $message
     * @param string $key
     * @return string
     */
    public function decrypt(string $message, string $key): string
    {
        try {
            $keyArray = $this->loadKey($key);
            $messageText = $this->loadMessage($message);
        } catch (FileNotExistException $exception) {
            return $exception->getMessage();
        }

        $decryptedMessage = '';
        foreach (str_split($messageText) as $char) {
            $decryptedMessage .= $keyArray[$char] ?? $char;
        }

        return $decryptedMessage;
    }

    /**
     * @param string $message
     * @param string $key
     * @param string $destination
     * @return string
     * @throws FileNotExistException
     */
    public function encrypt(string $message, string $key, string $destination): string
    {
        try {
            $keyArray = $this->loadKey($key, true);
            $messageText = $this->loadMessage($message);
        } catch (FileNotExistException $exception) {
            return $exception->getMessage();
        }

        $encryptedMessage = '';
        foreach (str_split($messageText) as $char) {
            $encryptedMessage .= $keyArray[$char] ?? $char;
        }

        try {
            $this->saveEncryptedMessage($destination, $encryptedMessage);
        } catch (CantSaveFileException $exception) {
            return $exception->getMessage();
        }

        return $encryptedMessage;
    }

    /**
     * @param $destination
     * @param $encryptedMessage
     * @return void
     * @throws FileNotExistException
     */
    private function saveEncryptedMessage($destination, $encryptedMessage): void
    {
        if (!file_put_contents($destination, $encryptedMessage)) {
            throw new FileNotExistException('Cant save file in: ' .  $destination, 150);
        }
    }

    /**
     * @param string $pathToFile
     * @param bool $encrypt
     * @return array
     * @throws FileNotExistException
     */
    private function loadKey(string $pathToFile, bool $encrypt = false): array
    {
        $file = fopen($pathToFile, 'r');
        if (!$file) {
            throw new FileNotExistException('An invalid key file path ' .  $pathToFile, 100);
        }
        $keys = explode(' ', rtrim(fgets($file)) ?? '');
        $alphabet = explode(' ', rtrim(fgets($file)) ?? '');
        fclose($file);
        if ($keys && $alphabet && count($keys) === count($alphabet)) {
            $keyChar = [];
            if ($encrypt) {
                for ($i = 0; $i < count($alphabet); $i++) {
                    $keyChar[$alphabet[$i]] = $keys[$i];
                }
            } else {
                for ($i = 0; $i < count($keys); $i++) {
                    $keyChar[$keys[$i]] = $alphabet[$i];
                }
            }
        }

        return $keyChar ?? [];
    }

    /**
     * @param string $pathToFile
     * @return string
     * @throws FileNotExistException
     */
    private function loadMessage(string $pathToFile): string
    {
        $message =  file_get_contents($pathToFile);
        if (!$message) {
            throw new FileNotExistException('An invalid message file path: ' .  $pathToFile, 100);
        }

        return $message;
    }
}