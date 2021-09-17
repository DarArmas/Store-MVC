<?php

require_once 'models/producto.php';

class productoController {

    public function index() {
        //PARA PODER LLAMAR A LA FUNCION QUE ME VA A DAR UNA LISTA DE PRODUCTOS AL AZAR NECESITO PRIMERO EL OBJETO
        $producto = new Producto();
        $productos = $producto->getRandom(6);


        //renderizar vista
        require_once 'views/producto/destacados.php';
    }

    public function ver() {
        //SELECCIONAR UN PRODUCTO RECIBIENDO UN id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];


            //AGARRA EL ip DESDE HTML, BUSCA EL PRODUCTO Y MANDAME ESE PRODUCTO A LA VARIABLE $pro
            $producto = new Producto();
            $producto->setId($id);


            $product = $producto->getOne();


            require_once 'views/producto/ver.php';
        }
    }

    public function gestion() {
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear() {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
//            $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setCategoria_id($categoria);
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setStock($stock);
                $producto->setPrecio($precio);

                //GUARDAR LA IMAGEN
                if (isset($_FILES['imagen'])) {
                    //$_FILES['imagen']<-- es una variable super global, se llama asi porque asi lo llame desde el formulario
                    $file = $_FILES['imagen'];
                    //$file <--TIENE UN ARREGLO CON TODA LA INFORMACION DEL ARCHIVO
                    $filename = $file['name'];
                    //cada tipo de archivo tiene un MIMETYPE
                    $mimetype = $file['type'];

                    //PRIMERO SE TIENE QUE SUBIR LA IMAGEN EN EL PROYECTO Y LUEGO YA SE PUEDE MANDAR A LA BD
                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                        //LO CHECA EN LA RAIZ DEL PROYECTO

                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true); //DIRECTORIO RECURSIVO: que está adentro de otro
                        }

                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    $save = $producto->save();
                }



                if ($save) {
                    $_SESSION['producto'] = "Complete";
                } else {
                    $_SESSION['producto'] = "Failed";
                }
            } else {
                //SI ALGUNO ME FALTA
                $_SESSION['producto'] = "Failed";
            }
        } else {
            //SI NO ME LLEGO NADA DE POST
            $_SESSION['producto'] = "Failed";
        }
        //REGRESAME A DONDE ESTAN TODOS LOS PRODUCTOS
        header('Location:' . base_url . 'producto/gestion');
    }

    public function editar() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            //AGARRA EL ip DESDE HTML, BUSCA EL PRODUCTO Y MANDAME ESE PRODUCTO A LA VARIABLE $pro
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();


            require_once 'views/producto/crear.php';
        } else {
            header('Location' . base_url . 'producto/gestion');
        }
    }

    public function eliminar() {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['delete'] = 'Completed';
            } else {
                $_SESSION['delete'] = 'Failed';
            }
        } else {
            $_SESSION['delete'] = 'Failed';
        }

        header('Location:' . base_url . 'producto/gestion');
    }

}
