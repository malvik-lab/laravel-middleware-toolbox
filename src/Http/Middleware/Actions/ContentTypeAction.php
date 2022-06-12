<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions;

use Illuminate\Http\Request;

class ContentTypeAction implements ActionInterface
{
    public static function exec(Request $request, array $config)
    {
        if (
            !$request->hasHeader('content-type') ||
            $config['contentType'] !== $request->header('content-type')
        ) {
            return response(sprintf('Use the "Content-Type: %s" HTTP Header', $config['contentType']), 400)
                ->header('Content-Type', 'text/plain');
        }
    }
}
