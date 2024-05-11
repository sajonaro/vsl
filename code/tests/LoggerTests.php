<?php   

class LoggerTests extends \PHPUnit\Framework\TestCase
{
    public function test1()
    {
        $mediator = new Vsl\Core\Mediator();
        
        $mediator->addMiddleware(new Vsl\LoggerMiddleware());
        
        $result = $mediator->handle("input");
        
        $this->expectOutputString("received request with input");
    }
}