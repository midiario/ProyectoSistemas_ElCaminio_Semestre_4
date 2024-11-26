<?php
session_start();


require_once 'model/productos.php';

class CategoriasController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new categorias();
    }

        // Método privado para verificar la sesión
    private function verificarSesion(){

       // $login = $this->model->Login($_REQUEST['usuario'],$_REQUEST['Contrasena']);
            // Verificar si el usuario está autenticado
       if (!isset($_SESSION['session_usuario']) || empty($_SESSION['session_usuario'])) {
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

    //Llamado plantilla productos
    public function Index(){
        $pvd = new categorias();
       $this->verificarSesion(); // Verificar si el usuario está autenticado
       $this->evitarCache();     // Evitar el almacenamiento en caché

       require_once 'view/pago/header.php';
       require_once 'view/productos/productos.php';
       require_once 'view/footerx.php';
    } 
    public function NuevoEntrenamiento(){
        $pvd = new categorias();

        require_once 'view/pago/header.php';
        require_once 'view/productos/productos-entrenamiento.php';
        require_once 'view/footerx.php';
    }

    public function Entrenar(){
        $pvd = new categorias();

        require_once 'view/pago/header.php';
        require_once 'view/productos/entrenar.php';
        require_once 'view/footerx.php';
    }


    
    public function Crud(){
        $pvd = new productos();

        // Comprobar si `Recomendacion_id` está en la solicitud
    if (isset($_REQUEST['Recomendacion_id'])) {
        // Llamar al método ObtenerX para obtener los datos generales
        $datosGenerales = $this->model->ObtenerX($_REQUEST['Recomendacion_id']);
        
        // Llamar al método Obtener para obtener las imágenes y otros datos adicionales
        $datosImagenes = $this->model->ObtenerImg($_REQUEST['Recomendacion_id']);
        
        // Combinar los datos generales y las imágenes en un solo objeto
        $pvd = (object) array_merge((array) $datosGenerales, (array) $datosImagenes);
    }
        require_once 'view/pago/header.php';      
        require_once 'view/productos/editar.php';
        require_once 'view/footerx.php';
    }
    public function Crud_Brain(){
        $pvd = new productos();

        if(isset($_REQUEST['Recomendacion_id'])){
            $pvd = $this->model->ObtenerX($_REQUEST['Recomendacion_id']);
        }
        require_once 'view/pago/header.php';     
        require_once 'view/productos/productos_brain.php';
        require_once 'view/footerx.php';
    }

    public function Crud_Aux(){
        $pvd = new productos();

        if(isset($_REQUEST['Neurona_Id'])){
            $pvd = $this->model->Obtener($_REQUEST['Neurona_Id']);
        }
        require_once 'view/pago/header.php';   
        require_once 'view/productos/productos-editar-entrenamiento.php';
        require_once 'view/footerx.php';
    }

    public function NuevoIN(){
        $pvd = new productos();
        $alert = '<div class="alert alert-primary" role="alert">
                         Registrado
                    </div>';
                    require_once 'view/pago/header.php';
        require_once 'view/productos/nuevo.php';
        require_once 'view/footerx.php';
    }

    public function Nuevo(){
        $pvd = new productos();
      
        require_once 'view/pago/header.php';
        require_once 'view/productos/nuevo.php';
        require_once 'view/footerx.php';
    }


    public function EditarImagen1(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $response = ["status" => "error", "message" => "Error desconocido."];
        try {
            $pvd_img = new productos();
    
            $archivo1 = $_FILES['imgX'];
            $pvd_img->valor_id = $_REQUEST['id_recomendacion'];
    
            // Verifica si se subió correctamente el archivo
            if ($archivo1['error'] === UPLOAD_ERR_OK) {
                // Accede a la información del archivo
                if (isset($_SESSION['ultimoIdInsertado'])) {
                    $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
                } else {
                    $ultimoIdInsertado = $pvd_img->valor_id;
                }
                $nombreOriginal = pathinfo($archivo1['name'], PATHINFO_FILENAME);
                $extensionArchivo = pathinfo($archivo1['name'], PATHINFO_EXTENSION);
                $rutaTemporal = $archivo1['tmp_name'];
                // Genera un nuevo nombre de archivo único usando la fecha y hora
                $nuevoNombreArchivo = $ultimoIdInsertado . '_01_' .  time() . '.' . $extensionArchivo;
                // Mueve el archivo a la ubicación deseada
                $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $nuevaRuta)) {
                    throw new Exception("Error al mover el archivo a la ruta destino.");
                }
                // Asigna la ruta del archivo a tu objeto o modelo
                $nuevaRuta = "img/" . $nuevoNombreArchivo;
                $pvd_img->valor_1 = $nuevaRuta;
            } else {
                // Manejar errores de carga de archivos
                throw new Exception("Error al subir el archivo.");
            }
    
            $this->model->Registrar_img1($pvd_img);
    
            $response = ["status" => "success", "message" => ""];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Error al registrar: " . $e->getMessage()];
        }
        echo json_encode($response);
    }

    public function EditarImagen2(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $response = ["status" => "error", "message" => "Error desconocido."];
        try {
            $pvd_img = new productos();
    
            $archivo1 = $_FILES['imgX'];
            $pvd_img->valor_id = $_REQUEST['id_recomendacion'];
    
            // Verifica si se subió correctamente el archivo
            if ($archivo1['error'] === UPLOAD_ERR_OK) {
                // Accede a la información del archivo
                if (isset($_SESSION['ultimoIdInsertado'])) {
                    $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
                } else {
                    $ultimoIdInsertado = $pvd_img->valor_id;
                }
                $nombreOriginal = pathinfo($archivo1['name'], PATHINFO_FILENAME);
                $extensionArchivo = pathinfo($archivo1['name'], PATHINFO_EXTENSION);
                $rutaTemporal = $archivo1['tmp_name'];
                // Genera un nuevo nombre de archivo único usando la fecha y hora
                $nuevoNombreArchivo = $ultimoIdInsertado . '_02_' .  time() . '.' . $extensionArchivo;
                // Mueve el archivo a la ubicación deseada
                $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $nuevaRuta)) {
                    throw new Exception("Error al mover el archivo a la ruta destino.");
                }
                // Asigna la ruta del archivo a tu objeto o modelo
                $nuevaRuta = "img/" . $nuevoNombreArchivo;
                $pvd_img->valor_1 = $nuevaRuta;
            } else {
                // Manejar errores de carga de archivos
                throw new Exception("Error al subir el archivo.");
            }
    
            $this->model->Registrar_img2($pvd_img);
    
            $response = ["status" => "success", "message" => "Registro exitoso."];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Error al registrar: " . $e->getMessage()];
        }
        echo json_encode($response);
    }


    public function EditarImagen3(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $response = ["status" => "error", "message" => "Error desconocido."];
        try {
            $pvd_img = new productos();
    
            $archivo1 = $_FILES['imgX'];
            $pvd_img->valor_id = $_REQUEST['id_recomendacion'];
    
            // Verifica si se subió correctamente el archivo
            if ($archivo1['error'] === UPLOAD_ERR_OK) {
                // Accede a la información del archivo
                if (isset($_SESSION['ultimoIdInsertado'])) {
                    $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
                } else {
                    $ultimoIdInsertado = $pvd_img->valor_id;
                }
                $nombreOriginal = pathinfo($archivo1['name'], PATHINFO_FILENAME);
                $extensionArchivo = pathinfo($archivo1['name'], PATHINFO_EXTENSION);
                $rutaTemporal = $archivo1['tmp_name'];
                // Genera un nuevo nombre de archivo único usando la fecha y hora
                $nuevoNombreArchivo = $ultimoIdInsertado . '_03_' .  time() . '.' . $extensionArchivo;
                // Mueve el archivo a la ubicación deseada
                $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $nuevaRuta)) {
                    throw new Exception("Error al mover el archivo a la ruta destino.");
                }
                // Asigna la ruta del archivo a tu objeto o modelo
                $nuevaRuta = "img/" . $nuevoNombreArchivo;
                $pvd_img->valor_1 = $nuevaRuta;
            } else {
                // Manejar errores de carga de archivos
                throw new Exception("Error al subir el archivo.");
            }
    
            $this->model->Registrar_img3($pvd_img);
    
            $response = ["status" => "success", "message" => "Registro exitoso."];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Error al registrar: " . $e->getMessage()];
        }
        echo json_encode($response);
    }
    public function EditarImagen4(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $response = ["status" => "error", "message" => "Error desconocido."];
        try {
            $pvd_img = new productos();
    
            $archivo1 = $_FILES['imgX'];
            $pvd_img->valor_id = $_REQUEST['id_recomendacion'];
    
            // Verifica si se subió correctamente el archivo
            if ($archivo1['error'] === UPLOAD_ERR_OK) {
                // Accede a la información del archivo
                if (isset($_SESSION['ultimoIdInsertado'])) {
                    $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
                } else {
                    $ultimoIdInsertado = $pvd_img->valor_id;
                }
                $nombreOriginal = pathinfo($archivo1['name'], PATHINFO_FILENAME);
                $extensionArchivo = pathinfo($archivo1['name'], PATHINFO_EXTENSION);
                $rutaTemporal = $archivo1['tmp_name'];
                // Genera un nuevo nombre de archivo único usando la fecha y hora
                $nuevoNombreArchivo = $ultimoIdInsertado . '_04_' .  time() . '.' . $extensionArchivo;
                // Mueve el archivo a la ubicación deseada
                $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $nuevaRuta)) {
                    throw new Exception("Error al mover el archivo a la ruta destino.");
                }
                // Asigna la ruta del archivo a tu objeto o modelo
                $nuevaRuta = "img/" . $nuevoNombreArchivo;
                $pvd_img->valor_1 = $nuevaRuta;
            } else {
                // Manejar errores de carga de archivos
                throw new Exception("Error al subir el archivo.");
            }
    
            $this->model->Registrar_img4($pvd_img);
    
            $response = ["status" => "success", "message" => "Registro exitoso."];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Error al registrar: " . $e->getMessage()];
        }
        echo json_encode($response);
    }
    public function EditarImagen5(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $response = ["status" => "error", "message" => "Error desconocido."];
        try {
            $pvd_img = new productos();
    
            $archivo1 = $_FILES['imgX'];
            $pvd_img->valor_id = $_REQUEST['id_recomendacion'];
    
            // Verifica si se subió correctamente el archivo
            if ($archivo1['error'] === UPLOAD_ERR_OK) {
                // Accede a la información del archivo
                if (isset($_SESSION['ultimoIdInsertado'])) {
                    $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
                } else {
                    $ultimoIdInsertado = $pvd_img->valor_id;
                }
                $nombreOriginal = pathinfo($archivo1['name'], PATHINFO_FILENAME);
                $extensionArchivo = pathinfo($archivo1['name'], PATHINFO_EXTENSION);
                $rutaTemporal = $archivo1['tmp_name'];
                // Genera un nuevo nombre de archivo único usando la fecha y hora
                $nuevoNombreArchivo = $ultimoIdInsertado . '_05_' .  time() . '.' . $extensionArchivo;
                // Mueve el archivo a la ubicación deseada
                $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $nuevaRuta)) {
                    throw new Exception("Error al mover el archivo a la ruta destino.");
                }
                // Asigna la ruta del archivo a tu objeto o modelo
                $nuevaRuta = "img/" . $nuevoNombreArchivo;
                $pvd_img->valor_1 = $nuevaRuta;
            } else {
                // Manejar errores de carga de archivos
                throw new Exception("Error al subir el archivo.");
            }
    
            $this->model->Registrar_img5($pvd_img);
    
            $response = ["status" => "success", "message" => "Registro exitoso."];
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "Error al registrar: " . $e->getMessage()];
        }
        echo json_encode($response);
    }

    
    public function Guardar(){
        $response = ["status" => "error", "message" => "Error desconocido."];
        try {
        $pvd = new productos();
        $pvd_img = new productos();
   

        //Captura de los datos del formulario (vista).
        $pvd->titulo = $_REQUEST['titulo'];
        $pvd->ubicacion = $_REQUEST['ubicacion'];
        $pvd->categoria = $_REQUEST['categoria'];
        $pvd->costo = $_REQUEST['costo'];
        $pvd->descripcion = $_REQUEST['descripcion'];
        $pvd->estado = $_REQUEST['estado'];
        $pvd->latlong = $_REQUEST['latlong'];
            //Registro al modelo proveedor.
        $this->model->Registrar($pvd);



       
        $archivo1 = $_FILES['img1'];

        // Verifica si se subió correctamente el archivo
        if ($archivo1['error'] === UPLOAD_ERR_OK) {
            // Accede a la información del archivo
            $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
           // $nombreArchivo = $archivo1['name'];
           // $tipoArchivo = $archivo1['type'];
           // $tamanioArchivo = $archivo1['size'];
           // $rutaTemporal = $archivo1['tmp_name'];
            $nombreOriginal = pathinfo($archivo1['name'], PATHINFO_FILENAME);
            $extensionArchivo = pathinfo($archivo1['name'], PATHINFO_EXTENSION);
            $rutaTemporal = $archivo1['tmp_name'];
            // Genera un nuevo nombre de archivo único usando la fecha y hora
            $nuevoNombreArchivo = $ultimoIdInsertado . '_01_' .  time() . '.' . $extensionArchivo;
            // Haz lo que necesites con el archivo, como moverlo a una ubicación deseada
            // Por ejemplo:
            $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
            move_uploaded_file($rutaTemporal, $nuevaRuta);
            // Asigna la ruta del archivo a tu objeto o modelo
            $nuevaRuta = "img/" . $nuevoNombreArchivo;
            $pvd_img->archivo1 = $nuevaRuta;
        } else {
            // Manejar errores de carga de archivos si es necesario
            echo "Error al subir el archivo.";
        }

        $archivo2 = $_FILES['img2'];

        // Verifica si se subió correctamente el archivo
        if ($archivo2['error'] === UPLOAD_ERR_OK) {
            // Accede a la información del archivo
            $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
            $nombreOriginal = pathinfo($archivo2['name'], PATHINFO_FILENAME);
            $extensionArchivo = pathinfo($archivo2['name'], PATHINFO_EXTENSION);
            $rutaTemporal = $archivo2['tmp_name'];
            // Genera un nuevo nombre de archivo único usando la fecha y hora
            $nuevoNombreArchivo = $ultimoIdInsertado . '_02_' .  time() . '.' . $extensionArchivo;
              // Haz lo que necesites con el archivo, como moverlo a una ubicación deseada
            // Por ejemplo:
            $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
            move_uploaded_file($rutaTemporal, $nuevaRuta);
            $nuevaRuta = "img/" . $nuevoNombreArchivo;
            // Asigna la ruta del archivo a tu objeto o modelo
            $pvd_img->archivo2 = $nuevaRuta;
        } else {
            // Manejar errores de carga de archivos si es necesario
            echo "Error al subir el archivo.";
        }

        $archivo3 = $_FILES['img3'];
        // Verifica si se subió correctamente el archivo
        if ($archivo3['error'] === UPLOAD_ERR_OK) {
            // Accede a la información del archivo
            $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
            $nombreOriginal = pathinfo($archivo3['name'], PATHINFO_FILENAME);
            $extensionArchivo = pathinfo($archivo3['name'], PATHINFO_EXTENSION);
            $rutaTemporal = $archivo3['tmp_name'];
            // Genera un nuevo nombre de archivo único usando la fecha y hora
            $nuevoNombreArchivo = $ultimoIdInsertado . '_03_' .  time() . '.' . $extensionArchivo;
              // Haz lo que necesites con el archivo, como moverlo a una ubicación deseada
            // Por ejemplo:
            $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
            move_uploaded_file($rutaTemporal, $nuevaRuta);
            $nuevaRuta = "img/" . $nuevoNombreArchivo;
            // Asigna la ruta del archivo a tu objeto o modelo
            $pvd_img->archivo3 = $nuevaRuta;
        } else {
            // Manejar errores de carga de archivos si es necesario
            echo "Error al subir el archivo.";
        }
        $archivo4 = $_FILES['img4'];
        // Verifica si se subió correctamente el archivo
        if ($archivo4['error'] === UPLOAD_ERR_OK) {
            // Accede a la información del archivo
            $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
            $nombreOriginal = pathinfo($archivo4['name'], PATHINFO_FILENAME);
            $extensionArchivo = pathinfo($archivo4['name'], PATHINFO_EXTENSION);
            $rutaTemporal = $archivo4['tmp_name'];
            // Genera un nuevo nombre de archivo único usando la fecha y hora
            $nuevoNombreArchivo = $ultimoIdInsertado . '_04_' .  time() . '.' . $extensionArchivo;
              // Haz lo que necesites con el archivo, como moverlo a una ubicación deseada
            // Por ejemplo:
            $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
            move_uploaded_file($rutaTemporal, $nuevaRuta);
            $nuevaRuta = "img/" . $nuevoNombreArchivo;
            // Asigna la ruta del archivo a tu objeto o modelo
            $pvd_img->archivo4 = $nuevaRuta;
        } else {
            // Manejar errores de carga de archivos si es necesario
            echo "Error al subir el archivo.";
        }

        $archivo5 = $_FILES['img5'];
        // Verifica si se subió correctamente el archivo
        if ($archivo5['error'] === UPLOAD_ERR_OK) {
            // Accede a la información del archivo
            $ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
            $nombreOriginal = pathinfo($archivo5['name'], PATHINFO_FILENAME);
            $extensionArchivo = pathinfo($archivo5['name'], PATHINFO_EXTENSION);
            $rutaTemporal = $archivo5['tmp_name'];
            // Genera un nuevo nombre de archivo único usando la fecha y hora
            $nuevoNombreArchivo = $ultimoIdInsertado . '_05_' .  time() . '.' . $extensionArchivo;
              // Haz lo que necesites con el archivo, como moverlo a una ubicación deseada
            // Por ejemplo:
            $nuevaRuta = "BETA/img/" . $nuevoNombreArchivo;
            move_uploaded_file($rutaTemporal, $nuevaRuta);
            $nuevaRuta = "img/" . $nuevoNombreArchivo;
            // Asigna la ruta del archivo a tu objeto o modelo
            $pvd_img->archivo5 = $nuevaRuta;
        } else {
            // Manejar errores de carga de archivos si es necesario
            echo "Error al subir el archivo.";
        }

        $this->model->Registrar_img($pvd_img);

        $response = ["status" => "success", "message" => "Registro exitoso."];
    } catch (Exception $e) {
        $response = ["status" => "error", "message" => "Error al registrar: " . $e->getMessage()];
    }

    echo json_encode($response);

      //  header('Location: index.php?c=productos&a=NuevoIN');
        //header() es usado para enviar encabezados HTTP sin formato.
        //"Location:" No solamente envía el encabezado al navegador, sino que
        //también devuelve el código de status (302) REDIRECT al
        //navegador
       
    }
    public function Editar(){
        $pvd = new productos();
        $pvd->valor_id = $_REQUEST['id_recomendacion'];
        $pvd->valor_1 = $_REQUEST['nombre'];
        $pvd->valor_2 = $_REQUEST['ubicacion'];
        $pvd->valor_3 = $_REQUEST['categoria'];
        $pvd->valor_4 = $_REQUEST['costo'];
        $pvd->valor_5 = $_REQUEST['descripcion'];
        $pvd->valor_6 = $_REQUEST['archivo'];
        $pvd->valor_7 = $_REQUEST['estado'];
     

        $this->model->Actualizar($pvd);

        header('Location: index.php?c=productos');
    }



    public function Estado_Activar(){
        $recomendacion_id = $_REQUEST['Recomendacion_id'];
        $this->model->Activar($recomendacion_id);
    
        // Puedes enviar cualquier dato adicional que desees en la respuesta
        $response = array(
            'success' => true,
            'message' => 'Recomendación activada exitosamente',
            'recomendacion_id' => $recomendacion_id
        );
    
        // Devuelve la respuesta como un objeto JSON
        echo json_encode($response);
       
    }
    public function Estado_Desactivar(){
  

   
      $recomendacion_id = $_REQUEST['Recomendacion_id'];
      $this->model->Desactivar($recomendacion_id);
  
      // Puedes enviar cualquier dato adicional que desees en la respuesta
      $response = array(
          'success' => true,
          'message' => 'Recomendación desactivada exitosamente',
          'recomendacion_id' => $recomendacion_id
      );
  
      // Devuelve la respuesta como un objeto JSON
      echo json_encode($response);

    }




}
