<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $app = new Silex\Application();
    // $app['debug'] = true;
    $server = 'mysql:host=localhost;dbname=cuisine';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app){
      return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines", function() use ($app) {
      return $app['twig']->render('cuisine.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app){
      $cuisine = Cuisine::find($id);
      return $app['twig']->render('restaurant.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/cuisines", function() use ($app) {
      $cuisine = new Cuisine($_POST['type']);
      $cuisine->save();
      return $app['twig']->render('cuisine.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/restaurants", function() use ($app) {
      return $app['twig']->render('restaurant.html.twig', array('restaurants' => Restaurant::getAll()));
    });

    // $app->post("/restaurants", function() use ($app) {
    //   $restaurant = new Restaurant($_POST['name'], $_POST['address'], $_POST['phone']);
    //   $restaurant->save();
    //   return $app['twig']->render('restaurant.html.twig', array('cuisines' => Cuisine::getAll(), 'restaurants'=> Restaurant::getAll()));
    // });

    $app->post("/restaurants", function() use ($app) {
      $name = $_POST['name'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $cuisine_id = $_POST['cuisine_id'];
      $restaurant = new Restaurant($name, $address, $phone, $cuisine_id, $id=null);
      $restaurant->save();
      $cuisine = Cuisine::find($cuisine_id);
      return $app['twig']->render('restaurant.html.twig', array('cuisine' => $cuisine, 'restaurants' => $cuisine->getRestaurants()));
    });

    $app->post("/delete_cuisines", function() use($app){
      Cuisine::deleteAll();
      return $app['twig']->render("index.html.twig");
    });

      return $app;

?>
