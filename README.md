# お問い合わせフォーム

## 環境構築

### Dockerビルド

１.git clone git@github.com:coachtech-material/laravel-docker-template.git

２.mv laravel-docker-template test 

３.git remote -v

４. git add .

５.docker-compose up -d --build

### Laravel環境構築

１.docker-compose exec php bash

２.composer install

３.cp .env.example .env　ーー＞　環境変数の変更

４.php artisan key:generate

５.php artisan migrate

６.php artisan db:seed

## 使用技術

php　7.4.9-fpm

Laravel 　8.75

MySQL　8.0.26

## ER図
<img width="703" alt="スクリーンショット 2025-04-16 0 01 06" src="https://github.com/user-attachments/assets/e4bad87d-8bca-4d1e-a075-c5b95a0a1fde" />


## URL

環境開発　http://localhost/

phpMyAdmin　http://localhost:8080/index.php


