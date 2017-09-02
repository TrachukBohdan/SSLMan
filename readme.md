**Встановлення**

Встановити бібліотеки <br />
`composer install`

Налаштувати зєдняння із базою (.env) <br />
`
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sslman
DB_USERNAME=root
DB_PASSWORD=
`

Запустити міграції <br />
`
php artisan migrate
`

Щоб підлючити телегамовські веб хуки потрібно створити публічний https адрес <br />
`ngrok http --host-header=rewrite {domain}:80`
де `{domain}` локальний адрес  <br />

Налаштувати Telegram Бота<br />

`BOTMAN_TELEGRAM_TOKEN= токен бота
BOTMAN_TELEGRAM_WEBHOOK= веб хук бота`

Встановити вебхук<br />

`php artisan sllman:set-webhook`
