<?php

use App\Http\Controllers\Api\NormalizerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/sienge/parcelas', [NormalizerController::class, 'parcelas']);
