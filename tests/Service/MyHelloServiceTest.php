<?php
namespace App\Tests\Service;

use App\Service\MyHelloService;
use PHPUnit\Framework\TestCase;

class MyHelloServiceTest extends TestCase
{
    
    public function testSayHello()
    {
        $myHelloService = new MyHelloService();
        $this->assertEquals("Hello!", $myHelloService->sayHello());
    }
}