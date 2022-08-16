<?php

/** 
1. Реализовать на PHP пример Декоратора, позволяющий отправлять уведомления
несколькими различными способами (описан в этой методичке).

Предположим, что у нас есть приложение, способное отправлять оповещения тремя способами: SMS,
Email и Chrome Notification (CN).

Не совсем понял, какой способ брать за базовый. Поэтому использовал класс Notifier
 */

interface NotificationInterface
{
    public function notify($message);
}

class Notifier implements NotificationInterface
{

    public function notify($message)
    {
        // some magic here
    }
}

class SMSNotifierDecorator implements NotificationInterface
{
    protected $notifier;

    function __construct(NotificationInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    function sendSMS($message)
    {
        // sending $message by SMS
    }

    function notify($message)
    {
        $this->sendSMS($message);
        $this->notifier->notify($message);
    }
}

class EmailNotifierDecorator implements NotificationInterface
{
    protected $notifier;

    function __construct(NotificationInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    function sendEmail($message)
    {
        // sending $message by Email
    }

    function notify($message)
    {
        $this->sendEmail($message);
        $this->notifier->notify($message);
    }
}

class ChromeNotifierDecorator implements NotificationInterface
{
    protected $notifier;

    function __construct(NotificationInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    function sendChrome($message)
    {
        // sending $message by Chrome
    }

    function notify($message)
    {
        $this->sendChrome($message);
        $this->notifier->notify($message);
    }
}

// Отправка всех трех типов оповещений одновременно
$notifier = new ChromeNotifierDecorator(new EmailNotifierDecorator(new SMSNotifierDecorator(new Notifier)));
$notifier->notify("hello world");
