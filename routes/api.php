<?php

use App\Http\Controllers\Api\NormalizerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/mockAPI/clientes', [NormalizerController::class, 'parcelas']);
