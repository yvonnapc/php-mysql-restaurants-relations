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

    function getName()
    {
        return $this->name;
    }

  }
?>
