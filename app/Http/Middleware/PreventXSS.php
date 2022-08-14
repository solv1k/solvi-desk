<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventXSS
{
    /**
     * Имена параметров запроса, которые не будут фильтроваться от HTML-тегов и JS-скриптов.
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request_data = $request->all();

        array_walk_recursive($request_data, function (&$request_data_item, $key) {
            if (! in_array($key, $this->except)) {
                $request_data_item = strip_tags($request_data_item);
            }
        });

        $request->merge($request_data);

        return $next($request);
    }
}
