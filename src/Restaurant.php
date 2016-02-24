<?php
class Restaurant
{
    private $name;
    private $address;
    private $phone;
    private $cuisine_id;
    private $id;


    function __construct($name, $address, $phone, $cuisine_id)
    {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->cuisine_id = $cuisine_id;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function setAddress($new_address)
    {
        $this->address = $new_address;
    }

    function getAddress()
    {
        return $this->address;
    }

    function setPhone($new_phone)
    {
        $this->phone = $new_phone;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getCuisineId()
    {
        return $this->cuisine_id;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO restaurant (name, address, phone, cuisine_id) VALUES ('{$this->getName()}','{$this->getAddress()}','{$this->getPhone()}',{$this->getCuisineId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant");
        $restaurants = array();
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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM restaurant;");
    }
  }
?>
