<?php

class baseDatos{

    const HOST = "localhost";
    const USER = "pizzas";
    const PASSWORD = "!emo.([wPTyxNTmO";
    const DATABASE = "pizzasfantaso";

    public static function conectarBD() {
        try {
            //asi se conecta utilizando PDO
            $conexion = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USER, self::PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }    
        
    }
}


?>