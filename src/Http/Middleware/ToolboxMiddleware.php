<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions\AcceptOnlyAction;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions\ContentType;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions\ContentTypeAction;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions\SetFieldAction;

class ToolboxMiddleware
{
    public function handle($request, Closure $next)
    {
        $config = config('malviklab-laravel-middleware-toolbox');

        /**
         * Accept
         */
        if (
            array_key_exists('acceptOnly', $config) &&
            !is_null($config['acceptOnly']) &&
            '' !== $config['acceptOnly']
        ) {
            $exec = AcceptAction::exec($request, [
                'acceptOnly' => $config['acceptOnly']
            ]);

            if ( $exec instanceof Response )
            {
                return $exec;
            }
        }

        /**
         * Content Type
         */
        if (
            array_key_exists('contentType', $config) &&
            !is_null($config['contentType']) &&
            '' !== $config['contentType']
        ) {
            $exec = ContentTypeAction::exec($request, [
                'contentType' => $config['contentType']
            ]);

            if ( $exec instanceof Response )
            {
                return $exec;
            }
        }

        /**
         * Set Field
         */
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
