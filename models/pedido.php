<?php

class pedido{

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $db;

    /* conexion */
    public function __construct(){
        $this->db = Database::connect();
    }
    /* get and set */

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

    public function getUsuario_id(){
		return $this->usuario_id;
	}

	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}

	public function getProvincia(){
		return $this->provincia;
	}

	public function setProvincia($provincia){
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	public function getLocalidad(){
		return $this->localidad;
	}

	public function setLocalidad($localidad){
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	public function getDireccion(){
		return $this->direccion;
	}

	public function setDireccion($direccion){
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	public function getCoste(){
		return $this->coste;
	}

	public function setCoste($coste){
		$this->coste = $coste;
	}



    

    /* otras funciones */

	/* configuraciones */
    public function save(){
		$sql="INSERT INTO pedidos VALUES(NULL,{$this->getUsuario_id()},'{$this->getProvincia()}'"
        .",'{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()}, 'Pendiente'"
        .",CURDATE(),CURTIME())";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			# code...
			$result = true;
		}

        return $result;
	}

	public function saveLinea(){
		$sql = "SELECT LAST_INSERT_ID() as 'pedido';";
		$query = $this->db->query($sql);
		$pedido_id = $query->fetch_object()->pedido;

		$stats = Utils::statsCarrito();
    	foreach($_SESSION['carrito'] as $indice => $elemento){
    		$producto = $elemento['productos'];
			
			$insert = "INSERT INTO lineas_pedidos VALUES(NULL,{$pedido_id},{$producto->id},{$elemento['unidades']})";
			$save = $this->db->query($insert);
			
			/* actualizar stock */
			$cantidad_comprada = $elemento['unidades'];
			
			$consulta_stock = "SELECT stock FROM productos WHERE id = {$producto->id}";
			$sql_stock = $this->db->query($consulta_stock);

			$cantidad_stock = $sql_stock->fetch_object();
			$maximo = $cantidad_stock->stock;

			$total = $maximo - $cantidad_comprada;
			
			$sql_update = "UPDATE productos SET stock = {$total} WHERE id = {$producto->id}";
			$update = $this->db->query($sql_update);

		}

		$result = false;
		if ($save && $update) {
			# code...
			$result = true;
		}

        return $result;

	}

	/* obtener productos */

	public function getData_by_usuario(){
		$sql = "SELECT p.id, p.coste FROM pedidos p"
		." WHERE p.usuario_id = {$this->getUsuario_id()}"
		." ORDER BY id DESC LIMIT 1";
		$consulta = $this->db->query($sql);

		return $consulta->fetch_object();
	}
	
	public function getProducts(){
		$sql = "SELECT pr.*, lp.unidades FROM productos pr"
		." INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id"
		." WHERE lp.pedido_id = {$this->getId()}";
		$consulta = $this->db->query($sql);


		return $consulta;
	}

	public function getPedidos(){
		$sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
		$consulta = $this->db->query($sql);

		return $consulta;
	}
	public function getPedido(){
		$sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";
		$consulta = $this->db->query($sql);

		return $consulta->fetch_object();
	}

	public function getAll(){
		$sql = "SELECT * FROM pedidos ORDER BY id DESC";
		$consulta = $this->db->query($sql);

		return $consulta;
	}

	public function updateEstado($estado){
		$sql = "UPDATE pedidos SET estado = '{$estado}' WHERE id = {$this->getId()}";
		$consulta = $this->db->query($sql);

		return $consulta;
	}
}