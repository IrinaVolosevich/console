<?php

if ($argc < 2) {
    echo "Использование команды: php script.php <директория>\n";
    exit(1);
}

$directory = $argv[1];

function processFiles($filePath) {
    $sum = 0;

    $file = fopen($filePath, 'r');
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $sum += floatval($line);
        }

        fclose($file);
    }

    return $sum;
}

function processDirectory($directory) {
    $totalSum = 0;

    $items = scandir($directory);
    foreach ($items as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        $itemPath = $directory . '/' . $item;

        if (is_dir($itemPath)) {
            $totalSum += processDirectory($itemPath);
        } elseif (is_file($itemPath) && preg_match('/^count\./i', $item)) {
            $totalSum += processFiles($itemPath);
        }
    }

    return $totalSum;
}

$totalSum = processDirectory($directory);

echo "Общая сумма чисел по всем файлам в директории: $totalSum\n";
