<?php

namespace App\Tests\Service;

use App\Service\RegistrationService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;

class RegistrationServiceTest extends TestCase
{
    public function testSendRegistrationConfirmation(): void
    {
        $mailerMock = $this->createMock(MailerInterface::class);
        $mailerMock->expects($this->once())
            ->method('send')
            ->with($this->callback(function ($message) {
                $this->assertSame('clementine.dickinson@ethereal.email', $message->getFrom()[0]->getAddress());
                $this->assertSame('clementine.dickinson@ethereal.email', $message->getTo()[0]->getAddress());
                $this->assertSame('Potwierdzenie rejestracji', $message->getSubject());
                $this->assertSame('Dziękujemy za rejestrację w naszym serwisie.', $message->getTextBody());

                return true;
            }));

        $registrationService = new RegistrationService($mailerMock, 'clementine.dickinson@ethereal.email');
        $registrationService->sendRegistrationConfirmation('clementine.dickinson@ethereal.email');
    }
}
