<?php

use App\Exceptions\ExcecaoBasica;
use App\Http\Middleware\Cors;
use App\Http\Middleware\ValidadorRequisicaoMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('api', [ValidadorRequisicaoMiddleware::class]);
        $middleware->appendToGroup('api', [Cors::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $ex) {
            if($ex instanceof ExcecaoBasica) {
                return response(content: [
                    'statusCode' => $ex->httpStatusCode,
                    'data' => null,
                    'success' => false,
                    'message' => $ex->getMessage()
                ], status: $ex->httpStatusCode);
            }
    
            if($ex instanceof UnauthorizedHttpException) {
                return response(content: [
                    'statusCode' => 401,
                    'data' => null,
                    'success' => false,
                    'message' => "Parece que seu token expirou... Faça login novamente."
                ], status: 401);
            }

            if(env("ENVIRONMENT") == "debug") {
                return response(content: [
                    'statusCode' => 500,
                    'data' => $ex,
                    'success' => false,
                    'message' => $ex->getMessage()
                ], status: 500);
            }
    
            return response(content: [
                'statusCode' => 500,
                'data' => null,
                'success' => false,
                'message' => $ex->getMessage()
            ], status: 500);
        });
    })->create();
