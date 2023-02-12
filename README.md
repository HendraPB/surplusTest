<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalasi

Download project
``` bash
git clone git@github.com:HendraPB/surplusTest.git
```

Atau download project menggunakan koneksi http
``` bash
git clone https://github.com/HendraPB/surplusTest.git
```

Ubah directory menuju directory project
``` bash
cd surplusTest
```

Copy file env
``` bash
cp .env.example .env
```

Buat database MySQL dan ubah setting koneksi database pada file .env menyesuaikan akses database serta nama database yang telah dibuat

Install dependency
``` bash
composer install
```

Install table
``` bash
php artisan migrate
```

Run project
``` bash
php artisan serve
```

Import collection api dari link berikut pada aplikasi postman
https://api.postman.com/collections/6785605-c6338c82-52ed-4091-bebb-5475a1cd38c6?access_key=PMAT-01GS3B6QRXQ56VF2EZ5WSJKXXY

Buat variable 'baseURL' pada postman dan isi dengan 'http://localhost:8000'

Panggil route api pada collection yang sudah diimport di postman