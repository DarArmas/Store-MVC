<?php

//ESTE EL MODELO DE PEDIDO
class Pedido {

    //LOS ATRIBUTOS SON LOS CAMPOS DE LA TABLA USUARIOS
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getUsuario_id() {
        return $this->usuario;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario = $usuario_id;
    }

    function getId() {
        return $this->id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad) {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    public function getAll() {
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
        return $productos;
    }

    //PARA QUE ME SALGA LA INFO EN LOS CAMPOS DEL FORMULARIO CUANDO VOY A EDITAR UN PRODUCTO
    public function getOne() {
        $producto = $this->db->query("SELECT * FROM pedidos WHERE id={$this->getId()};");

        return $producto->fetch_object();
    }

    //ME SACA EL ULTIMO PEDIDO DE UN USUARIO
    public function getOneByUser() {
        $sql = "SELECT p.id, p.coste FROM pedidos p "
//                  . "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1;";

        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser() {
        $sql = "SELECT * FROM pedidos p "
                . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC;";

        $pedido = $this->db->query($sql);
        return $pedido;
    }

    //SACAR TODOS LOS productos QUE TENGAN EL MISMO ID DE PEDIDO QUE LE VOY A PASAR
    public function getProductosByPedido($id) {


        //OBTENER LOS PRODCUTOS Y SU CANTIDAD
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                . "WHERE lp.pedido_id={$id}";

        $productos = $this->db->query($sql);
        //AHORA SI PASAME TODO EL RESULT SET
        return $productos;
    }

    public function save() {

        $sql = "INSERT INTO pedidos VALUES(NULL,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirmed',CURDATE(), CURTIME());";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    //SAVE LINEA ES LA RELACION ENTRE EL PEDIDO Y LOS PRODUCTOS ES DECIR, EL id_pedido, id_producto, cantidad_producto
    //RECUERDA QUE UN PEDIDO TIENE MAS DE UN PRODUCTO DE UN CIERTO TIPO

    public function save_linea() {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;


        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id},{$producto->id},{$elemento['unidades']});";

            $save = $this->db->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql .= "WHERE id={$this->getId()};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

}
