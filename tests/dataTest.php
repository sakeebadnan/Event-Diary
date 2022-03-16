<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once("src/data.php");

final class dataTest extends TestCase

{
    public function testuserregister(){

        $Data =new data;
        $value['Address']='Ruten 137';
        $value['City']='Brønshøj';
        $value['State']='Copenhagen';
        $value['Country']='Denmark';
        $value['PostalCode']='2700';
        $value['Phone']='12345678';
        $value['FirstName']='First';
        $value['LastName']='Last';
        $value['Age']=35;
        $value['Password']='1234';
        $value['Email']='test@php.com';

        $result =$Data->addUser($value);
        $expected=true;
        $this->assertEquals($expected, $result);
    }

    public function testusername1(){

        $Data =new data;

        $result =$Data->getUser("test@php.com");
        
        $this->assertEquals("First", $result['FirstName']);

    }

    public function testusername2(){

        $Data =new data;

        $result =$Data->getUser("test@php.com");

        $this->assertNotEquals("Last", $result['FirstName']);

    }

    public function testusername3(){

        $Data =new data;

        $result =$Data->getUser("test@php.com");

        $this->assertEquals("Last", $result['LastName']);

    }

    public function testusername4(){

        $Data =new data;

        $result =$Data->getUser("test@php.com");

        $this->assertEquals(true, $result['return']);

    }

    public function testusername5(){

        $Data =new data;

        $result =$Data->getUser("test1@php.com");

        $this->assertEquals(false, $result['return']);

    }

    public function testusername6(){

        $Data =new data;

        $result =$Data->getUser("test@php.com");

        $this->assertTrue(password_verify('1234', $result['Password']));

    }
    
    public function testsqlinjection7(){

        $Data =new data;

        $result =$Data->sqlInjection("https://www.ticketmaster.com/phoenix-suns-vs-milwaukee-bucks-phoenix-arizona-02-10-2022/event/19005B134AD63FE6");

        $this->assertEquals('https://www.ticketmaster.com/phoenix-suns-vs-milwaukee-bucks-phoenix-arizona-02-10-2022/event/19005B134AD63FE6', $result);

    }
    public function testsqlinjection8(){

        $Data =new data;
        $result =$Data->sqlInjection("    ");
        $expected=null;
        $this->assertEquals($expected, $result);

    }
    public function testsqlinjection9(){

        $Data =new data;
        $result =$Data->sqlInjection("a    b    c");
        $expected='a b c';
        $this->assertEquals($expected, $result);

    }
    public function testsqlinjection10(){

        $Data =new data;
        $result =$Data->sqlInjection('<script>alert("You need to Select a Category")</script>');
        $expected='alert(You need to Select a Category)';
        $this->assertEquals($expected, $result);

    }
    public function testsqlinjection11(){

        $Data =new data;
        $result =$Data->sqlInjection("<script>alert('You need to Select a Category')</script>");
        $expected="alert('You need to Select a Category')";
        $this->assertEquals($expected, $result);

    } public function testsqlinjection12(){

        $Data =new data;
        $result =$Data->sqlInjection('<script>alert("You need to Select a Category")</script>');
        $expected="alert(You need to Select a Category)";
        $this->assertEquals($expected, $result);

    }
    public function testsqlinjection13(){

        $Data =new data;
        $result =$Data->sqlInjection('goto');
        $expected="goto";
        $this->assertEquals($expected, $result);

    }
    public function testuseraddress14(){

        $Data =new data;

        $result =$Data->getUser("test@php.com");

        $this->assertEquals("Brønshøj", $result['City']);

    }
    public function testuserregister15(){

        $Data =new data;
        $value['Address']=null;
        $value['City']=null;
        $value['State']=null;
        $value['Country']=null;
        $value['PostalCode']=null;
        $value['Phone']=null;
        $value['FirstName']='Goto';
        $value['LastName']='abul';
        $value['Age']=5;
        $value['Password']='1234';
        $value['Email']='go@to.com';

        $result =$Data->addUser($value);
        $expected=true;
        $this->assertEquals($expected, $result);
    }
    public function testdeluser16(){

        $Data =new data;
        $value='go@to.com';
        $response = $Data->getUser($value);
        $result =$Data->delUser($response['Id']);
        $expected=true;
        $this->assertEquals($expected, $result);
    }

    public function testuserregister17(){

        $Data =new data;
        $value['Address']='<script>alert("You need to Select a Category")</script>';
        $value['City']='dh    aka';
        $value['FirstName']='Goto';
        $value['LastName']='abul';
        $value['Age']=5;
        $value['Password']='1234';
        $value['Email']='not@to.com';

        $result =$Data->addUser($value);
        $expected=true;
        $this->assertEquals($expected, $result);
    }
    public function testdeluser18(){

        $Data =new data;
        $value='not@to.com';
        $response = $Data->getUser($value);
        $result =$Data->delUser($response['Id']);
        $expected=true;
        $this->assertEquals($expected, $result);
    }
    public function testuserregister19(){

        $Data =new data;
        $value['Address']='<script>alert("You need to Select a Category")</script>';
        $value['City']='dh    aka';
        $value['FirstName']='Goto';
        $value['LastName']='abul';
        $value['Age']=5;
        $value['Password']='1234';
        $value['Email']=null;

        $result =$Data->addUser($value);
        $expected=false;
        $this->assertEquals($expected, $result);
    }
    public function testuserregister20(){

        $Data =new data;
        $value['Address']='<script>alert("You need to Select a Category")</script>';
        $value['City']='dh    aka';
        $value['FirstName']='Goto';
        $value['LastName']='abul';
        $value['Age']=5;
        $value['Password']='1234';

        $result =$Data->addUser($value);
        $expected=false;
        $this->assertEquals($expected, $result);
    }
    public function testuserregister21(){

        $Data =new data;
        $value=null;
        $result =$Data->addUser($value);
        $expected=false;
        $this->assertEquals($expected, $result);
    }
    

    public function testuserupdate23(){

        $Data =new data;
        $value='test@php.com';
        $value=$Data->getUser($value);
        $value['FirstName']='EditFirst';
        $value['LastName']='EditLast';
        unset($value['return']);
        $result =$Data->updateUser($value);
        $expected=true;
        $this->assertEquals($expected, $result);
    }
    public function testuserupdate24(){

        $Data =new data;
        $value='test@php.com';
        $response = $Data->getUser($value);
        $expected='EditFirst';
        $this->assertEquals($expected, $response['FirstName']);
    }
    public function testpassupdate25(){

        $Data =new data;
        $email='test@php.com';
        $user= $Data->getUser($email);
        $id=$user['Id'];
        $response=$Data->passUpdate('abc1234',$id);
        $expected=true;
        $this->assertEquals($expected, $response);
    }
    public function testpassupdate26(){

        $Data =new data;
        $value='test@php.com';
        $response = $Data->getUser($value);
        $expected='abc1234';
        $this->assertTrue(password_verify($expected, $response['Password']));
    }

    public function testuserupdate27(){
        $Data =new data;
        $value='test@php.com';
        $value=$Data->getUser($value);
        
        unset($value['return'],$value['Address'],$value['City'],$value['State'],$value['Country'],$value['PostalCode'],$value['Phone']);
        $result =$Data->updateUser($value);
        $expected=true;
        $this->assertEquals($expected, $result);
    }

    public function testuserupdate28(){

        $Data =new data;
        $value='test@php.com';
        $response = $Data->getUser($value);
        $expected=false;
        $this->assertEquals($expected, isset($response['Address']));
    }
    public function testuserupdate29(){

        $Data =new data;
        $email='test@php.com';
        $value=$Data->getUser($email);
        $value['PostalCode']='<p>2700<p>';
        unset($value['return']);
        $result =$Data->updateUser($value);
        $expected=true;
        $this->assertEquals($expected, $result);
    }
    public function testuserupdate30(){

        $Data =new data;
        $value='test@php.com';
        $response = $Data->getUser($value);
        $expected='2700';
        $this->assertEquals($expected, $response['PostalCode']);
    }
    public function testInsertEventsDb31(){
        $Data =new data;
        $email='test@php.com';
        $result = $Data->getUser($email);
        $value['Id'] =$result['Id'];
        $value['eventId']='03-16-2022 02:33:44.00000';
        $value['category']="Self";
        $value['eventUrl']="#";
        $value['imageUrl']="http://event-diary.herokuapp.com/img/logo.png";
        $value['eventName']='My event';
        $value['city']='Cpoenhagen';        
        $value['eventDate']='2022-04-10';
        $value['eventTime']='22:50:00';
        $value['address']='Ruten 31';
        $value['country']='Denmark';
        $response = $Data->InsertEventsDb($value);
        $expected='success';
        $this->assertEquals($expected, $response);
    }
    public function testseeEvents32(){
        $Data =new data;
        $email='test@php.com';
        $result = $Data->getUser($email);
        $response = $Data->seeEvents('all',$result['Id']);
        $expected='03-16-2022 02:33:44.00000';
        foreach($response as $row)
        $this->assertEquals($expected, $row->EventGlobalId);

    }
    public function testdelEvents33(){
        $Data =new data;
        $email='test@php.com';
        $result = $Data->getUser($email);
        $id=$result['Id'];
        $res = $Data->seeEvents('all',$id);
        foreach($res as $row)
        $eventId=$row->EventId;
        $response = $Data->delEvent($eventId,$id);
        $expected=true;
        $this->assertEquals($expected, $response);


    }
    public function testseeEvents34(){
        $Data =new data;
        $email='test@php.com';
        $result = $Data->getUser($email);
        $response = $Data->seeEvents('all',$result['Id']);
        $expected=false;
        foreach($response as $row)
        $value=$row->EventGlobalId;
        $this->assertEquals($expected, isset($value));

    }
    public function testdeluser35(){

        $Data =new data;
        $value='test@php.com';
        $response = $Data->getUser($value);
        $result =$Data->delUser($response['Id']);
        $expected=true;
        $this->assertEquals($expected, $result);
    }    
}











