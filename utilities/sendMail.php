<?php
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Dotenv\Dotenv as DotEnv;

$dotenv = DotEnv::createImmutable(dirname(__DIR__));
$dotenv->load();

function sendMail($to,$message){
    $email = null;
    $tranponder = null;
    $mailer = null;
    try {
        $email = (new Email())
            ->from("noreply@mydomain.com")
            ->to($to)
            ->subject($_ENV["PROJECT_NAME"])
            ->html($message);
        $tranponder = Transport::fromDSN("gmail+smtp://".$_ENV["EMAIL_USERNAME"].":".$_ENV["EMAIL_PASSWORD"]."@default");
        $mailer = new Mailer($tranponder);
        $mailer->send($email);
        return true;
    } catch (TransportExceptionInterface $ex) {
        return false;
    } finally {
        unset($message);
        unset($email);
        unset($tranponder);
        unset($mailer);
    }

}
