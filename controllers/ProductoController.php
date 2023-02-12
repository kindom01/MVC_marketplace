<?php
require_once "models/producto.php";

class productoController{
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        /*cargar vista*/
        require_once "views/producto/destacados.php";
    }
    
    public function gestion(){
        Utils::isAdmin();
        
        $producto = new Producto();
        $productos = $producto->getAll();
        
        /* cargar vista */
        require_once "views/producto/gestion.php";
    }
    
    public function crear(){
        Utils::isAdmin();
        
        
        
        require_once "views/producto/crear.php";
    }
    
    public function save(){        
        Utils::isAdmin();

        if (isset($_POST)) {
            # code...
            $producto = new Producto();
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setPrecio($_POST['precio']);
            $producto->setStock($_POST['stock']);
            $producto->setCategoria_id($_POST['categoria']);

            /* guardar imagen */
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];

            

            if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png") {
                # code...
                if (!is_dir('uploads/images')) {
                    # code...
                    mkdir('uploads/images', 0777, true);
                }

                $producto->setImagen($filename);
                move_uploaded_file($file['tmp_name'],"uploads/images/".$filename);
            }


            $save = $producto->save();

            if ($save) {
                # code...
                $_SESSION['general'] = "Complete";
            }else {
                $_SESSION['general'] = "Failed";
            }
        }else {
            
            $_SESSION['general'] = "Failed";
        }
        
        header("Location:".base_url."producto/gestion");
    }

    public function borrar(){
        Utils::isAdmin();
            # code...
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $producto->delete();

            header("Location:".base_url."producto/gestion");
    }

    public function editar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
        $datos = new Producto();
        $datos->setId($_GET['id']);
        $producto = $datos->getData();

        $pro = $producto->fetch_object();}

        require_once "views/producto/editar.php";
    }

    public function actualizar(){   
        # code...
        $producto = new Producto();

        $producto->setId($_GET['id']);

        $producto->setNombre($_POST['nombre']);
        $producto->setDescripcion($_POST['descripcion']);
        $producto->setPrecio($_POST['precio']);
        $producto->setStock($_POST['stock']);
        $producto->setCategoria_id($_POST['categoria']);

        /* guardar imagen */

        if (isset($_FILES['imagen'])) {
            # code...
            $file = $_FILES['imagen'];
            $filename = $file['name'];
            $mimetype = $file['type'];
    
            
    
            if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png") {
                # code...
                if (!is_dir('uploads/images')) {
                    # code...
                    mkdir('uploads/images', 0777, true);
                }
    
                $producto->setImagen($filename);
                move_uploaded_file($file['tmp_name'],"uploads/images/".$filename);
            }
        }


        $producto->update();
    
    header("Location:".base_url."producto/gestion");

    }

    /* vista del producto */
    public function ver(){
        # code...
        
        if(isset($_GET['id'])){
            $datos = new Producto();
            $datos->setId($_GET['id']);
            $producto = $datos->getData();
    
        }
        require_once "views/producto/ver.php";
    }
}