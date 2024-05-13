
<?php   


class Person{
    public $name;
    public $email;
    public function __construct($name, $email){
        $this->name = $name;
        $this->email = $email;
    }

}


class ValidatorTests extends \PHPUnit\Framework\TestCase
{
    public function testInvalidInput()
    {
        $this->expectException(InvalidArgumentException::class);

        $validator = new Vsl\Core\PropertiesValidatorMiddleware([
            'name' => function ($value) { return !empty($value); },
            'email' => function ($value) { return filter_var($value, FILTER_VALIDATE_EMAIL); },
        ]);
        
        //email contains invalid value
        $person = new Person('John Doe', 'sdfsd');

        //should throw exception
        $result = $validator->handle($person, function($input){
            return $input;
        });
        
    }

    public function testValidInput()
    {

        $validator = new Vsl\Core\PropertiesValidatorMiddleware([
            'name' => function ($value) { return !empty($value); },
            'email' => function ($value) { return filter_var($value, FILTER_VALIDATE_EMAIL); },
        ]);
        
        //email contains invalid value
        $person = new Person('John Doe', 'sdfsd@gmail.com');

        //should throw exception
        $result = $validator->handle($person, function($input){
            return $input;
        });
        

        $this->assertEquals($person, $result);
    }
}

