<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the project

It is an open source project that implements multitenant marketplace for any store to have thier own e-commerce on one server. The project is build on top of Laravel framework/

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Stack

PHP 8.2+
Laravel 11 
Tailwindcss
Daisy UI
Webpack! (not Vite) 
Inertia with Vuejs 3 (composition API)


## Main parts (features)

There are tree main parts of the project: admin panel, store crm, store frontend.

*Admin abilities*
Manage users and their stores 
Add another admins
Delete or deactivate stores ( remove all data in store) 
Login as Client and option to back without reset admin session 

*Store CRM*
Login / Register
crud products ( name price qty image) imagination 
crud category - every category will be added to navigation 
assign categories to products - can be assigned multiple categories
view orders - list
order statuses example: paid, completed, declined
statistics on dashboard

*Store frontend*
Any Registered store has his own storefront  with his id prefix (slug)
Navigation by categories in store 
product list by category - > store_slug/category_slug
minicart - when you add product you get cart popup 
Cart page with option to delete product
Checkout form with customer details
Success page that show the order id to the visitor and thank you 

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
