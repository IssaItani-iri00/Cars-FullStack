<?php 

//array of routes - a mapping between routes and controller name and method!
$apis = [
    '/cars{id}'         => ['controller' => 'CarController', 'method' => 'getCarByID'],
    '/cars'         => ['controller' => 'CarController', 'method' => 'getCar'],
    '/users'         => ['controller' => 'UserController', 'method' => 'getUsers']
];
