<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Inventory.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));


    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig', array('items' => Inventory::getAll()));
    });

    $app->post("/items", function() use ($app) {
        $new_inventory = new Inventory($_POST['name']);
        $new_inventory->save();
        return $app['twig']->render('index.html.twig', array('items' => Inventory::getAll()));
    });
    $app->post("/delete_items", function() use ($app) {
        Inventory::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
?>
