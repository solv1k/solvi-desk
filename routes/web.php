<?php

use Illuminate\Support\Facades\Route;

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

require __DIR__.'/guest.php';

/*
|
| AUTHENTICATED USER
| 
*/

require __DIR__.'/user.php';

/*
|
| ADMIN
| 
*/

require __DIR__.'/admin.php';

/*
|
| AUTH
| 
*/

require __DIR__.'/auth.php';
