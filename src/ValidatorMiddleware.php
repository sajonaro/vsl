<?php
namespace Vsl;
use Vsl\Core\IMiddleware;

class PersonValidatorMiddleware implements IMiddleware {
    public function handle($input, callable $next) {
        if (!isset($input->name) || empty($input->name)) {
            throw new \InvalidArgumentException("Name is required");
        }

        if (!isset($input->email) || !filter_var($input->email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Valid email is required");
        }

        return $next($input);
    }
}