# Среда для веб-разработки

Настройки для Vagrant и Ansible для того, чтобы быстро развернуть среду для веб-разработки.

## Системные требования

 * Ubuntu 16.04 64-bit
 * Vagrant 1.8.6
 * VirtualBox 5.1
 * Ansible 2.3.0
 * Git 2.7.4

## Использование

Склонировать репозиторий на свой комьютер
```bash
~$ git clone https://github.com/bskton/webdev.git
```

Перейти в директорию vagrant
```bash
~$ cd webdev/vagrant
```

Запустить виртуальную машину
```bash
~/webdev/vagrant$ vagrant up
```

Перейти в диреторию ansible
```bash
~/webdev/vagrant$ cd ../ansible
```

Выполнить настройку виртуальной машины с помощью Ansible
```bash
~/webdev/ansible$ ansible-playbook dev.yml
```

Перейти в директорию проекта
```bash
~$ cd ../
```

Создать директорию www
```bash
~/webdev$ mkdir www
```

Примонтировать директорию с исходным кодом к хостовому компьютеру
```bash
~/webdev$ sudo mount -t cifs -o uid=ilya,gid=ilya,password=vagrant,username=vagrant,iocharset=utf8,sec=ntlm //192.168.34.10/www ./www
```

Добавить в директорию www файл index.php
```bash
~/webdev$ echo "This is webdev." >> www/index.php
```

Отрыть в браузере http://localhost:8080, должно появится сообщение `This is webdev.`