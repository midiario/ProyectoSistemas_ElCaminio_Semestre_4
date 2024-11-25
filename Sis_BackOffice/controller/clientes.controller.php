<?php
session_start();


require_once 'model/clientes.php';

class ClientesController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new clientes();
    }

    private function verificarSesion(){
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['session_email']) || empty($_SESSION['session_email'])) {
            // Si no está autenticado, redirigir al inicio de sesión
            header("Location: index.php");
            exit();
        }
    }

    // Método privado para evitar el almacenamiento en caché
    private function evitarCache(){
        // Evitar que el navegador almacene en caché la página
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); // Fecha en el pasado
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Siempre modificado
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    

    //Llamado plantilla principal
    public function Index(){
        $this->verificarSesion(); // Verificar si el usuario está autenticado
        $this->evitarCache();     

       require_once 'view/pago/header.php';
        require_once 'view/clientes/clientes.php';
       require_once 'view/footerx.php';
    }
   
  
    // Si no se encontró un usuario, redirigir a la página de inicio de sesión fallido
   
    }


?>