
# Cats + Laravel + Vue ([en](#installation) / [ru](#установка))

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

### Шаг 2: Настройка среды
Скопируйте файл .env.example, чтобы создать файл .env:
```shell
$ cp .env.example .env
```

### Шаг 3: Установка Зависимостей
Установите зависимости PHP и Node через Composer и npm:
```shell
$ composer install && npm install
```

### Шаг 4. Запустите [Laravel Sail](https://laravel.com/docs/10.x/sail#installing-sail-into-existing-applications)
Убедитесь, что docker-desktop запущен.
```shell
$ composer install
$ sail up
```
или
```shell
$ ./vendor/bin/sail up
```
### Step 5: Генерируйте данные базы данных
Автоматически сидируется записи БД с 10 кошками и 5 породами.
```shell
$ sail artisan migrate
$ sail artisan db:seed
```

Всякий раз, когда изображение добавляется в базу данных, оно сохраняется в папке /storage/app/public. Чтобы связать его с папкой /public, запустите:
```shell
$ sail artisan storage:link
```

### Шаг 6: Запуск Vue
Приложение будет доступно по адресу http://localhost.
```shell
$ npm run dev
```

## Использование
### Запуск тестов:
```shell
$ sail artisan test
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

### Step 2: Set Up Environment
Copy the .env.example file to create a .env file:
```shell 
$ cp .env.example .env
```

### Step 3: Install Dependencies
Install PHP & Node dependencies through Composer and npm:
```shell
$ composer install && npm install
```

### Step 4: Start [Laravel Sail](https://laravel.com/docs/10.x/sail#installing-sail-into-existing-applications)
Make sure docker-desktop is running.
```shell
$ sail up
```
or
```shell
$ ./vendor/bin/sail up
```

### Step 5: Generate database seeder data
```shell
$ sail artisan migrate
$ sail artisan db:seed
```

Whenever an image is added to the db it will save to /storage/app/public folder, to link it to the /public folder, run:
```shell
$ sail artisan storage:link
```

### Step 6: Running Vue
The application will be accessible at http://localhost.
```shell 
$ npm run dev 
```
## Usage
### Running Test: 
```shell
$ sail artisan test
```

To stop Sail, you can use:
```shell
$ sail down
```
