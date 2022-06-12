<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions;

use Illuminate\Http\Request;

class AcceptOnlyAction implements ActionInterface
{
    public static function exec(Request $request, array $config)
    {
        if ( !$request->hasHeader('accept') || $config['acceptOnly'] !== $request->header('accept') )
        {
            return response(sprintf('Use the "Accept: %s" HTTP Header', $config['acceptOnly']), 400)
                ->header('Content-Type', 'text/plain');
        }
    }
}
