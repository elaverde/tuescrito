<?php 
namespace App\Interfaces;
interface EmailProviderInterface {
    public function send(string $to, string $subject, string $message): bool;
}