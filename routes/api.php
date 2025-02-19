<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('apikey')->group(function () {
    Route::post('/strutture', [ApiController::class, 'strutture']);
    Route::post('/lingue', [ApiController::class, 'lingue']);
    Route::post('/operatori', [ApiController::class, 'operatori']);
    Route::post('/target', [ApiController::class, 'target']);
    Route::post('/template', [ApiController::class, 'template']);
    Route::post('/template_default', [ApiController::class, 'template_default']);
    Route::post('/prefissi', [ApiController::class, 'prefissi']);
    Route::post('/template_link_preventivo', [ApiController::class, 'template_link_preventivo']);
    Route::post('/proposte_pacchetti', [ApiController::class, 'proposte_pacchetti']);
    Route::post('/tipo_soggiorni', [ApiController::class, 'tipo_soggiorni']);
    Route::post('/tipo_camere', [ApiController::class, 'tipo_camere']);
    Route::post('/servizi_aggiuntivi', [ApiController::class, 'servizi_aggiuntivi']);
    Route::post('/lista_sconti', [ApiController::class, 'lista_sconti']);
    Route::post('/lista_caparra', [ApiController::class, 'lista_caparra']);
    Route::post('/tipologia_tariffe', [ApiController::class, 'tipologia_tariffe']);
    Route::post('/fonte_provenienza', [ApiController::class, 'fonte_provenienza']);
    Route::post('/lista_info_box', [ApiController::class, 'lista_info_box']);
    Route::post('/info_box_by_template', [ApiController::class, 'info_box_by_template']);
    Route::post('/info_box_by_preventivo', [ApiController::class, 'info_box_by_preventivo']);
    Route::post('/condizioni_generali', [ApiController::class, 'condizioni_generali']);
    Route::post('/tipo_pagamenti', [ApiController::class, 'tipo_pagamenti']);
    Route::post('/lista_preventivi', [ApiController::class, 'lista_preventivi']);
    Route::post('/compila_preventivo', [ApiController::class, 'compila_preventivo']);
});


