<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'IndexController';
$route['404_override'] = 'IndexController/notfound';
$route['translate_uri_dashes'] = FALSE;
//home
$route['danh-muc/(:any)']['GET'] = 'IndexController/category/$1';
$route['thuong-hieu/(:any)']['GET'] = 'IndexController/brand/$1';
$route['san-pham/(:any)']['GET'] = 'IndexController/product/$1';
$route['dang-nhap']['GET'] = 'IndexController/login';
$route['search-product']['GET'] = 'IndexController/search_product';
$route['contact']['GET'] = 'IndexController/contact';
$route['send-contact']['POST'] = 'IndexController/send_contact';

//Cart
$route['gio-hang']['GET'] = 'IndexController/cart';
$route['add-to-cart']['POST'] = 'IndexController/add_to_cart';
$route['update-cart-item']['POST'] = 'IndexController/update_cart_item';
$route['delete-all-cart']['GET'] = 'IndexController/delete_all_cart';
$route['delete-item-cart/(:any)']['GET'] = 'IndexController/delete_item_cart/$1';
//Checkout
$route['checkout']['GET'] = 'IndexController/checkout';
$route['confirm-checkout']['POST'] = 'IndexController/confirm_checkout';
$route['thanks']['GET'] = 'IndexController/thanks';
//login-customer
$route['dang-xuat']['GET'] = 'IndexController/logout_customer';
$route['login-customer']['POST'] = 'IndexController/login_customer';
//admin
$route['login']['GET'] = 'LoginController/index';
$route['login-user']['POST'] = 'LoginController/login';
$route['register-admin']['GET'] = 'LoginController/register_admin';
$route['register-insert']['POST'] = 'LoginController/register_insert';
//signup
$route['dang-ky']['POST'] = 'IndexController/signup_customer';
//Dashboard
$route['dashboard']['GET'] = 'DashboardController/index';
$route['logout']['GET'] = 'DashboardController/logout';
//brand
$route['brand/create']['GET'] = 'BrandController/create';
$route['brand/list']['GET'] = 'BrandController/index';
$route['brand/delete/(:any)']['GET'] = 'BrandController/delete/$1';
$route['brand/edit/(:any)']['GET'] = 'BrandController/edit/$1';
$route['brand/update/(:any)']['POST'] = 'BrandController/update/$1';
$route['brand/store']['POST'] = 'BrandController/store';
//Category
$route['category/create']['GET'] = 'CategoryController/create';
$route['category/list']['GET'] = 'CategoryController/index';
$route['category/delete/(:any)']['GET'] = 'Categorycontroller/delete/$1';
$route['category/edit/(:any)']['GET'] = 'CategoryController/edit/$1';
$route['category/update/(:any)']['POST'] = 'Categorycontroller/update/$1';
$route['category/store']['POST'] = 'CategoryController/store';
//Product
$route['product/create']['GET'] = 'ProductController/create';
$route['product/list']['GET'] = 'ProductController/index';
$route['product/delete/(:any)']['GET'] = 'Productcontroller/delete/$1';
$route['product/edit/(:any)']['GET'] = 'ProductController/edit/$1';
$route['product/update/(:any)']['POST'] = 'Productcontroller/update/$1';
$route['product/store']['POST'] = 'ProductController/store';
//order
$route['order/list']['GET'] = 'OrderController/index';
$route['order/view/(:any)']['GET'] = 'OrderController/view/$1';
$route['order/delete/(:any)']['GET'] = 'OrderController/delete_order/$1';
$route['order/proccess']['POST'] = 'OrderController/proccess';
//pagination
$route['pagination/index/(:num)'] = 'IndexController/index/$1';
$route['pagination/index'] = 'IndexController/index';
$route['danh-muc/(:any)/(:any)']['GET'] = 'IndexController/category/$1/$2';
//mail
$route['test-mail'] = 'IndexController/send_mail';
