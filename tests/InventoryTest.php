<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Inventory.php';

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class InventoryTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Inventory::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "Shoes";
            $test_Inventory = new Inventory($name);
            $test_Inventory->save();

            //Act
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals($test_Inventory, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Shoes";
            $name2 = "Stamps";
            $test_inventory = new Inventory($name);
            $test_inventory->save();
            $test_inventory2 = new Inventory($name2);
            $test_inventory2->save();

            //Act
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals([$test_inventory, $test_inventory2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Shoes";
            $name2 = "Stamps";
            $test_inventory = new Inventory($name);
            $test_inventory->save();
            $test_inventory2 = new Inventory($name2);
            $test_inventory2->save();

            //Act
            Inventory::deleteAll();
            $result = Inventory::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Shoes";
            $name2 = "Stamps";
            $test_inventory = new Inventory($name);
            $test_inventory->save();
            $test_inventory2 = new Inventory($name2);
            $test_inventory2->save();

            //Act
            $result = Inventory::find($test_inventory->getId());

            //Assert
            $this->assertEquals($test_inventory, $result);
        }
    }
?>
