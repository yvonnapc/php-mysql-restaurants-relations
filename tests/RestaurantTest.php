<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=cuisine_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Restaurant:deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $name = "Bob's";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $new_name = new Restaurant($name, $address, $phone, $cuisine_id, $id);

            //Act
            $result = $new_name->getName();

            //Assert
            $this->assertEquals("Bob's", $result);
        }

        function test_getAddress()
        {
            //Arrange
            $name = "Bob's";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $new_address = new Restaurant($name, $address, $phone, $cuisine_id, $id);

            //Act
            $result = $new_address->getAddress();

            //Assert
            $this->assertEquals("22 N. Street", $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Bob's";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);
            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant], $result);

        }

        function test_save()
        {
            //Arrange
            $name = "Bob's";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }



    }

?>
