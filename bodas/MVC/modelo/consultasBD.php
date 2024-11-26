<?php
require_once "conexionBD.php";

class consultaEventos{
    private $eventoConexion;
    public function __construct($conexion)
    {
     $this->eventoConexion = $conexion;   
    }

    public function eventos()
    {

    }

    public function consultaImagen($id_producto)
    {
        try {
            $consulta = $this->eventoConexion->prepare("SELECT * FROM producto WHERE id_producto = :id_producto");
            $consulta->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Error en consulta de imagen: " . $e->getMessage());
        }
    }

}

?>