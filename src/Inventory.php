<?php
    class Inventory
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO items (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_inventories = $GLOBALS['DB']->query("SELECT * FROM items;");
            $inventories = array();
            foreach($returned_inventories as $inventory) {
                $name = $inventory['name'];
                $id = $inventory['id'];
                $new_inventory = new Inventory($name, $id);
                array_push($inventories, $new_inventory);
            }
            return $inventories;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }
    }
?>
