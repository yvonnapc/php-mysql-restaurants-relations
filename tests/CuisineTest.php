<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

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

        function test_getType()
        {
            //Arrange
            $type = "BBQ";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);

            //Act
            $result = $test_cuisine->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            //Arrange
            $type = "BBQ";
            $id = 1;
            $test_cuisine = new Cuisine($type, $id);

            //Act
            $result = $test_cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_GetRestaurants()
        {
            //Arrange
            $type = "BBQ";
            $id = null;

            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $name = "Bob's";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);
            $test_restaurant->save();
            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant], $result);
        }

        function test_save()
        {
            //Arrange
            $type = "BBQ";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $type = "BBQ";
            $id = null;
            $type2 = "italian";
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2, $id);
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $type = "BBQ";
            $id = null;
            $type2 = "italian";
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($type2, $id);
            $test_cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }


    }

?>
