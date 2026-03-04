<?php

use App\Http\Controllers\Api\NormalizerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/mockAPI/parcelas', [NormalizerController::class, 'parcelas']);
Route::get('/mockAPI/parcelas-pagas', [NormalizerController::class, 'parcelas_pagas']);
