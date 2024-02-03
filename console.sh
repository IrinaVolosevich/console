#!/bin/bash

if [ $# -eq 0 ]; then
    echo "Использование команды: $0 <директория>"
    exit 1
fi

directory="$1"

# Поиск файлов с названием "count" и обработка всех чисел в каждом файле
find "$directory" -type f -iname "count.*" -exec awk '{sum += $1} END {print "Общая сумма чисел по всем файлам в директории: " sum}' {} +