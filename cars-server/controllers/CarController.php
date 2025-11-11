<?php
include("../models/Car.php");
include("../connection/connection.php");
include("../services/ResponseService.php");

function getCars(){
    global $connection;

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $car = Car::find($connection, $id);
        echo ResponseService::response(200, $car->toArray());
    }else{
        $cars = Car::findAll($connection);
        $carsArray = [];
        foreach($cars as $car){
            $carsArray[] = $car->toArray();
        }
        echo ResponseService::response(200, $carsArray);
    }
}

getCars();

?>