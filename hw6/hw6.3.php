<?php

/**
3. Команда: вы — разработчик продукта Macrosoft World. Это текстовый редактор с
возможностями копирования, вырезания и вставки текста (пока только это). Необходимо
реализовать механизм по логированию этих операций и возможностью отмены и возврата
действий. Т. е., в ходе работы программы вы открываете текстовый файл .txt, выделяете
участок кода (два значения: начало и конец) и выбираете, что с этим кодом делать.
 */

interface CommandInterface
{
    function execute($textStart, $textEnd);
}

interface RecieverInterface
{
    function action($textStart, $textEnd): void;
}

class ConcreteCommand implements CommandInterface
{
    private RecieverInterface $reciever;

    function __construct(RecieverInterface $reciever)
    {
        $this->reciever = $reciever;
    }

    function execute($textStart, $textEnd)
    {
        $this->reciever->action($textStart, $textEnd);
    }
}

class CopyReciever implements RecieverInterface
{
    function action($textStart, $textEnd): void
    {
        echo "copy text from {$textStart} to {$textEnd}";
    }
}

class CutReciever implements RecieverInterface
{
    function action($textStart, $textEnd): void
    {
        echo "cut text from {$textStart} to {$textEnd}";
    }
}

class PasteReciever implements RecieverInterface
{
    function action($textStart, $textEnd): void
    {
        echo "paste text from {$textStart} to {$textEnd}";
    }
}

class MacrosoftWorld
{
    private CommandInterface $command;

    function setCommand(CommandInterface $command): void
    {
        $this->command = $command;
    }

    function executeCommand($textStart, $textEnd)
    {
        $this->command->execute($textStart, $textEnd);
    }
}

$invoker = new MacrosoftWorld();

$invoker->setCommand(new ConcreteCommand(new CopyReciever()));
$invoker->executeCommand(1, 3);
