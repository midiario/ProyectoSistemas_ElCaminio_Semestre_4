<?php
session_start();
//Se incluye el modelo donde conectará el controlador.
require_once 'model/pago.php';

class PagoController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new pago();
    }

    // Método privado para verificar la sesión
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
        $this->evitarCache();     // Evitar el almacenamiento en caché

        $login = new pago();
        require_once 'view/pago/header.php';
        require_once 'view/pago/pago.php';
        require_once 'view/footerx.php';
    }

    public function Crud_Aux(){
        $this->verificarSesion(); // Verificar si el usuario está autenticado
        $this->evitarCache();     // Evitar el almacenamiento en caché

        $pvd = new pago();

        if(isset($_REQUEST['Pago_id'])){

            $pvd->valor_1 = $_REQUEST['Pago_id'];
            $valor = $_REQUEST['Pago_Meses'];
            $valorID = $_REQUEST['Pago_Cliente_Id'];
            $fecha = new DateTime();

            // Comprobar el valor y sumar la cantidad de meses correspondiente
            switch($valor) {
                case 1:
                    // Sumar 1 mes
                    $fecha->modify('+1 month');
                    break;
                case 2:
                    // Sumar 3 meses
                    $fecha->modify('+3 months');
                    break;
                case 3:
                    // Sumar 6 meses
                    $fecha->modify('+6 months');
                    break;
                default:
                    // Código opcional para manejar casos no esperados
                    throw new Exception("Valor inesperado para Pago_Meses: {$valor}");
            }

            $pvd->valor_2 = $fecha->format('d-m-Y');       
            $this->model->ActualizarPago($pvd);

            $pvd = $this->model->ActualizarClienteEstado($valorID);
        }
        require_once 'view/pago/header.php';      
        require_once 'view/pago/pago.php';
        require_once 'view/footerx.php';
    }

    //Llamado a la vista proveedor-nuevo
    public function LoginError(){
        $login = new pago();

        //Llamado de las vistas.
        require_once 'view/inicio/index.php';
        require_once 'view/inicio/index.php';
    }

    //Registrate
    public function Registrate(){
        $login = new pago();
        //Llamado de las vistas.
        require_once 'view/Registro/nuevo_usuario.php';
    }
}
