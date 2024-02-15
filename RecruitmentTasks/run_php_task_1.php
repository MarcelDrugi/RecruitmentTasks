<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use RecruitmentTasks\app\Decryption;

const KEY_PATH_1 = '/data/key1.txt';

const DECRYPT_MESSAGE_PATH = '/data/message_to_decrypt.txt';

const ENCRYPT_MESSAGE_PATH = '/data/message_to_encrypt.txt';

const ENCRYPTED_MESSAGE_PATH = '/data/encrypted_message.txt';

$dirname = dirname(__FILE__);
$decryption = new Decryption();
print(
    'DECRYPTED MESSAGE 1: ' .
    $decryption->decrypt($dirname . DECRYPT_MESSAGE_PATH, $dirname . KEY_PATH_1) .
    "\n"
);
print(
    'ENCRYPTED MESSAGE 2: ' .
    $decryption->encrypt($dirname . ENCRYPT_MESSAGE_PATH, $dirname . KEY_PATH_1, $dirname . ENCRYPTED_MESSAGE_PATH) .
    "\n"
);
print(
    'DECRYPTED MESSAGE 2 BACK: ' .
    $decryption->decrypt($dirname . ENCRYPTED_MESSAGE_PATH, $dirname . KEY_PATH_1) .
    "\n"
);
