<?php   

class VSLTests extends \PHPUnit\Framework\TestCase
{
    public function testAdd()
    {
        $calc = new vsl\Calculator();
        $result = $calc->add(10, 20);
        $this->assertEquals(30, $result);
    }
}