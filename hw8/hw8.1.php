<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Directory Iterator</title>
    <style>
        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>

</body>

</html>
<?php

function getDirectory($dir)
{
    $currentDirectory = new DirectoryIterator(realpath($dir));
    getContent($currentDirectory);
}

function getContent($currentDirectory)
{
    foreach ($currentDirectory as $item) {
        if ($item->isDot()) continue;
        if (!$item->isDir()) echo "{$item->getBaseName()}<br>";
        else echo "<a href='?path={$item->getPathname()}'>{$item}</a><br>";
    }
}

if (!empty($_GET['path'])) {
    getDirectory($_GET['path']);
} else {
    getDirectory('/');
}

// Сам думал и не придумал, поэтому украл решение с гитхаба https://github.com/Eastern142/AlgorithmsAndDataStructuresOnPHP/blob/master/HW_1/task_1.php
