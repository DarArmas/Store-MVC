<?php

require_once 'models/pedido.php';

class pedidoController {

    public function hacer() {
        require_once 'views/pedido/hacer.php';
    }

    //PARA CONFIRMAR EL PAGO
    public function add() {
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];


            if ($provincia && $localidad && $direccion) {
                //Guardar datos en bd
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //GUARDAR LINEA PEDIDO
                $save_linea = $pedido->save_linea();

                if ($save && $save_linea) {
                    $_SESSION['pedido'] = "Complete";
                } else {
                    $_SESSION['pedido'] = "Failed";
                }
            } else {
                $_SESSION['pedido'] = "Failed";
            }

            header("Location:" . base_url . 'pedido/confirmado');
        } else {
            //REDIRIGIR
            header("Location:" . base_url);
        }
    }

    public function confirmado() {
        //BUSCAR EL ULTIMO PEDIDO DEL USUARIO IDENTIFICADO

        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();


            //DAME TODOS LOS PRODUCTOS QUE TENGAN id DE MI $pedido
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }
        //YA TENGO MI VARIABLE $pedido LISTA PARA USARSE EN LA VISTA, CON TODA LA INFORMACION DE MI PEDIDO

        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos() {

        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();


        //SACAR LOS PEDIDOS DEL USUARIO
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();


        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle() {
        Utils::isIdentity();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            //SACAR EL PEDIDO
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();


            //SACAR EL ID DEL PEDIDO
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);
            
            
            
            require_once 'views/pedido/detalle.php';
        } else {
            header('Location:' . base_url . 'pedido/mis_pedidos');
        }
    }
    
    
    //AQUI EL ADMINSITRADOR PUEDE VER TODOS LOS PEDIDOS HECHOS POR TODOS LOS CLIENTES
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;
        
        $pedido = new Pedido();
        
        $pedidos = $pedido->getAll();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function estado(){
         Utils::isAdmin();
         
         if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            
             //RECOGER DATOS DEL FORMULARIO
             $id = $_POST['pedido_id'];
             $estado = $_POST['estado'];
             
              //UPDATE DEL PEDIDOS
             $pedido = new Pedido();
             $pedido->setId($id);
             $pedido->setEstado($estado);
             $pedido->edit();
             
             header('Location:'.base_url.'pedido/detalle&id='.$id);
             
         } else {
             header('Location:'.base_url);
         }
        
        
    }

}
