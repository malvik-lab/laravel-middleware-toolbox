<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions\AcceptOnlyAction;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions\SetFieldAction;

class ToolboxMiddleware
{
    public function handle($request, Closure $next)
    {
        $config = config('malviklab-laravel-middleware-toolbox');

        if (
            array_key_exists('acceptOnly', $config) &&
            !is_null($config['acceptOnly']) &&
            '' !== $config['acceptOnly']
        ) {
            $exec = AcceptOnlyAction::exec($request, [
                'acceptOnly' => $config['acceptOnly']
            ]);

            if ( $exec instanceof Response )
            {
                return $exec;
            }
        }

        if ( array_key_exists('setFields', $config) )
        {
            foreach ( $config['setFields'] as $key => $value )
            {
                SetFieldAction::exec($request, [
                    'key' => $key,
                    'value' => $value
                ]);
            }
        }

        return $next($request);
    }
}
