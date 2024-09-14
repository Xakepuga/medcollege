## О проекте

Личный кабинет (CMS) для работников приёмной комиссии медицинского колледжа с возможностью
создания/просмотра/редактирования личных дел абитуриентов, формирования/экспорта различных отчетов (списков поступивших,
успеваемости и т.д.).

## Установка и запуск

1. Склонировать репозиторий:<br>
   `git clone https://github.com/CapFrostyMug/aispk.med.git`

2. Создать файл `.env` и заполнить своими данными;

#### Следующие действия необходимо выполнять, находясь в *корне* проекта

3. Поднять Docker:<br>
   `docker-compose up -d`

4. Установить папку vendor:<br>
   `docker exec -it tigratika composer install`

5. Опустить Docker:<br>
   `docker-compose down`

6. Поднять Docker (в фоновом режиме):<br>
   `./vendor/bin/sail up -d`

7. Сгенерировать APP_KEY:<br>
   `./vendor/bin/sail artisan key:generate`

8. Запустить миграции БД:<br>
   `./vendor/bin/sail artisan migrate`

9. Установить npm-зависимости:<br>
   `./vendor/bin/sail npm install`

10. Выполнить сборку фронт-части проекта:<br>
    `./vendor/bin/sail npm run build`

11. Для открытия проекта в браузере набрать в адресной строке:<br>
    `http://localhost/`

**Тестовые данные для входа:** example@mail.com / 1YdsRP6Y

При возникновении ошибки типа **"Failed to open stream: Permission denied"**, скорее всего, необходимо дать права для
работы с файлом **laravel.log** Для этого, находясь в папке с проектом, требуется выполнить
команду: `sudo chmod 777 -R ./`
