<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function App\Helpers\EnviarResponse;
use function App\Helpers\GerarGUID;

require_once __DIR__ . '/Auth/Auth.php';
require_once __DIR__ . '/Usuario/UsuarioRoutes.php';

Route::get('/api-info', function () {
    return response()->json([
        'version' => '1.0.0',
        'status' => 'Running'
    ]);
});

Route::get('/guid', function(Request $request) {
    return EnviarResponse(
        content: [ 'guid' => GerarGUID() ]
    );
});