<?php
require_once "models/usuario.php";

class usuarioController{
    public function index(){
        echo "controlador usuarios, accion index";
    }

    public function registro(){
        Utils::sesionON();
        require_once "views/usuario/registro.php";
    }

    public function save(){
        if (isset($_POST)) {
            # code...
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            if ($nombre && $apellido && $email && $password) {
                # code...
                $usuario = new Usuario();
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellidos($_POST['apellidos']);
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['password']);

                $registro = $usuario->save();

                if ($registro) {
                    # code...
                    $_SESSION['alerta'] = "Complete";
                }else {
                    # code...
                    $_SESSION['alerta'] = "Failed";
                }
            }else{
                # code...
                $_SESSION['alerta'] = "Failed";
            }
        }
        header('Location:'.base_url."usuario/registro");
    }

    public function login(){
        if (isset($_POST)) {
            # code...
            $usuario = new Usuario();
            $email = $_POST['email'];
            $password = $_POST['password'];

            $login = $usuario->login($email, $password);

            if (is_object($login)) {
                # code...
                $_SESSION['alerta'] = "Complete";
                $_SESSION['usuario'] = $login;

                if ($_SESSION['usuario']->rol=='admin') {
                    # code...
                    $_SESSION['admin'] = true;
                }
            }else {
                # code...
                $_SESSION['alerta'] = "Failed";
            }
        }else {
            # code...
            $_SESSION['alerta'] = "Failed";
        }
        header('Location:'.base_url);
    }

    public function logout(){
        if (isset($_SESSION["usuario"])) {
            # code...
            unset($_SESSION['usuario']);
        }
        if (isset($_SESSION["admin"])) {
            # code...
            unset($_SESSION['admin']);
        }
        header('Location:'.base_url);
    }

}