<?php

class Utils {

    public static function deleteSession($name) {

        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin() {
        if (!isset($_SESSION['admin'])) {
            //SI NO ES ADMIN AMONOS PAL INDEX 
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function isIdentity() {
        if (!isset($_SESSION['identity'])) {
            //SI NO ESTA LOGGEADO AMONOS PAL INDEX 
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias() {
        require_once 'models/categoria.php';

        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function statsCarrito() {

        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {

            $stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status) {
        $value = 'Pendiente';


        if ($status == 'confirmed') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparacion';
        } elseif ($status == 'ready') {
            $value = 'Listo para enviarse';
        } elseif ($status = 'sent') {
            $value = 'Enviado';
        }

        return $value;
    }

    public static function updateStock($stock, $id) {
        $sql = "UPDATE productos SET stock ={$stock} WHERE id = $id;";

        $db = database::connect();

        $update = $db->query($sql);

        $result = false;

        if ($update) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

}
