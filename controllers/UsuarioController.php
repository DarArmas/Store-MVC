<?php

//el modelo donde me guarda los datoas que vienen de la base de datos
require_once 'models/usuario.php';

class usuarioController {

    public function index() {
        echo "Controlador Usuarios, Accion Index";
    }

    public function registro() {
        require_once 'views/usuario/registro.php';
    }

    public function save() {
        if (isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;




            if ($nombre && $apellidos && $email && $email && $password) {


                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();

                if ($save) {
                    $_SESSION['register'] = "Complete";
                } else {
                    $_SESSION['register'] = "Failed";
                }
            } else {
                $_SESSION['register'] = "Failed";
            }
        } else {
            $_SESSION['register'] = "Failed";
        }

        //AL FINAL DE TODO REGRESAME AL REGISTRO DE USUARIOS
        header("Location:" . base_url . 'usuario/registro');
    }

    //PRIMERO PASA POR AQUI, LA RUTA A LA QUE MANDA EL FORMULARIO ES controller=user / action=login
    public function login() {
        if (isset($_POST)) {
            //Identificar al usuario
            //Consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();


            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Identificacion fallida!!';
            }
            //Crear una sesion 
        }

        header("Location:" . base_url);
    }

    public function logout() {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header("Location:" . base_url);
    }

}
