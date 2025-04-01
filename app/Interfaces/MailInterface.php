<?php
namespace App\Interfaces;

interface MailInterface {
    public function send(string $to, string $subject, string $body, string $altBody = ''): bool;
}
