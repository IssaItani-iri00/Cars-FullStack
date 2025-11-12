<?php
abstract class Model{

    protected static string $table;
    //protected static string $primary_key = "id";

    public static function find(mysqli $connection, int $id, string $primary_key = "id"){
        $sql = sprintf("SELECT * from %s WHERE %s = ?",
                       static::$table,
                       $primary_key);
                       //static::$primary_key);

        $query = $connection->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();               

        $data = $query->get_result()->fetch_assoc();

        return $data ? new static($data) : null;
    }

     public static function findAll(mysqli $connection){
        $sql = sprintf("SELECT * from %s",
                       static::$table);

        $query = $connection->prepare($sql);
        $query->execute();               

        $result = $query->get_result();
        $records = [];

        while($data = $result->fetch_assoc()){
            $records[] = new static($data);
        }

        return $records;
    }

    public static function create(mysqli $connection, string $name, string $year, string $color){
        $sql = sprintf("INSERT INTO %s (name, year, color) VALUES (?, ?, ?)",
                       static::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("sss", $name, $year, $color);
        $query->execute();               

        $id = $connection->insert_id;

        return static::find($connection, $id);
    }

    public static function update(mysqli $connection, int $id, string $name, string $color){
        $sql = sprintf("UPDATE %s SET name = ?, color = ? WHERE id = ?", static::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("ssi", $name, $color, $id);
        $query->execute();

        return static::find($connection, $id);

    }

    public static function delete(mysqli $connection, int $id){
        $sql = sprintf("DELETE FROM %s WHERE id = ?", static::$table);

        $query = $connection->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        return $query->affected_rows > 0;
    }


}



?>
