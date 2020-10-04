<?php


function rutApi(){
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controlador.php';
}
function rutConIni(){
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.documento.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.usuario.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.rol.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.categoria.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.medida.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.proveedor.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.producto.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.factura.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.modificacion.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.ciudad.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.empresa.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.error.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.telefono.php';
}

function rutIndex(){
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/plantilla.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/cuerpo/inihtmlN0.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/nav/navgeneralvideo.php';
}


function rutModConexion(){
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/modelo/class.conexion.php';
   include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/controlador/controladorsession.php';
}


if (  !isset($cons)  ){
   $cons = true;
   define('BACKURL','http://localhost/sicloud/back');
   define('FROMURL','http://localhost/sicloud/from');
   }
   
   function rutIniFromIndex(){
      include_once '/plantillas/plantilla.php';
      include_once '/plantillas/cuerpo/inihtmlN1.php';
      include_once '/plantillas/nav/navgeneralvideo.php';
   }


   function rutIniFromIndexRaiz(){
      include_once 'vista/plantillas/plantilla.php';
      include_once 'vista/plantillas/cuerpo/inihtmlN0.php';
      include_once 'vista/plantillas/nav/navgeneralvideo.php';
   }

   function rutIniInactiva(){
      include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/plantilla.php';
      include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/cuerpo/inihtmlN1.php';
      include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/nav/nav/navgeneral.php';
      session_start();
      session_destroy();
   }

   function rutFromIni(){
      include_once 'plantillas/plantilla.php';
      include_once 'plantillas/cuerpo/inihtmlN1.php';
      include_once 'plantillas/nav/navN1.php';
      include_once '../controlador/controladorsession.php';
      include_once '../controlador/controlador.php'; 
   }
   
   function rutFromFin(){ 
      include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/cuerpo/finhtml.php';
   }
   
   function rutFinFooterFrom(){ 
      include_once $_SERVER['DOCUMENT_ROOT'].'/sicloud/vista/plantillas/cuerpo/footerN1.php';
   }


   function rutFromIniN3(){
      include_once '../../plantillas/plantilla.php';
      include_once '../../plantillas/cuerpo/inihtmlN3.php';
      include_once '../../plantillas/nav/navN3.php';
      include_once '../../../controlador/controladorsession.php';
   }

?>