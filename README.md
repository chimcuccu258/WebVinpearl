<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Getting started

### About:
- This project was developed by `Minh Nga (63130803)` and `Hoang Trong (63135901)`.

### Available scripts

-   Use to install or update Composer:  
    `composer install` | `composer update`

-   Start project:  
    `php artisan key:generate` | `php artisan migrate` | `php artisan serve`

## Folder Structure

```jsx
├── LICENSE
├── README.md
├── app
│   ├── Console
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Exports
│   │   ├── DichVuExport.php
│   │   ├── KhachHangExport.php
│   │   ├── LoaiDichVuExport.php
│   │   ├── LoaiNhanVienExport.php
│   │   ├── NhanVienExport.php
│   │   └── VeExport.php
│   ├── Http
│   │   ├── Controllers
│   │   ├── Kernel.php
│   │   ├── Middleware
│   │   └── Requests
│   ├── Models
│   │   ├── Cart.php
│   │   ├── Cthd.php
│   │   ├── DichVu.php
│   │   ├── HoaDon.php
│   │   ├── KhachHang.php
│   │   ├── LoaiDichVu.php
│   │   ├── LoaiNhanVien.php
│   │   ├── NhanVien.php
│   │   ├── Search.php
│   │   ├── SoCa.php
│   │   ├── User.php
│   │   └── Ve.php
│   ├── Policies
│   │   ├── DichVuPolicy.php
│   │   ├── KhachHangPolicy.php
│   │   ├── LoaiDichVuPolicy.php
│   │   ├── LoaiNhanVienPolicy.php
│   │   ├── NhanVienPolicy.php
│   │   ├── SearchPolicy.php
│   │   ├── SoCaPolicy.php
│   │   └── VePolicy.php
│   └── Providers
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── artisan
├── bootstrap
│   ├── app.php
│   └── cache
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── debugbar.php
│   ├── excel.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database
│   ├── factories
│   │   ├── CthdFactory.php
│   │   ├── DichVuFactory.php
│   │   ├── HoaDonFactory.php
│   │   ├── KhachHangFactory.php
│   │   ├── LoaiDichVuFactory.php
│   │   ├── LoaiNhanVienFactory.php
│   │   ├── NhanVienFactory.php
│   │   ├── SearchFactory.php
│   │   ├── SoCaFactory.php
│   │   ├── UserFactory.php
│   │   └── VeFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2024_03_25_120328_create_khach_hangs_table.php
│   │   ├── 2024_03_25_120420_create_loai_dich_vus_table.php
│   │   ├── 2024_03_25_120533_create_loai_nhan_viens_table.php
│   │   ├── 2024_03_25_120554_create_nhan_viens_table.php
│   │   ├── 2024_03_25_120618_create_dich_vus_table.php
│   │   ├── 2024_03_25_120705_create_so_cas_table.php
│   │   ├── 2024_03_25_120730_create_ves_table.php
│   │   ├── 2024_03_25_120758_create_hoa_dons_table.php
│   │   ├── 2024_03_25_120828_create_cthds_table.php
│   │   └── 2024_03_25_120852_create_searches_table.php
│   └── seeders
│       ├── DatabaseSeeder.php
│       ├── DichVuSeeder.php
│       ├── KhachHangSeeder.php
│       ├── LoaiDichVuSeeder.php
│       ├── LoaiNhanVienSeeder.php
│       ├── NhanVienSeeder.php
│       ├── SearchSeeder.php
│       ├── SoCaSeeder.php
│       └── VeSeeder.php
├── lang
│   ├── en
│   │   ├── auth.php
│   │   ├── pagination.php
│   │   ├── passwords.php
│   │   └── validation.php
│   └── en.json
├── package.json
├── phpunit.xml
├── public
│   ├── css
│   │   └── style.css
│   ├── favicon.ico
│   ├── index.php
│   ├── js
│   │   └── script.js
│   ├── robots.txt
│   └── storage -> /Users/minhngane/Documents/Github/WebVinpearl/storage/app/public
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views
│       ├── admin
│       ├── authenticate
│       ├── cart
│       ├── emails
│       ├── index.blade.php
│       ├── info.blade.php
│       ├── layouts
│       ├── profile
│       ├── search.blade.php
│       └── show.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   │   └── public
│   ├── debugbar
│   ├── framework
│   │   ├── cache
│   │   ├── sessions
│   │   ├── testing
│   │   └── views
│   └── logs
│       └── laravel.log
├── stubs
│   ├── export.model.stub
│   ├── export.plain.stub
│   ├── export.query-model.stub
│   ├── export.query.stub
│   ├── import.collection.stub
│   └── import.model.stub
├── tests
│   ├── CreatesApplication.php
│   ├── Feature
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit
│       └── ExampleTest.php
└── webpack.mix.js

50 directories, 146 files
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
