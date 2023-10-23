<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|
| GUEST
|
*/

require 'guest.php';

/*
|
| AUTHENTICATED USER
|
*/

require 'user.php';

/*
|
| ADMIN
|
*/

require 'admin.php';

/*
|
| AUTH
|
*/

require 'auth.php';
