<?php
class Restaurant
{
    private $name;
    private $address;
    private $phone;
    private $cuisine_id;
    private $id;


    function __construct($name, $address, $phone, $cuisine_id, $id)
    {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
        $this->cuisine_id = $cuisine_id;
        $this->id = $id;
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
  }
?>
