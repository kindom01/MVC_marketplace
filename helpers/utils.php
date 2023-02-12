<?php
    class Utils{

        public static function deleteSession($nombre){
            if(isset($_SESSION[$nombre])){
                
                $_SESSION[$nombre] = null;
                unset($_SESSION[$nombre]);
       
            }
            return $nombre;
        }

        public static function isAdmin(){
            if (!isset($_SESSION['admin']) || $_SESSION['usuario']->rol != 'admin'){
                # code...
                header("Location:".base_url);
            }else{
                return true;
            }
        }

        public static function sesionON(){
            if (isset($_SESSION['usuario'])){
                # code...
                header("Location:".base_url);
            }else{
                return true;
            }
        }
        public static function sesionRequire(){
            if (!isset($_SESSION['usuario'])){
                # code...
                header("Location:".base_url);
            }else{
                return true;
            }
        }

        public static function showCategorias(){
            require_once "models/categoria.php";

            $categoria = new Categoria();
            $categorias = $categoria->getAll();
            
            return $categorias;
        }

        public static function statsCarrito(){
            $stats = array(
                'count' => 0,
                "total" => 0
            );
            
            if (isset($_SESSION['carrito'])) {
                # code...
                foreach($_SESSION['carrito'] as $indice => $elemento){
                    if ($elemento['unidades'] != null && $elemento['precio'] != null) {
                        # code...
                        $stats['count'] += $elemento['unidades'];
                        $stats['total'] += $elemento['precio']*$elemento['unidades'];
                    }
                }
            }

            return $stats;
        }
    }