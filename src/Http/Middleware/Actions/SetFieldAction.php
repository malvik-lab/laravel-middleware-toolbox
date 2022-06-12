<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions;

use Illuminate\Http\Request;

class SetFieldAction implements ActionInterface
{
    public static function exec(Request $request, array $config)
    {
        $request->headers->set($config['key'], $config['value']);
    }
}
