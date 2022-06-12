<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\Actions;

use Illuminate\Http\Request;

interface ActionInterface
{
    public static function exec(Request $request, array $config);
}
