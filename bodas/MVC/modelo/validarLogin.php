<?php
require_once __DIR__ . '/loginRegistroConsulta.php';
require_once __DIR__ . '/conexionBD.php';

class ValidadorUsuario
{
    private $db;

    public function __construct()
    {
        $conn = new baseDatos();
        $this->db = $conn->conectarBD();
    }

    public function validarCredenciales($correoIngresado, $contraIngresada)
    {
        try {
            $usuario = new Usuario($this->db, $correoIngresado);
            $contraseñaAlmacenada = $usuario->getPassword();
           
    
            if (($usuario->getCorreo() == $correoIngresado) && ($usuario->getPassword() == $contraIngresada)) {
                return [
                    "status" => true,
                    "nombreUsuario" => $usuario->getNombre(),
                    "correo" => $usuario->getCorreo(),
                    "tipoUsuario" => $usuario->getTipoUsuario(),
                    
                ];
            } else {
                throw new Exception("Contraseña incorrecta.");
            }
        } catch (Exception $e) {
            return [
                "status" => false,
                "error" => $e->getMessage()
            ];
        }
    }
    
}