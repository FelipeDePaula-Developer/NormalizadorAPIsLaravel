<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Parâmetros da query string (?q=laravel&page=2)
        $query = $request->query('q');
        $page  = $request->query('page', 1); // valor padrão

        return response()->json([
            'search' => $query,
            'page'   => (int) $page
        ]);
    }
}
