<?php
use App\Http\Controllers\Controller;

//use App\Http\Controllers\ApiFormController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

 Route::get('/', function () {
    return '<a href="'.url('REST_API_QUOTO.pdf').'">REST API QUOTO!</a> - by Network Service srl';
}); 


//Route::get('/send_form', [ApiFormController::class, 'send_form']);