<?php

namespace Vsl\Core;

class PropertiesValidatorMiddleware implements IMiddleware {
    private $rules;

    //constructor receiving validation rules    
    public function __construct(array $rules) {
        $this->rules = $rules;
    }

    public function handle($input, callable $next) {
        foreach ($this->rules as $property => $rule) {
            if (!isset($input->$property) || !$rule($input->$property)) {
                throw new \InvalidArgumentException("Invalid value for $property");
            }
        }

        return $next($input);
    }
}