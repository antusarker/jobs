<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CacheResponses
{
    public function handle($request, Closure $next, $ttl = 120)
    {
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        $key = 'response_cache:' . md5($request->fullUrl());

        if (Cache::store('redis')->has($key)) {
            $cached = Cache::store('redis')->get($key);
            return response($cached['content'])
                ->setStatusCode($cached['status'])
                ->withHeaders($cached['headers']);
        }

        $response = $next($request);

        if ($response->isSuccessful()) {
            Cache::store('redis')->put($key, [
                'content' => $response->getContent(),
                'status' => $response->status(),
                'headers' => $response->headers->all()
            ], $ttl);
        }

        return $response;
    }
}