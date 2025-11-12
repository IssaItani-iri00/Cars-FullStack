<?php 

//array of routes - a mapping between routes and controller name and method!
$apis = [
    '/cars'             => ['controller' => 'CarController', 'method' => 'getCars'],
    '/cars/add'         => ['controller' => 'CarController', 'method' => 'addCar'],
    '/users'            => ['controller' => 'UserController', 'method' => 'getUsers'],
    '/cars/update'      => ['controller' => 'CarController', 'method' => 'updateCar'],
    '/cars/delete'      => ['controller' => 'CarController', 'method' => 'deleteCar']
];
