<?php
session_start();
require_once 'model/principal.php';

class PrincipalController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new principal();

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

       require_once 'view/pago/header.php';
       require_once 'view/principal/principal.php';
       require_once 'view/footerx.php';
    } 
    public function NuevoEntrenamiento(){
        $pvd = new principal();

        require_once 'view/pago/header.php';
        require_once 'view/principal/principal-entrenamiento.php';
        require_once 'view/footerx.php';
    }



    public function Entrenar(){
        $pvd = new principal();

        require_once 'view/pago/header.php';
        require_once 'view/principal/entrenar.php';
        require_once 'view/footerx.php';
    }

    public function Crud(){
        $pvd = new principal();

        if(isset($_REQUEST['Neurona_Id'])){
            $pvd = $this->model->Obtener($_REQUEST['Neurona_Id']);
        }
        require_once 'view/pago/header.php';      
        require_once 'view/principal/principal-editar.php';
        require_once 'view/footerx.php';
    }

    
    public function Crud_Aux(){
        $pvd = new principal();

        if(isset($_REQUEST['Neurona_Id'])){
            $pvd = $this->model->Obtener($_REQUEST['Neurona_Id']);
        }
        require_once 'view/pago/header.php';      
        require_once 'view/principal/principal-editar-entrenamiento.php';
        require_once 'view/footerx.php';
    }


    public function Nuevo(){
        $pvd = new principal();
        if(isset($_REQUEST['Neurona_Idx'])){
            $pvd = $this->model->MenuTipoRecomendacionGet($_REQUEST['Neurona_Idx']);
        }
        require_once 'view/pago/header.php';
        require_once 'view/principal/principal-nuevo.php';
        require_once 'view/footerx.php';




    }
    public function NuevoPreparado(){
        $pvd = new principal();
        $recomendaciones = [];
        if(isset($_REQUEST['X'])){
            $recomendaciones = $this->model->MenuTipoRecomendacionGet($_REQUEST['X']);
        }
        echo json_encode($recomendaciones);
    }
    public function NuevoPreparadoNombre(){
        header('Content-Type: application/json');
        $pvd = new principal();
        $recomendaciones = [];
     
        if(isset($_REQUEST['X'])){
            $valor = trim($_REQUEST['X']);  
            $recomendaciones = $this->model->MenuTipoRecomendacionNombreGet($valor);
       }
       header('Content-Type: application/json');
        echo json_encode($recomendaciones);
    }


    public function NuevoPreparado2(){
        $pvd = new principal();
        $recomendaciones = [];
        if(isset($_REQUEST['entrada_X'])){
            $recomendaciones = $this->model->MenuTipoRecomendacionGet($_REQUEST['entrada_X']);
        }
        echo json_encode($recomendaciones);
    }
    public function NuevoIN(){
        $pvd = new principal();
        $alert = '<div class="alert alert-primary" role="alert">
            Registrado Exitosamente
        </div>';
        require_once 'view/pago/header.php';
        require_once 'view/principal/principal-nuevo.php';
        require_once 'view/footerx.php';
    }
    public function EntrenarXIN($valor) {
        $pvd = new principal();
    
        $alert = '<div class="alert alert-primary" role="alert">
            Registrado Exitosamente
        </div>';
    
        // Acceder al valor $valor pasado por la URL
      
    
        if (isset($_REQUEST['Neurona_Id'])) {
            $pvd = $this->model->Obtener($valor);
        }
    
        require_once 'view/pago/header.php';      
        require_once 'view/principal/principal-editar-entrenamiento.php';
        require_once 'view/footerx.php';
    }
    
    public function EntrenarXERROR($valor) {
        $pvd = new principal();
    
        $alert = '<div class="alert alert-secondary" role="alert">
            Registro Actualizado Correctamente
        </div>';
    
        // Acceder al valor $valor pasado por la URL
      
    
        if (isset($_REQUEST['Neurona_Id'])) {
            $pvd = $this->model->Obtener($valor);
        }
    
        require_once 'view/pago/header.php';      
        require_once 'view/principal/principal-editar-entrenamiento.php';
        require_once 'view/footerx.php';
    }

    public function Guardar(){

        $pvd = new principal();

        //Captura de los datos del formulario (vista).
     


        
        $pvd->NeuronaRecomendacionId = $_REQUEST['Id_Recomendacion'];
        $pvd->NeuronaNombre = $_REQUEST['NeuronaNombre'];

        $pvd->NeuronaEntrada_1 = $_REQUEST['entrada_1'];
        $pvd->NeuronaEntrada_2 = $_REQUEST['entrada_2'];
        $pvd->NeuronaEntrada_3 = $_REQUEST['entrada_3'];
        $pvd->NeuronaEntrada_4 = $_REQUEST['entrada_4'];
        $pvd->NeuronaEntrada_5 = $_REQUEST['entrada_5'];
     
        //$pvd->Neurona_Id = $_REQUEST['Neurona_Id']; 
      //  $valor_actual =  $pvd->Neurona_Id;
        //Registro al modelo proveedor.
        $this->model->Registrar($pvd);
    
        //header() es usado para enviar encabezados HTTP sin formato.
        //"Location:" No solamente envía el encabezado al navegador, sino que
        //también devuelve el código de status (302) REDIRECT al
        //navegador
        $valor_actual = $_POST['Neurona_Id']; 
        header('Location: index.php?c=principal&a=NuevoIN');
        $valor_actual = $_POST['Neurona_Id']; 


    }

    public function Guardar_nuevo(){

        $pvd = new principal();

        //Captura de los datos del formulario (vista).
     


        
        $pvd->NeuronaRecomendacionId = $_REQUEST['Id_Recomendacion'];
        $pvd->NeuronaNombre = $_REQUEST['NeuronaNombre'];

        $pvd->NeuronaEntrada_1 = $_REQUEST['entrada_1'];
        $pvd->NeuronaEntrada_2 = $_REQUEST['entrada_2'];
        $pvd->NeuronaEntrada_3 = $_REQUEST['entrada_3'];
        $pvd->NeuronaEntrada_4 = $_REQUEST['entrada_4'];
        $pvd->NeuronaEntrada_5 = $_REQUEST['entrada_5'];
     
        //$pvd->Neurona_Id = $_REQUEST['Neurona_Id']; 
      //  $valor_actual =  $pvd->Neurona_Id;
        //Registro al modelo proveedor.
        $this->model->Registrar($pvd);
    
        //header() es usado para enviar encabezados HTTP sin formato.
        //"Location:" No solamente envía el encabezado al navegador, sino que
        //también devuelve el código de status (302) REDIRECT al
        //navegador
        $valor_actual = $_POST['Neurona_Id']; 
        header('Location: index.php?c=principal&a=NuevoIN');
        $valor_actual = $_POST['Neurona_Id']; 


    }


    public function EntrenarX(){
        $pvd = new principal();
        //Captura de los datos del formulario (vista).
        $pvd->Neurona_Id = $_REQUEST['Neurona_Id'];
        $pvd->entrada_1 = "0.95";                 // PERSONA
        $pvd->entrada_2 = $_REQUEST['entrada_2']; // COMPANIA
        $pvd->entrada_3 = $_REQUEST['entrada_3']; // HORARIO
        $pvd->entrada_4 = $_REQUEST['entrada_4']; // EDAD 
        $pvd->entrada_5 = $_REQUEST['entrada_5']; // COST
        $pvd->entrada_6 = $_REQUEST['entrada_6']; // SEXO
        $pvd->entrada_7 = $_REQUEST['entrada_7']; // SEXO
                                                  // SALIDA ESPERADA 1  
        $valorNeuronaId = $pvd->Neurona_Id;
        //Registro al modelo proveedor.
        //header('Location: index.php?c=principal&a=EntrenarXIN&valor=' . $valorNeuronaId);
        // DEBE CREAR NUEVOS DATOS DE SU ENTRENAMIENTO LAS VECES QUE DEBE SER NECESARIA 
        // SERIA BUENO VER CUANTAS VECES SE ENTRENO ESTO
        if ($this->model->RegistrarEntrenamiento($pvd)) {

            $this->model->ActualizarEstadoEntrenado($pvd);
            $this->EntrenarXIN($valorNeuronaId);
        } 
        else 
        {
          //  header('Location: index.php?c=principal&a=EntrenarXERROR&valor=' . $valorNeuronaId);
            $this->EntrenarXERROR($valorNeuronaId);
       
        }

        
    }

    public function ActualizarEstado(){
        $pvd = new principal();
        NuevoPreparado2();
        $pvd->Neurona_Id = $_REQUEST['Neurona_Id'];

        header('Location: index.php?c=principal');
    }
    
    
    

    public function Editar(){
        $pvd = new principal();
        NuevoPreparado2();
        $pvd->Neurona_Id = $_REQUEST['Neurona_Id'];
        $pvd->NeuronaNombre = $_REQUEST['NeuronaNombre'];
        $pvd->NeuronaEntrada_1 = $_REQUEST['entrada_1'];
        $pvd->NeuronaEntrada_2 = $_REQUEST['entrada_2'];
        $pvd->NeuronaEntrada_3 = $_REQUEST['entrada_3'];
        $pvd->NeuronaEntrada_4 = $_REQUEST['entrada_4'];
        $pvd->NeuronaEntrada_5 = $_REQUEST['entrada_5'];
        $pvd->NeuronaEntrada_6 = $_REQUEST['entrada_6'];
        $this->model->Actualizar($pvd);

        header('Location: index.php?c=principal');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['Neurona_Id']);
        header('Location: index.php');
    }
}
