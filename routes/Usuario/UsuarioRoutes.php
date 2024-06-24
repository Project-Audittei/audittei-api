<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function App\Helpers\EnviarResponse;

Route::get('/usuario/obterDados', function(Request $request) {
    return EnviarResponse(
        content: $request->user(),
        message: 'Consulta realizada com sucesso.'
    );
});