<?php

class categorias
{

  private $pdo;

  public $id;
  public $nombre;
  public $descripcion;
  public $estado;

  public function __CONSTRUCT()
  {
    try
    {
      $this->pdo = Database::Conectar();
    }
    catch(Exception $e)
    {
      die($e->getMessage());
    }
  }
  public function MenuLista()
  {
    try
    {

      $result = array();
      $stm = $this->pdo->prepare("SELECT * FROM categoria_producto_pedido");
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e)
    {
      die($e->getMessage());
    }
  }

  public function MenuTipo()
  {
    try
    {
      $result = array();
      $stm = $this->pdo->prepare("SELECT * FROM categoria");
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e)
    {
      die($e->getMessage());
    }
  }

  public function Listar()
  {
    try
    {
      $result = array();

      $stm = $this->pdo->prepare("SELECT 
                                    Categoria_id,
                                    Categoria_nombre,
                                    Categoria_descripcion,
                                    Categoria_estado,
                                    CASE 
                                      WHEN Categoria_estado = 1 THEN 'ACTIVO'
                                      WHEN Categoria_estado <> 1 THEN 'INACTIVO'
                                    END estado
                                  FROM categoria
                                  WHERE Categoria_estado <> 0
                                  ORDER BY Categoria_id DESC");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
      die($e->getMessage());
    }
  }
  public function ListarEntrenamiento()
  {
    try
    {
      $result = array();

      $stm = $this->pdo->prepare("SELECT * FROM pesos");
      $stm->execute();

      return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
      die($e->getMessage());
    }
  }
  

  public function Obtener($id)
  {
    try
    {
      $stm = $this->pdo->prepare("SELECT 
                                    Categoria_id,
                                    Categoria_nombre,
                                    Categoria_descripcion,
                                    Categoria_estado,
                                    CASE 
                                      WHEN Categoria_estado = 1 THEN 'ACTIVO'
                                      WHEN Categoria_estado <> 1 THEN 'INACTIVO'
                                    END estado
                                  FROM categoria
                                  WHERE Categoria_id = ?");
      $stm->execute(array($id));
      return $stm->fetch(PDO::FETCH_OBJ);
    } catch (Exception $e)
    {
      die($e->getMessage());
    }
  }

  public function Eliminar($id)
  { 
    // var_dump($id);die;
    try
    {
      $stm = $this->pdo
        ->prepare("UPDATE categoria SET Categoria_estado = 0 WHERE Categoria_id= ?");

      $stm->execute(array($id));
      return true;
    } catch (Exception $e)
    {
      return false;
      // die($e->getMessage());
    }
  }

  public function Actualizar($id, $data)
  { 
    try
    {
      $sql = "UPDATE categoria_producto_pedido SET
      nombre_categoria_producto_pedido        = ?,
      detalle_categoria_producto_pedido   = ?, 
      estado        = ?
      WHERE id_categoria_producto_pedido      = ?";

      $this->pdo->prepare($sql)
           ->execute(
            array( 
            $data['nombre'],
            $data['detalle'],
            $data['estado'],
            $id
          )
        );
      return true;
    } catch (Exception $e)
    {
      return false;
      // die($e->getMessage());
    }
  }


  public function Registrar(alternativa $data)
	{
		try
		{
	
		
				$sql = "INSERT INTO recomendacion 
				(Recomendacion_titulo,
				Recomendacion_ubicacion_tour,
				Recomendacion_categoria,
				Recomendacion_costo,
				Recomendacion_descripcion,
				Recomendacion_latlong,
 				Recomendacion_estado)
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				   array(
					          $data->titulo,
                    $data->ubicacion,
                    $data->categoria,
                    $entrada_2,
                    $data->descripcion,
                    $data->latlong,
                    $data->estado

                )
			);
			$_SESSION['ultimoIdInsertado'] = $this->pdo->lastInsertId();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

  public function Registrar($data)
  {
    try
    {
          
          $sql = "INSERT INTO categoria_producto_pedido 
          (nombre_categoria_producto_pedido,
          detalle_categoria_producto_pedido,
          estado)
              VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
            ->execute(
              array(
                      $data->nombre,
                      $data->detalle,
                      $data->estado

                  ));

      return true;
    } catch (Exception $e)
    {
      return false;
      // die($e->getMessage());
    }
  }
}
