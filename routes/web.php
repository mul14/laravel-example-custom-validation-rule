<?php

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

// Create custom validation rule
Validator::extend('logfile', function ($attribute, $value, $parameters, $validator) {
    $regexPattern = '/\.log$/';
    $filename = $value->getClientOriginalName();

    return preg_match($regexPattern, $filename);
});


$router->get('/', function () {
    return view('welcome');
});


$router->post('/', function () {

    $validator = validator()->make(request()->all(), [
        'file' => 'logfile',
    ]);

    return $validator->passes()
        ? 'Yup, ini log'
        : 'Ini bukan .log';
});
