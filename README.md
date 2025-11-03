<p>
  <img src="https://github.com/hendradwiputra/masjiid/blob/master/storage/app/public/images/icon/masjiid.png" style="width: 300px; height: 100px;">
</p>

# Aplikasi Jam Sholat Masjid

## Screenshot

### Available Themes
<p>
  <img src="https://github.com/hendradwiputra/masjiid/blob/master/storage/app/public/images/screenshot/theme1.png" style="width: auto; height: auto;">
</p>

<p>
  <img src="https://github.com/hendradwiputra/masjiid/blob/master/storage/app/public/images/screenshot/theme2.PNG" style="width: auto; height: auto;">
</p>

<p>
  <img src="https://github.com/hendradwiputra/masjiid/blob/master/storage/app/public/images/screenshot/theme3.png" style="width: auto; height: auto;">
</p>

### Dashboard Menu

<p>
  <img src="https://github.com/hendradwiputra/masjiid/blob/master/storage/app/public/images/screenshot/dashboard.png" style="width: auto; height: auto;">
</p>


## About Masjiid
Free to use. 

## Requirement

- PHP >= 8.2+
- Laravel 12
- Composer (https://getcomposer.org/download/)
- Nodejs (https://nodejs.org/en/download)

## How to install

- Clone the repository
```bash
git clone https://github.com/hendradwiputra/masjiid
cd masjiid
```
- Install dependencies
```
composer install
npm install
```
- Set up environment
```
cp .env.example .env
php artisan key:generate
```
- Configure database in .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_masjiid
DB_USERNAME=usr_masjiid
DB_PASSWORD=p@ssword
```
- Run migrations
```
php artisan migrate
```
- Create storage link for file uploads
```
php artisan storage:link
```
- Create admin user
- Compile assets
- Start the development server



