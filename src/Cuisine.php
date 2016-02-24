<?php
class Cuisine
{
    private $type;
    private $id;

    function __construct($type, $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    function setType($new_type)
    {
        $this->type = $new_type;
    }

    function getType()
    {
        return $this->type;
    }

    function getId()
    {
        return $this->id;
    }

    function getRestaurant()
    {
        $restaurants = array();
        $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant WHERE cuisine_id = {$this->getId()}");
        foreach($returned_restaurants as $restaurant) {
          $name = $restaurant['name'];
          $address = $restaurant['address'];
          $phone = $restaurant['phone'];
          $cuisine_id = $restaurant['cuisine_id'];
          $id = $restaurant['id'];
          $new_restaurant = new Restaurant($name, $address, $phone, $cuisine_id);
          array_push($restaurants, $new_restaurant);
        }
        return $restaurants;
        }
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO cuisine (type) VALUES ('{$this->getType()}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisine;");
    }

  }
?>
