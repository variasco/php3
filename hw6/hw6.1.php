<?php

/**
1. Наблюдатель: есть сайт HandHunter.gb. На нем работники могут подыскать себе вакансию
РНР-программиста. Необходимо реализовать классы искателей с их именем, почтой и стажем
работы. Также реализовать возможность в любой момент встать на биржу вакансий
(подписаться на уведомления), либо же, напротив, выйти из гонки за местом. Таким образом,
как только появится новая вакансия программиста, все жаждущие автоматически получат
уведомления на почту (можно реализовать условно).
 */

interface Observer
{
    function handle(): void;
}

abstract class Subject
{
    protected array $observers = [];

    abstract function attach(Observer $observer): void;
    abstract function detach(Observer $observer): void;
    abstract protected function notify(): void;
}

class JobMarket extends Subject
{
    function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    function detach(Observer $observer): void
    {
        foreach ($this->observers as $key => $obs) {
            if ($obs == $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    protected function notify(): void
    {
        foreach ($this->observers as $obs) {
            $obs->handle();
        }
    }

    function newVacancy(): void
    {
        $this->notify();
    }
}

class Applicant implements Observer
{
    private string $name;
    private string $email;
    private string $phoneNumber;

    function __construct(string $name, string $email = "", string $phoneNumber = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    function handle(): void
    {
        echo "{$this->name} has been handled";
    }
}

$market = new JobMarket();
$vasya = new Applicant("Vasya");
$kolya = new Applicant("Kolya");
$market->attach($vasya);
$market->attach($kolya);
$market->newVacancy();
