##Встановлення

Встановити бібліотеки
`composer install`

Налаштувати зєдняння із базою (.env)
`
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sslman
DB_USERNAME=root
DB_PASSWORD=
`

Запустити міграції
`
php artisan migrate
`

Щоб підлючити телегамовські веб хуки потрібно створити публічний https адрес
`ngrok http --host-header=rewrite {domain}:80`
де `{domain}` локальний адрес 

Налаштувати Telegram Бота

`BOTMAN_TELEGRAM_TOKEN= токен бота
BOTMAN_TELEGRAM_WEBHOOK= веб хук бота`

Встановити вебхук

`php artisan sllman:set-webhook`
