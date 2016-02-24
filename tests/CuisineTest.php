<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=cuisine_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_GetRestaurant()
        {
            //Arrange
            $type = "BBQ";
            $id = null;

            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $name = "Bob's";
            $address = "22 N. Street";
            $phone = "(218)443-2911";

            $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            //Act
            $result = $test_cuisine->getRestaurant();

            //Assert
            $this->assertEquals([$test_restaurant], $result);
        }


    }

?>
