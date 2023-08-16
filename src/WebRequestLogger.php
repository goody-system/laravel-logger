<?php

namespace GoodyTech\LaravelLogger;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class WebRequestLogger {

    public function handle(Request $request, Closure $next, string ...$guards): Response{


        $request_values = [];
        foreach ($request->all() as $key => $value) {
            if (in_array($key, ['password'])) {
                $request_values[$key] = str_repeat('*', strlen($value));

            } else {
                $request_values[$key] = $value;
            }
        }


        Log::info(json_encode([
            'host' => $request->host()
            , 'url' => $request->url()
            , 'method' => $request->method()
            , 'ip' => $request->ip()
            , 'request_prm' => $request_values
        ]));
        return $next($request);
    }
}