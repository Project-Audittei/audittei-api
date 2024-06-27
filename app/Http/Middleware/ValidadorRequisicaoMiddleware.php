<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ReflectionMethod;
use Symfony\Component\HttpFoundation\Response;

class ValidadorRequisicaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();

        if ($route) {
            $controller = $route->getController();

            if($controller) {
                $method = $route->getActionMethod();
    
                $reflection = new ReflectionMethod($controller, $method);
                $attributes = $reflection->getAttributes(\App\Attributes\ValidarRequest::class);
    
                if(method_exists($attributes[0]->getArguments()[0], $attributes[0]->getArguments()[1])) {
                    $parametros = call_user_func([$attributes[0]->getArguments()[0], $attributes[0]->getArguments()[1]]);
                    $mensagens = call_user_func([$attributes[0]->getArguments()[0], 'ValidacaoMensagens']);
    
                    $request->validate($parametros, $mensagens);
                }
            }
        }

        return $next($request);
    }
}
