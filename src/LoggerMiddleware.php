<?php
namespace Vsl;
use Vsl\Core\IMiddleware;

class LoggerMiddleware implements IMiddleware {
    public function handle($input, callable $next) {
        echo "received request with ". $input;
        $result = $next($input);
        return $result;
    }
}