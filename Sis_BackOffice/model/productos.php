<?php

class productos
{

	private $pdo;

    public $idProducto;
    public $NeuronaNombre;
    public $NeuronaPesosIdFk;
    public $NeuronaEntrada_1;
	public $NeuronaEntrada_2;
    public $NeuronaEntrada_3;
	public $NeuronaEntrada_4;
	public $NeuronaEntrada_5;
	public $NeuronaEntrada_6;
	public $NeuronaSalida_1;
	public $NeuronaSalida_2;
	public $NeuronaEstado;
	

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
			$stm = $this->pdo->prepare("SELECT * FROM producto_pedido ");
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
			$stm = $this->pdo->prepare("SELECT * FROM categoria_producto_pedido");
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

			$stm = $this->pdo->prepare("SELECT * FROM producto_pedido");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	
	public function Desactivar($data)
	{
		try
		{
			$stm = $this->pdo
        ->prepare("UPDATE recomendacion SET Recomendacion_estado = 0 WHERE recomendacion.Recomendacion_id = ?");

			$stm->execute(array($data));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Activar($data)
	{
		try
		{
			$stm = $this->pdo
        ->prepare("UPDATE recomendacion SET Recomendacion_estado = 1 WHERE recomendacion.Recomendacion_id = ?");

			$stm->execute(array($data));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}



	public function Eliminar($data)
	{
		try
		{
			$stm = $this->pdo
        ->prepare("UPDATE recomendacion SET Recomendacion_estado = 0 WHERE recomendacion.Recomendacion_id = ?");

			$stm->execute(array($data));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try
		{
			$sql = "UPDATE recomendacion SET
			Recomendacion_titulo           = ?,
			Recomendacion_ubicacion_tour   = ?,	
			Recomendacion_categoria        = ?,
			Recomendacion_costo            = ?,
			Recomendacion_descripcion      = ?,	
			Recomendacion_ruta_carga       = ?,
			Recomendacion_estado           = ?
			WHERE Recomendacion_id          = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array( 
                   		$data->valor_1,
						$data->valor_2,
						$data->valor_3,
						$data->valor_4,
						$data->valor_5,
						$data->valor_6,
						$data->valor_7,
						$data->valor_id
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Registrar_img(productos $data)
	{
		try
		{
			$entrada_2 = "0"; // Asigna null si no se proporciona un valor
			
		    	$ultimoIdInsertado = $_SESSION['ultimoIdInsertado'];
			 	$sql = "INSERT INTO recomendacion_img 
				(Recomendacion_FK,
				Recomendacion_img1,
				Recomendacion_img2,
				Recomendacion_img3,
				Recomendacion_img4,
				Recomendacion_img5
 				)
		        VALUES (?, ?, ?, ?, ?, ?)";
				$this->pdo->prepare($sql)
				->execute([
					$ultimoIdInsertado,
					$data->archivo1,
					$data->archivo2,
					$data->archivo3,
					$data->archivo4,
					$data->archivo5

				]);			
			
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Registrar_img1(productos $data)
	{
		try
		{
			$sql = "UPDATE recomendacion_img SET
					Recomendacion_Img1 = ?
					WHERE recomendacion_img.Recomendacion_FK = ?";

			$this->pdo->prepare($sql)
				->execute(
					array( 
						$data->valor_1,	
						$data->valor_id			
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar_img2(productos $data)
	{
		try
		{
			$sql = "UPDATE recomendacion_img SET
					Recomendacion_Img2 = ?
					WHERE recomendacion_img.Recomendacion_FK = ?";

			$this->pdo->prepare($sql)
				->execute(
					array( 
						$data->valor_1,	
						$data->valor_id			
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar_img3(productos $data)
	{
		try
		{
			$sql = "UPDATE recomendacion_img SET
					Recomendacion_Img3 = ?
					WHERE recomendacion_img.Recomendacion_FK = ?";

			$this->pdo->prepare($sql)
				->execute(
					array( 
						$data->valor_1,	
						$data->valor_id			
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Registrar_img4(productos $data)
	{
		try
		{
			$sql = "UPDATE recomendacion_img SET
					Recomendacion_Img4 = ?
					WHERE recomendacion_img.Recomendacion_FK = ?";

			$this->pdo->prepare($sql)
				->execute(
					array( 
						$data->valor_1,	
						$data->valor_id			
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function Registrar_img5(productos $data)
	{
		try
		{
			$sql = "UPDATE recomendacion_img SET
					Recomendacion_Img5 = ?
					WHERE recomendacion_img.Recomendacion_FK = ?";

			$this->pdo->prepare($sql)
				->execute(
					array( 
						$data->valor_1,	
						$data->valor_id			
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar(productos $data)
	{
		try
		{
			if (isset($_POST['costo'])) {
				$entrada_2 = $_POST['costo'];
			} else {
				$entrada_2 = "0"; // Asigna null si no se proporciona un valor
			}
			    $entrada_3 = "current_timestamp()";
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

	public function ObtenerImg($id)
	{
	  try
	  {
		$stm = $this->pdo->prepare("SELECT a.Recomendacion_FK as idFK,	
		a.Recomendacion_Img1 as img1,	
		a.Recomendacion_Img2 as img2,				
		a.Recomendacion_Img3 as img3,					
		a.Recomendacion_Img4 as img4,				
		a.Recomendacion_Img5 as img5,	
		b.Recomendacion_ubicacion_tour as nombre,
		b.Recomendacion_titulo as titulo,
		b.Recomendacion_descripcion as descrip,
		b.Recomendacion_costo as costo,
		b.Recomendacion_latlong as latlong
		FROM recomendacion_img a
		INNER JOIN recomendacion b ON b.Recomendacion_id = a.Recomendacion_FK
		WHERE a.Recomendacion_FK =?");
		$stm->execute(array($id));
		return $stm->fetch(PDO::FETCH_OBJ);
	  } catch (Exception $e)
	  {
		die($e->getMessage());
	  }
	}
}
