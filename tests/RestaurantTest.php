<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=cuisine_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Bobs";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $new_name = new Restaurant($name, $address, $phone, $cuisine_id);

            //Act
            $result = $new_name->getName();

            //Assert
            $this->assertEquals("Bobs", $result);
        }

        function test_getAddress()
        {
            //Arrange
            $name = "Bobs";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = null;
            $id = null;

            $new_address = new Restaurant($name, $address, $phone, $cuisine_id);

            //Act
            $result = $new_address->getAddress();

            //Assert
            $this->assertEquals("22 N. Street", $result);
        }

        function test_getAll()
        {
            //Arrange
            $type = "BBQ";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Bobs";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id);
            $test_restaurant->save();

            $name2 = "Pizza Pizza";
            $address2 = "534 SE. Main";
            $phone2 = "(218)422-1111";
            $test_restaurant2 = new Restaurant($name2, $address2, $phone2, $cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);

        }

        function test_save()
        {
            //Arrange
            $type = "BBQ";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Bobs";
            $address = "22 N. Street";
            $phone = "(218)443-2911";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_find()
        {
          //Arrange
          $type = "BBQ";
          $id = null;
          $test_cuisine = new Cuisine($type, $id);
          $test_cuisine->save();

          $name = "Bobs";
          $address = "22 N. Street";
          $phone = "(218)443-2911";
          $cuisine_id = $test_cuisine->getId();
          $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);
          $test_restaurant->save();

          $name2 = "Jims";
          $address2 = "222 W.";
          $phone2 = "(211)222-3333";
          $cuisine_id = $test_cuisine->getId();
          $test_restaurant2 = new Restaurant($name2, $address2, $phone2, $cuisine_id, $id);
          $test_restaurant2->save();

          //Act
          $result = Restaurant::find($test_restaurant->getId());
          //Assert
          $this->assertEquals($test_restaurant, $result);
        }
        function test_update()
        {

          $type = "Meat";
          $id = null;
          $test_cuisine = new Cuisine($type, $id);
          $test_cuisine->save();

          $name = "Not Vegan";
          $address = "123 West";
          $phone = "818-222-2222";
          $cuisine_id = $test_cuisine->getId();
          $test_restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id);
          $test_restaurant->save();

          $new_name = "Vegan";
          //Act
          $test_restaurant->update($new_name);
          //Assert
          $this->assertEquals("Vegan", $test_restaurant->getName());

        }


    }

?>
