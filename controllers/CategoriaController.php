<?php
require_once "models/categoria.php";
require_once "models/producto.php";


class categoriaController{
    /* configuraciones de categorias */
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once "views/categoria/index.php";
    }
    
    public function crear(){
        Utils::isAdmin();
        
        require_once "views/categoria/crear.php";
    }
    
    public function save(){
        Utils::isAdmin();
        
        if (isset($_POST) && isset($_POST['nombre'])) {
            # code...
            $categoria = new Categoria();

            $categoria->setNombre($_POST['nombre']);
            $confirm = $categoria->save();
            
            if ($confirm) {
                # code...
                $_SESSION['general'] = "Complete";
            }else {
                # code...
                $_SESSION['general'] = "Failed";
            }
        }else {
            # code...
            $_SESSION['general'] = "Failed";
        }

        header("Location:".base_url."categoria/index");
    }

    public function delete(){
        Utils::isAdmin();
            # code...
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria->delete();

            header("Location:".base_url."categoria/index");
    }

    /* categorias para publico en general */
    public function ver(){
        if (isset($_GET['id'])) {
            # code...
            $id = $_GET['id'];

            /* conseguir la categoria */
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria_ob = $categoria->getOne();

            /* conseguir productos */
            $producto = new Producto();
            $producto->setCategoria_id($categoria_ob->id);
            $productos = $producto->getAllCategory();

        }

        require_once "views/categoria/ver.php";
    }
}