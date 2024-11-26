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


  
  

  public function Eliminar($id)
  { 
    // var_dump($id);die;
    try
    {
      $stm = $this->pdo
        ->prepare("UPDATE categoria_producto_pedido SET Categoria_estado = 0 WHERE Categoria_id= ?");

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





  public function Registrar($categorias $data)
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
