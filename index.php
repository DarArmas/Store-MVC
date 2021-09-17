
<?php 
//controlador frontal: recoger parametros de la url, ver a que controlador pertenece, cargarlo   y llamar
//al metodo que tambien nos llegue por la url
session_start(); //ESTE DE AQUI ME SIRVE PARA MUCHAS COSAS
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

//CONEXION A LA BASE DE DATOS
$db = Database::connect();

function show_error(){
      $error=new errorController();
      $error->index();
}


if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';    
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
 //SI NO RECIBI NINGUN CONTROLADOR NI ACCION ENTONCES QUIERO QUE VAYA AL INDEX AUTOMATICAMENTE Y NO A ERROR
    $nombre_controlador = controller_default;
    
}    
else{
    show_error();
    exit();   
}



if(class_exists($nombre_controlador)){
    
    
    $controlador = new $nombre_controlador();   
   
           
    
            if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){ 
                
                $action = $_GET['action'];
                $controlador->$action();
            }elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
                $action_default = action_default;
                $controlador->$action_default();
                
                
            }else{
                show_error();
            }
    
}else{
show_error();
}

require_once 'views/layout/footer.php';

