<?php
require_once(__DIR__ . "/../models/Car.php");
require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/../services/ResponseService.php");

class CarController {

    function getCars(){
        global $connection;

        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $car = Car::find($connection, $id);
            echo ResponseService::response(200, $car->toArray());
        }
        else{
            $cars = Car::findAll($connection);
            $carsArray = [];
            foreach($cars as $car){
            $carsArray[] = $car->toArray();
        }
        echo ResponseService::response(200, $carsArray);
        }
    }
    
    function addCar(){
        global $connection;

        if(!isset($_POST["name"]) || !isset($_POST["year"]) || !isset($_POST["color"])){
            echo ResponseService::response(400, "Enter all the fields");
        }
        else{
            $name = $_POST["name"];
            $year = $_POST["year"];
            $color = $_POST["color"];
            
            $newCar = Car::create($connection, $name, $year, $color);
            
            echo ResponseService::response(201, $newCar->toArray());
        }
    }

    function updateCar(){
        global $connection;

        if(!isset($_POST["id"])){
            echo ResponseService::response(400, "Enter ID first.");
        }
        if(isset($_POST["year"])){
            echo ResponseService::response(400, "You can't edit a cars' year!");
        }
        else{
            $id = $_POST["id"];
            
            $existingCar = Car::find($connection, $id);
            
            if(!$existingCar){
                echo ResponseService::response(404, "No car exists with this ID!");
                return;
            }
            
            $name = isset($_POST["name"]) ? $_POST["name"] : $existingCar->getName();
            $color = isset($_POST["color"]) ? $_POST["color"] : $existingCar->getColor();
            
            $updatedCar = Car::update($connection, $id, $name, $color);
            
            echo ResponseService::response(200, $updatedCar->toArray());
        }
    }
}

?>