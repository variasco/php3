<?php

/**
2. Стратегия: есть интернет-магазин по продаже носков. Необходимо реализовать возможность
оплаты различными способами (Qiwi, Яндекс, WebMoney). Разница лишь в обработке запроса
на оплату и получение ответа от платёжной системы. В интерфейсе функции оплаты
достаточно общей суммы товара и номера телефона.
 */

interface PaymentStrategyInterface
{
    function pay(float $summaryPrice, string $phoneNumber): void;
}

class QiwiPayment implements PaymentStrategyInterface
{
    function pay(float $summaryPrice, string $phoneNumber): void
    {
        echo "paid by Qiwi";
    }
}

class WebMoneyPayment implements PaymentStrategyInterface
{
    function pay(float $summaryPrice, string $phoneNumber): void
    {
        echo "paid by WebMoney";
    }
}

class YandexPayment implements PaymentStrategyInterface
{
    function pay(float $summaryPrice, string $phoneNumber): void
    {
        echo "paid by Yandex";
    }
}

class PaymentService
{
    private PaymentStrategyInterface $payment;

    function __construct(PaymentStrategyInterface $payment)
    {
        $this->payment = $payment;
    }

    function pay(float $summaryPrice, string $phoneNumber): void
    {
        $this->payment->pay($summaryPrice, $phoneNumber);
    }
}

$paymentService = new PaymentService(new WebMoneyPayment());
$paymentService->pay(100500, "123456789");
