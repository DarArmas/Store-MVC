<?php
//REPRESENTA A CADA REGISTRO DE LA BASE DE DATOS
//RECUERDA QUE AQUI ES DONDE SACO/MODIFICO/ TRABAJO CON LA BASE DE DATOS

class Categoria{
    //LOS ATRIBUTOS SON LOS CAMPOS DE LA TABLA CATEGORIA
    private $id;
    private $nombre; 
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDb() {
        return $this->db;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDb($db) {
        $this->db = $db;
    }

    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    } 
    
    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()};");
        return $categoria->fetch_object();
    }
    
    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}');"; 
        $save = $this->db->query($sql);
         
        $result=false;
        
        if($save){
            $result= true;
        }
         
        return $result;
    }
    
    
}