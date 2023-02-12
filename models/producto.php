<?php

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $imagen;
    private $db;

    /* conexion */
    public function __construct(){
        $this->db = Database::connect();
    }

    /* get */

    public function getId(){
		return $this->id;
	}

	public function getCategoria_id(){
		return $this->categoria_id;
	}
	
	public function getNombre(){
		return $this->nombre;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function getPrecio(){
		return $this->precio;
	}

	public function getStock(){
		return $this->stock;
	}
	
	public function getImagen(){
		return $this->imagen;
	}


	/* set */
	public function setId($id){
		$this->id = $id;
	}

	
	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	
	public function setDescripcion($descripcion){
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	public function setPrecio($precio){
		$this->precio = $precio;
	}
	
	public function setImagen($imagen = null){
		$this->imagen = $imagen;
	}
	
	public function setStock($stock){
		$this->stock = $stock;
	}

	public function setCategoria_id($categoria_id){
		$this->categoria_id = $categoria_id;
	}

    /* otras funciones */

	/* configuraciones */
    public function save(){
		$sql="INSERT INTO productos VALUES(NULL,{$this->getCategoria_id()},'{$this->getNombre()}','{$this->getDescripcion()}',{$this->getPrecio()},{$this->getStock()},NULL,CURDATE(),'{$this->getImagen()}')";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			# code...
			$result = true;
		}

        return $result;
	}

	public function delete(){
		$sql = "DELETE FROM productos WHERE id = {$this->getId()}";
        $save = $this->db->query($sql);
	}

	public function update(){
		$sql = "UPDATE productos SET nombre='{$this->getNombre()}',"
		."categoria_id={$this->getCategoria_id()},"
		."descripcion='{$this->getDescripcion()}',"
		."precio={$this->getPrecio()},"
		."stock={$this->getStock()}";

		if ($this->getImagen() != NULL && !empty($this->getImagen())) {
			# code...
			$sql.= ",imagen='{$this->getImagen()}'"; 
		}

		$sql.= " WHERE id = {$this->getId()}";

		$update = $this->db->query($sql);
	}

	/* obtener productos */
	public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");

        return $productos;
    }

	public function getData(){
		$sql = "SELECT * FROM productos WHERE id = {$this->getId()}";
		$consulta = $this->db->query($sql);

		return $consulta;
	}

	public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");

        return $productos;
	}

	public function getAllCategory(){
		$sql = "SELECT p.* , c.nombre AS categoria FROM productos p"
		." INNER JOIN categorias c ON p.categoria_id = c.id"
		." WHERE p.categoria_id = {$this->getCategoria_id()}"
		." ORDER BY id DESC";
		$productos = $this->db->query($sql);

        return $productos;
	}
}