# アプリケーション名
お問い合わせフォーム

## 環境構築
Dockerビルド<br>
1.<br>
2.docker-compose up -d --build<br>

Laravel環境構築<br>
1.docker-compose exec php bash<br>
2.composer install<br>
3..env.exampleファイルから.envを作成し、環境変数を変更<br>
4.php artisan key:generate<br>
5.php artisan migrate<br>
6.php artisan db:seed<br>


## 使用技術(実行環境)
・PHP 7.4.9<br>
・Laravel Framework 8.83.8<br>

## ER図
<img width="418" height="233" alt="ER図2025-07-26115145" src="https://github.com/user-attachments/assets/fece1a95-042f-4da8-8d41-8e84af4ceefd" />

## URL
・開発環境：http://localhost<br>
・phpMyAdmin：http://localhost:8080
