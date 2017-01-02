# Каркас для проекта по веб-разработке

В данном репозитории содержатся скрипты, создающие и настраивающие 
виртуальную машину, которую можно использовать для разработки 
веб-проектов (сайтов, сервисов и веб-приложений).

Виртуальная машина поднимается на компьютере разработчика с IP 192.168.34.10

На виртуальную машину устанавливаются
 * Nginx
 * Php
 * Composer
 * Redis
 * PHPUnit
 * XDebug
 * phpDocumentor
 * MongoDB

Исходный код веб-проектов должен быть размещен в директории www.

Файлы размещенные в директории www/public доступны через браузер 
по адресу https://192.168.34.10/

Сертификат для доступа к сайту по HTTPS самоподписанный.

## Системные требования

 * Ubuntu 16.04 64-bit
 * Vagrant 1.8.6
 * VirtualBox 5.1
 * Ansible 2.3.0
 * Git 2.7.4

## Использование

Склонировать репозиторий на свой комьютер
```bash
~$ git clone git@github.com:bskton/webdev.git
```

Перейти в директорию webdev
```bash
~$ cd webdev
```

Создать файл с переменными для Ansible
```bash
~/webdev$ cp ansible/group_vars/all.yml.dev ansible/group_vars/all.yml
```

Создать конфигурационный файл для Ansible
```bash
~/webdev$ cp ansible/ansible.cfg.dev ansible/ansible.cfg
```

Перейти в директорию vagrant
```bash
~/webdev$ cd vagrant
```

Запустить виртуальную машину
```bash
~/webdev/vagrant$ vagrant up
```
будет создана виртуальная машина.

Перейти в диреторию ansible
```bash
~/webdev/vagrant$ cd ../ansible
```

Выполнить настройку виртуальной машины с помощью Ansible
```bash
~/webdev/ansible$ ansible-playbook dev.yml
```
будут установлены и настроены все необходимые пакеты. Это займет некоторое время.

Отрыть в браузере https://192.168.34.10/, должно появится сообщение `This is webdev.`