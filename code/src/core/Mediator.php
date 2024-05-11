<?php
namespace Vsl\Core;

class Mediator {
    private $middlewares = [];

    public function addMiddleware(IMiddleware $middleware) {
        $this->middlewares[] = $middleware;
    }

    public function handle($input) {
        $middlewareChain = $this->createMiddlewareChain($this->middlewares);
        return $middlewareChain($input);
    }

    private function createMiddlewareChain(array $middlewares) {
        $middlewareChain = function ($input) {
            return $input;
        };

        while ($middleware = array_pop($middlewares)) {
            $middlewareChain = function ($input) use ($middleware, $middlewareChain) {
                return $middleware->handle($input, $middlewareChain);
            };
        }

        return $middlewareChain;
    }
}