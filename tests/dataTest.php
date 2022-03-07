<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once("src/data.php");

final class dataTest extends TestCase

{

    public function testusername(){

        $Data =new data;

        $result =$Data->getUser("sak@kea.dk");
        
        $this->assertEquals("Sakeeb", $result['FirstName']);

    }

    public function testusername1(){

        $Data =new data;

        $result =$Data->getUser("sak@kea.dk");

        $this->assertNotEquals("Adnan", $result['FirstName']);

    }

    public function testusername2(){

        $Data =new data;

        $result =$Data->getUser("sak@kea.dk");

        $this->assertEquals("Adnan", $result['LastName']);

    }

    public function testusername3(){

        $Data =new data;

        $result =$Data->getUser("sak@kea.dk");

        $this->assertEquals(true, $result['return']);

    }

    public function testusername4(){

        $Data =new data;

        $result =$Data->getUser("sak1@kea.dk");

        $this->assertEquals(false, $result['return']);

    }

    public function testusername5(){

        $Data =new data;

        $result =$Data->getUser("rony@kea.dk");

        $this->assertTrue(password_verify('rony', $result['Password']));

    }/*
    '$2y$10$psD69Rg4tZP6aKIDmLhfeeqMg1ImSY8073IEBR0UvMYLIvFcLhmga'

    public function testusername6(){

        $Data =new data;

        $result =$Data->getUser("sak@kea.dk");

        $this->assertEquals("Adnan", $result['LastName']);

    }



    public function testregistration() {

        $Data =new data;

        $result =$Data->registration("TestUser","sak1@kea.dk","sak");

        $this->assertNotEquals(20, $result);

    }



    public function testisUseExists() {

        $Data =new data;

        $result =$Data->isUseExists("sak1@kea.dk","sak");

        $this->assertEquals(false, empty($result));

    }



    public function testdeleteUser() {

        $Data =new data;

        $result =$Data->deleteUser("sak1@kea.dk","sak");

        $result =$Data->isUseExists("sak1@kea.dk","sak");

        $this->assertEquals(false, $result);

    }*/
}











