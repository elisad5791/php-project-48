# Вычислитель отличий

### Статус тестов и линтера
[![Actions Status](https://github.com/elisad5791/php-project-48/workflows/hexlet-check/badge.svg)](https://github.com/elisad5791/php-project-48/actions)
[![Actions Status](https://github.com/elisad5791/php-project-48/actions/workflows/ci.yml/badge.svg)](https://github.com/elisad5791/php-project-48/actions//workflows/ci.yml)
[![Test Coverage](https://api.codeclimate.com/v1/badges/3258193dff93596a9898/test_coverage)](https://codeclimate.com/github/elisad5791/php-project-48/test_coverage)

### Описание
 
Вычислитель отличий - программа, которая находит разность между двумя структурами данных. Это популярная задача, для ее решения существует много онлайн-сервисов.

Характеристики программы:

- Поддержка различных форматов ввода: yaml, json
- Генерация отчета в трех форматах - plain, stylish, json

### Системные требования

- php 8.0
- composer

### Установка

    git clone git@github.com:elisad5791/php-project-48.git
    cd php-project-48
    make install

Добавьте в файл .bashrc строчку

    export PATH="$PATH:$HOME/php-project-48/bin"

### Выполнение

    gendiff <file1> <file2> --format <format>

### Демонстрация

[видео](https://asciinema.org/a/525485)