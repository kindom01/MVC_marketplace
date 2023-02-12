<?php
require_once "models/producto.php";

class carritoController{
    public function index(){

        if (isset($_SESSION['carrito']) && $_SESSION['carrito'] != null) {
            # code...
            $carrito = $_SESSION['carrito'];
            
            require_once "views/carrito/ver.php";
        }else {
            # code...
            echo "<h1>Carrito de compras vacio :(</h1>";
        }
    }

    public function add(){
        if (isset($_GET['id']) && isset($_POST)) {
            # code...
            if ($_POST['cantidad'] != null) {
                # code...
                $cantidad = $_POST['cantidad'];
            }else {
                # code...
                $cantidad = 1;
            }

            $producto_id = $_GET['id'];
            $añadido = true;

            if (isset($_SESSION['carrito'])) {
                # code...
                foreach($_SESSION['carrito'] as $indice => $valor){
                    if ($valor['id_producto'] == $producto_id) {
                        # code...
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $añadido = false;
                    }
                }
            }
            # code...
            $producto = new Producto();
            $producto->setId($producto_id);
            $objeto = $producto->getData();
            $añadir = $objeto->fetch_object();

            if (is_object($añadir) && $añadido) {
                # code...
                $_SESSION['carrito'][] = array(
                    "id_producto" => $añadir->id,
                    "nombre_producto" => $añadir->nombre,
                    "precio" => $añadir->precio,
                    "unidades" => $cantidad,
                    "productos" => $añadir
                );
            }


        }else {
            # code...
            header('Location:'.base_url);
        }

        header('Location:'.base_url.'carrito/index');
    }

    public function remove(){
        if (isset($_GET['id'])) {
            # code...
            $producto_id = $_GET['id'];
            if (isset($_SESSION['carrito'])) {
                # code...
                foreach($_SESSION['carrito'] as $indice => $valor){
                    if ($valor['id_producto'] == $producto_id) {
                        # code...
                        unset($_SESSION['carrito'][$indice]);
                    }
                }
            }else{
                header('Location:'.base_url);
        
            }
        }else{
        
            header('Location:'.base_url);        
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function delete_all(){

        unset($_SESSION['carrito']);
        header('Location:'.base_url.'carrito/index');
    }
}