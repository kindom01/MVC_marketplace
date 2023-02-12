<?php
require_once "models/pedido.php";

class pedidoController{
    public function hacer(){
        require_once "views/pedido/hacer.php";
    }
    
    public function add(){
        Utils::sesionRequire();

        if (isset($_SESSION['carrito']) && $_SESSION['carrito'] != null) {
            # code...

            $stats = Utils::statsCarrito();

            $pedido = new Pedido();
            $pedido->setUsuario_id($_SESSION['usuario']->id); 
            $pedido->setProvincia($_POST['provincia']);
            $pedido->setLocalidad($_POST['localidad']);
            $pedido->setDireccion($_POST['direccion']);
            $pedido->setCoste($stats['total']);
            $result = $pedido->save();
            
            /* linea pedido */
            $result_lineas = $pedido->saveLinea();

            if ($result && $result_lineas) {
                # code...
                $_SESSION['general'] = "Complete";
                unset($_SESSION['carrito']);
            }else {
                # code...
                $_SESSION['general'] = "Failed";
            }

        }else {
            # code...
            header('location:'.base_url."carrito/index");
        }
        header('location:'.base_url."pedido/confirm");
    }

    public function confirm(){
        if (isset($_SESSION['general']) && isset($_SESSION['usuario'])) {
            # code...
            $consulta = new Pedido();
            $consulta->setUsuario_id($_SESSION['usuario']->id);
            $pedido = $consulta->getData_by_usuario();

            $consulta->setId($pedido->id);
            $productos = $consulta->getProducts();

            require_once "views/pedido/ver.php";
        }else {
            # code...
            header('location:'.base_url);
        }
    }
    public function lista(){
		Utils::sesionRequire();
        $consulta = new Pedido();
        $consulta->setUsuario_id($_SESSION['usuario']->id);
        $pedidos = $consulta->getPedidos();

        if ($pedidos->num_rows != 0) {
            # code...
            require_once "views/pedido/lista.php";
        }else {
            # code...
            echo "<h1>No hay pedidos que mostrar :(</h1>";
        }
	}

    public function detalles(){
        Utils::sesionRequire();
        if (isset($_GET['pedido_id']) && $_SESSION['usuario']->id == $_GET['usuario_id'] || isset($_SESSION['admin'])) {
            # code...
            $consulta = new Pedido();
            $consulta->setId($_GET['pedido_id']);
            $pedido = $consulta->getPedido();

            $productos = $consulta->getProducts();

            require_once "views/pedido/detalles.php";

            
        }else {
            # code...
            header('location:'.base_url);
        }
    }
    public function gestionar(){
		Utils::isAdmin();
        $consulta = new Pedido();
        $pedidos = $consulta->getAll();

        if ($pedidos->num_rows != 0) {
            # code...
            require_once "views/pedido/lista.php";
        }else {
            # code...
            echo "<h1>No hay pedidos que mostrar :(</h1>";
        }
	}

    public function estado(){
        if (isset($_POST) && isset($_GET['pedido_id'])) {
            # code...
            Utils::isAdmin();

            $estado = $_POST['estado'];

            $consulta = new Pedido();
            $consulta->setId($_GET['pedido_id']);
            $consulta->updateEstado($estado);
        }
        header('location:'.base_url."pedido/gestionar");
    }
}