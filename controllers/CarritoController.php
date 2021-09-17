<?php

require_once 'models/producto.php';

class carritoController {

    public function index() {

        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
        }

        require_once 'views/carrito/index.php';
    }

    public function add() {
        //RECIBIR QUE PRODUCTO SE VA A AGREGAR

        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location:' . base_url);
        }


        //SI VAS A AGREGAR OTRO PRODUCTO AL CARRITO
        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();
            $stock = $producto->stock;
            $newStock = $stock - 1;
            Utils::updateStock($newStock, $producto->id);

            //RECORRE TODO EL CARRITO 

            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades'] ++;
                    $counter++;
                }
            }
        }

        //SI ES LA PRIMERA VEZ QUE VAS A GUARDAR ALGO O ES UN ARTICULO QUE NO HAS AÑADIDO 
        if (!isset($counter) || $counter == 0) {
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();


            //AÑADIR AL CARRITO
            if (is_object($producto)) {
                //MI SESION CARRITO VA A SER UN ARRAY PORQUE VOY A AGREGAR VARIOS PRODUCTOS
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );

                $stock = $producto->stock;
                $newStock = $stock - 1;
                Utils::updateStock($newStock, $producto->id);
            }
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function delete() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function up() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades'] ++;
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function down() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades'] --;

            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location:" . base_url . "carrito/index");
    }

    //vaciar todo el carrito 
    public function delete_all() {
        unset($_SESSION['carrito']);
        header("Location:" . base_url . "carrito/index");
    }

}
