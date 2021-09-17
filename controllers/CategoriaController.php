<?php
//LOS MODELOS SOLO ESTAN CONECTADOS A SUS CONTROLADORES
require_once 'models/categoria.php';
//VOY A USAR UN METODO DE SACAR TODOS LOS PRODUCTOS POR ESO TENGO QUE ENLAZAR SU MODELO DESDE ELL CONTROLADOR DE CATEGORIA
require_once 'models/producto.php';

class categoriaController {

    public function index() {
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }
    
    public function ver(){
        if(isset($_GET['id'])){
            
            //ESTABLECER LA CATEGORIA
            $id= $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne(); //NO HAY PEDO SI TENEMOS DOS ASIGNACIONES CON EL MISMO NOMBRE, ESTA VA A TOMAR EL VALOR ULTIMO
            
            
//CONSEGUIR PRODUCTOS
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
      
            
   
        }
        
        
        require_once 'views/categoria/ver.php';
    }
    

    public function crear() {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save() {
        Utils::isAdmin();
        //GUARDAR LA CATEGORIA EN LA BASE
        
        if (isset($_POST) && isset($_POST['nombre'])) {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        
        //YA AL FINAL PARA VER TODAS LAS CATEGORIAS
        header("Location:" . base_url . "categoria/index");
    }

}
