<?php
namespace Vsl\Core;

interface IMiddleware{
    public function handle($input, callable $next);
}