
# Cats + Laravel + Vue

Тестовое задание на создание SPA используя Laravel, Vue3, ElementPlus.

## Установка

Выполните следующие действия, чтобы настроить проект на локальном компьютере.

### Предварительные условия

- Установленный Docker Desktop.
- Убедитесь, что другие локальные веб-серверы не работают на нужных вам портах.


### Шаг 1. Клонируйте репозиторий
```shell
$ git clone https://github.com/embersee/cats-laravel-vue.git
$ cd cat-laravel-vue
```

### Шаг 2. Запустите [Laravel Sail](https://laravel.com/docs/10.x/sail#installing-sail-into-existing-applications)
Убедитесь, что docker-desktop запущен.
```shell
$ sail up
```
или
```shell
$ ./vendor/bin/sail up
```

### Шаг 3: Настройка среды
Скопируйте файл .env.example, чтобы создать файл .env:
```shell
$ cp .env.example .env
```
### Шаг 4. Генерируйте данные базы данных
Автоматически сидируется записи БД с 10 кошками и 5 породами.
```shell
$ sail artisan db:seed
```
### Шаг 5: Запуск Vue
Приложение будет доступно по адресу http://localhost.
```shell
$ npm run dev
```
Чтобы остановить Sail, вы можете использовать:

```shell
$ sail down
```
---
# Cats + Laravel + Vue
Test task on creating a SPA using Laravel, Vue 3, Element Plus.

## Installation

Follow these steps to set up the project on your local machine.

### Prerequisites

- Docker Desktop
- Ensure no other local web servers are running on your desired ports


### Step 1: Clone the repository
```shell
$ git clone https://github.com/embersee/cats-laravel-vue.git
$ cd cats-laravel-vue 
```

### Step 2: Start [Laravel Sail](https://laravel.com/docs/10.x/sail#installing-sail-into-existing-applications)
Make sure docker-desktop is running.
```shell
$ sail up
```
or
```shell
$ ./vendor/bin/sail up
```

### Step 3: Set Up Environment
Copy the .env.example file to create a .env file:
```shell 
$ cp .env.example .env
```
### Step 4: Generate database seeder data
```shell
$ sail artisan db:seed
```
### Step 5: Running Vue
The application will be accessible at http://localhost.
```shell 
$ npm run dev 
```
To stop Sail, you can use:

```shell
$ sail down
```