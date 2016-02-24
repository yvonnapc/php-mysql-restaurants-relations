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

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisine;");
    }

  }
?>
