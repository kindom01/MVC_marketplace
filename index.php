<?php

    session_start();

    //importaciones
    
    require_once "config/db.php";
    require_once "config/parameters.php";
    
    require_once "helpers/utils.php";
    require_once "autoload.php";
    require_once "views/layout/header.php";
    require_once "views/layout/side_bar.php";

    
    function show_error(){
        $error = new errorController();
        $error -> index();
    }


    if (isset($_GET['controller'])) {
        # code...
        $nombre_controlador = $_GET['controller']."Controller";
    }elseif (!isset($_GET['controller'])) {
        # code...
        $nombre_controlador = controller_default;

    }else{
        show_error();
    }

    //controlador
    if (class_exists($nombre_controlador)) {
        # code...
        $controlador = new $nombre_controlador();

        if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
            # code...
            $action = $_GET['action'];
            $controlador->$action();
            }elseif (!isset($_GET["action"])) {
                # code...
                $action = action_default;
                $controlador->$action();
            }else{
                show_error();
            }
    }else{
        show_error();
    }

    require_once "views/layout/footer.php";
?>

