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
├── README.md
├── app
│   ├── Console
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Exports
│   │   ├── CustomerExport.php
│   │   ├── EmployeeExport.php
│   │   ├── ServiceExport.php
│   │   ├── TicketExport.php
│   │   ├── TypeEmployeeExport.php
│   │   └── TypeServiceExport.php
│   ├── Http
│   │   ├── Controllers
│   │   ├── Kernel.php
│   │   ├── Middleware
│   │   └── Requests
│   ├── Models
│   │   ├── BillDetails.php
│   │   ├── Bills.php
│   │   ├── Cart.php
│   │   ├── Customers.php
│   │   ├── Employees.php
│   │   ├── Searches.php
│   │   ├── Services.php
│   │   ├── Shifts.php
│   │   ├── Tickets.php
│   │   ├── TypeEmployees.php
│   │   ├── TypeServices.php
│   │   └── User.php
│   ├── Policies
│   │   ├── CustomersPolicy.php
│   │   ├── EmployeesPolicy.php
│   │   ├── SearchesPolicy.php
│   │   ├── ServicesPolicy.php
│   │   ├── ShiftsPolicy.php
│   │   ├── TicketsPolicy.php
│   │   ├── TypeEmployeesPolicy.php
│   │   └── TypeServicesPolicy.php
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
│   ├── database.sqlite
│   ├── factories
│   │   ├── BillDetailsFactory.php
│   │   ├── BillsFactory.php
│   │   ├── CustomersFactory.php
│   │   ├── EmployeesFactory.php
│   │   ├── SearchesFactory.php
│   │   ├── ServicesFactory.php
│   │   ├── ShiftsFactory.php
│   │   ├── TicketsFactory.php
│   │   ├── TypeEmployeesFactory.php
│   │   ├── TypeServicesFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2024_03_20_064327_create_customers_table.php
│   │   ├── 2024_03_20_080442_create_type_services_table.php
│   │   ├── 2024_03_20_080658_create_type_employees_table.php
│   │   ├── 2024_03_20_080930_create_employees_table.php
│   │   ├── 2024_03_20_081158_create_services_table.php
│   │   ├── 2024_03_20_081730_create_shifts_table.php
│   │   ├── 2024_03_20_082158_create_tickets_table.php
│   │   ├── 2024_03_20_082306_create_bills_table.php
│   │   ├── 2024_03_20_082546_create_bill_details_table.php
│   │   └── 2024_03_20_082723_create_searches_table.php
│   └── seeders
│       ├── BillDetailsSeeder.php
│       ├── BillsSeeder.php
│       ├── CustomersSeeder.php
│       ├── DatabaseSeeder.php
│       ├── EmployeesSeeder.php
│       ├── SearchesSeeder.php
│       ├── ServicesSeeder.php
│       ├── ShiftsSeeder.php
│       ├── TicketsSeeder.php
│       ├── TypeEmployeesSeeder.php
│       └── TypeServicesSeeder.php
├── package.json
├── phpunit.xml
├── public
│   ├── favicon.ico
│   ├── index.php
│   ├── robots.txt
│   └── storage
public
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views
│       ├── authenticate
│       └── welcome.blade.php
├── routes
│   ├── CartController.php
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   │   └── public
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
│   ├── Feature
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit
│       └── ExampleTest.php
├── tree.txt
└── vite.config.js

40 directories, 119 files
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
