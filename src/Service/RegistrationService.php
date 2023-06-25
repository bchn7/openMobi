<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

class RegistrationService
{
    private $mailer;
    private $emailSender;

    public function __construct(MailerInterface $mailer, string $emailSender)
    {
        $this->mailer = $mailer;
        $this->emailSender = $emailSender;
    }

    public function sendRegistrationConfirmation(string $recipientEmail): void
    {
        $message = (new \Symfony\Component\Mime\Email())
            ->from($this->emailSender)
            ->to($recipientEmail)
            ->subject('Potwierdzenie rejestracji')
            ->text('Dziękujemy za rejestrację w naszym serwisie.');

        $this->mailer->send($message);
    }
}
