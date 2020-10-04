<?php
//session_start();
//session_destroy();
// http://localhost/javier/global/appi.php?apicall=readusuarios
require_once '../controlador/controlador.php';
$db = new ControllerDoc();
//session_destroy();
// se pasan los parametros requeridos a esta funcion
function isTheseParametersAvailable($params){
   $avaible = true;
   $missingparams = '';

   foreach($params as $param){
      if(!isset($_POST[$param]) || strlen($_POST[$param]) <=0 ){
         $avaible = false;
         $missingparams = $missingparams.','.$param;
      }
   }
   // Si faltan parametros
   if(!$avaible){
      $response =[];
      $response['error'] = true;
      $response['message'] = 'Parametros:'.substr($missingparams, 1, strlen($missingparams)).'vacion'; 
      // Error de visualizacion
      echo json_encode($response);
      // detener la ejecucion adicional
      die();
   }
}
   //Una matriz que muestra la respuesta de la api
   $response = [];
   /*
   Si se trata de una llamada api
   que significa que un parameetro get llamado se establece una URL
   y con estos parametros estamos concluyendo que es una llamada api
   */
if(isset($_GET['apicall'])){
   // Aqui van todos los llamados de la api
   switch ($_GET['apicall']) {
      // Opcion crear usuarios
      case 'createusuario':
      // Primero haremos la verificacion de parametros.
      isTheseParametersAvailable(  [ 'ID_us','nom1','nom2', 'ape1', 'ape2','fecha', 'pass', 'foto', 'correo','FK_tipo_doc' ]  );
     // $db = new ControllerDoc();
      $result = $db->createUsuariosController(
         $_POST['ID_us'], 
         $_POST['nom1'],
         $_POST['nom2'],
         $_POST['ape1'],
         $_POST['ape2'],
         $_POST['fecha'],    
         $_POST['pass'],
         $_POST['foto'],
         $_POST['correo'],
         $_POST['FK_tipo_doc']
      );  
      if($result){
         //esto significa que no hay ningun error
         $response['error'] = false;
         //Mensaje que ejecuto correctamente 
         $response['message'] = 'Usuario agregado correctamente';
         $response['contenido'] = $db->readUsuariosController(
            $_POST['ID_us'], 
            $_POST['nom1'],
            $_POST['nom2'],
            $_POST['ape1'],
            $_POST['ape2'],
            $_POST['fecha'],    
            $_POST['pass'] 
         );  
      }else{
         $response['error']   = true;
         $response['message'] = 'ocurrio un error, intenta nuevamente';
      }
      break;
      case 'readusuario';
         //$db = new ControllerDoc();
         $response['error'] = false;
         $response['message'] = 'Solicitud completada correctamente';
         $response['contenido'] = $db->readUsuariosController();
      break;
      case 'elimianarUsuario';
        // $db = new ControllerDoc();
         $bool =   $db->eliminarUsuario($_GET['id'] );
         if( $bool ){
           $response['error'] = false;
           $response['message'] = 'Elimino usuario';
         }else{
           $response['error'] = true;
           $response['message'] = 'No elimino usuario';
         }
      break;        
      case 'actualizarUsuario';
      //   $db = new ControllerDoc();
         $array =
         [  
         $_POST['ID_us'], 
         $_POST['nom1'],
         $_POST['nom2'],
         $_POST['ape1'],
         $_POST['ape2'],
         $_POST['fecha'],    
         $_POST['pass' ],
         $_POST['foto' ],    
         $_POST['correo'],
         $_POST['FK_tipo_doc'], 
         ];
         $bool =   $db->actualizarDatosUsuario($_GET['id'], $array );
         if( $bool ){
           $response['error'] = false;
           $response['message'] = 'Actualizo usuario';
         }else{
           $response['error'] = true;
           $response['message'] = 'No elimino usuario';
         }
      break;
      case 'loginusuario':
         isTheseParametersAvailable( ['nDoc', 'pass', 'tDoc'] );
     //    $db = new ControllerDoc();
         $result = $db->loginUsuarioController(
            $_POST['nDoc'],
            $_POST['pass'],
            $_POST['tDoc']);
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = 'credenciales no validas';
         }else{
            $response['error']      = false;
            $response['message']    = 'Bienvenido'; 
            $response['contenido']  = $result;
         }
      break;
      case 'activarCuenta':
       //  $db = new ControllerDoc();
         $result = $db->activarCuenta($_GET['id'] );
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = 'No activo cuenta';
         }else{
            $response['error']      = false;
            $response['message']    = 'Activo cuenta'; 
            $response['contenido']  = $result;
         }
      break;
      case 'desactivarUsuario':
       //  $db = new ControllerDoc();
         $result = $db->desactivarCuenta($_GET['id'] );
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = 'Error, no desactivo cuenta';
            $response['contenido']  = $result;
            
         }else{
            $response['error']      = false;
            $response['message']    = 'Desactivo cuenta'; 
            $response['contenido']  = $result;
         }
      break;
      // insertar producto modulo - CU004-crearproductos.php
      case 'insertProducto':
         $a =[
            $_POST['ID_prod'],
            $_POST['nom_prod'],
            $_POST['val_prod'],
            $_POST['stok_prod'],
            $_POST['estado_prod'],
            $_POST['CF_categoria'],
            $_POST['CF_tipo_medida']
         ];
         $result = $db->insertarProducto( $a );
         if(!$result){
            $response['error']      = true;
            $response['menssage']   = 'no inserto producto';
            $response['contenido']  = $result;
            
         }else{
            $response['error']      = false;
            $response['message']    = 'Inserto producto'; 
            $response['contenido']  = $result;
         }
      break;
      case 'eliminarTelefono':
         $r= $db->eliminarTelefono($_GET['id']);
         if(!$r){
            $response['error']      = true;
            $response['menssage']   = 'No elimino telefono';
            $response['contenido']  = $r;
            
         }else{
            $response['error']      = false;
            $response['message']    = 'Elimino telefono'; 
            $response['contenido']  = $r;
         }
      break;
      case 'EliminarProducto':
        // echo 'estoy en eliminar producto '.$_GET['id']; die('Fin');
         $r= $db->EliminarProducto($_GET['id']);
         if(!$r){
            $response['error']      = true;
            $response['menssage']   = 'No elimino producto';
            $response['contenido']  = $r;
         }else{
            $response['error']      = false;
            $response['message']    = 'Elimino producto'; 
            $response['contenido']  = $r;
         }
      break;
      default:
      $response['error']      = true;
      $response['message']    = 'ingreso a api "no esta en ningun metodo"'; 
      break;
   }
}else{
   // Si no es un api el que se estaq invocando
   // Empujar los valores apropiados en la consulta json
   $response['message'] = 'Llamado invalido del api';
}

echo json_encode($response);
