<?php
define("KEY", "sicloud");
define("COD", "AES-128-ECB");

class Session{
   public $obj;

   public function inicioSesion(){
      if(!isset($_SESSION['usuario']) ){
         session_start();
      }
   }

   public function cerrarSesion(){
      $_SESSION['message']= "Cerro sesion"; $_SESSION['color'] = "primary";
      session_unset();
      session_destroy();
      echo '<script>alert("cerro sesion")</script>';
   }

   public function verificarAcceso(){
      //ROL
      //Administrador 
      if($_SESSION['usuario']['estado'] == 1){
         switch ($_SESSION['usuario']['ID_rol_n']) {
            case 1:
               header('location: ../vista/rol/admin/iniAdmin.php');
               $_SESSION['message'] = ' Bienvenido: Administradors';
            break;
            case 2:
               header("location: ../vista/rol/bodega/iniBodega.php");
               $_SESSION['message'] = ' Bienvenido: Inventario';
            break;
            case 3:
               echo '<h1> Esta en el caso 3 de session </h1>';
               header("location: ../vista/rol/supervisor/iniSupervisor.php");
               $_SESSION['message'] = ' Bienvenido: Supervisor';
              
            break;
            case 4:
               header("location: ../vista/rol/comercial/iniComercial.php");
               $_SESSION['message'] = ' Bienvenido: Inventario';
            break;
            case 5:
               header("location: ../vista/rol/proveedor/iniProveedor.php");
               $_SESSION['message'] = " Bienvenido: Proveedor ";
            break;
            case 6:
            // include_once 'clases/class.usuario.php';
            //  $res = Usuario::verPuntosYusuario( $_SESSION['usuario']['ID_us']);
            // $datos =$res->fetch_assoc();
            // $_SESSION['usuario'] = $datos;
            // $_SESSION['message'] = " Bienvenido: Cliente";
               header("location: ../vista/rol/cliente/iniCliente.php");
            break; 
            default:
               $_SESSION['message'] = "Usuario no registrado";
               header("location: ../vista/index.php");
               echo '<script>alert("Usuario no registrado")</script>';
            break;
         }
      }else{
         header("location: ../vista/cuentaInactiva.php");
      }
   }

   public function validarSesion(){
      if(!isset($_SESSION['usuario'])){
            echo "<script>alert('credenciales incorrectas');</script>"; echo "<script>window.location.replace('../vista/index.php');</script>" ;
      }
      if( $_SESSION['usuario']['estado']===0){
         echo "<script>alert('Su cuenta esta desactivada, no tiene permiso para ingresar a este modulo');</script>"; 
         header("location: ../vista/cuentaInactiva.php");
      }
   }
}

$obj = new Session();
$obj->inicioSesion();
//$obj->validarSesion();

if(isset($_GET['cerrar']) ){

   $obj->cerrarSesion();
   switch ($_GET['cerrar']) {
      case 1:
         header("location: ../vista/index.php");
      break;
      case 2:
         header("location: ../vista/index.php");
      break;
      case 3:
         header("location: ../vista/index.php");
      break;

      default:

      break;
   }
}


?>