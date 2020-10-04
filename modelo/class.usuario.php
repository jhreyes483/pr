<?php
include_once 'class.conexion.php';
include_once '../controlador/controladorsession.php';
class Usuario extends Conexion{
   public $db;
   public function __construct() {
      $this->db = Conexion::conexionPDO();
   } 
  
   public function InsertVista(){
      include_once '../vista/CU002-registrodeUsuario.php';
   }
   static function ningunDato(){
      return new self('', '', '', '', '', '', '', '', '', '');
   }
   // METODO INSERT USUARIO PDO MVC ---------------------------------------------------------------------
   public function InsertUsuario($a){
      $sql = "INSERT INTO usuario (ID_us, nom1, nom2, ape1, ape2, fecha, pass, foto, correo, FK_tipo_doc)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $insertar = $this->db->prepare($sql);
      foreach( $a as $i => $d   ){
      $insertar->bindValue(1, $d[0] );
      $insertar->bindValue(2, $d[1] );
      $insertar->bindValue(3, $d[2] );
      $insertar->bindValue(4, $d[3] );
      $insertar->bindValue(5, $d[4] );
      $insertar->bindValue(6, $d[5] );
      $insertar->bindValue(7, $d[6] );
      $insertar->bindValue(8, $d[7] );
      $insertar->bindValue(9, $d[8] );
      $insertar->bindValue(10, $d[9] );
      }
      $bool =    $insertar->execute();
      if($bool){
         return true;
      }else{
         return $a;
      }
   }
   //-------------------------------------------------------------------------------------------------------
   //METODO SELECT USUARIO PDO MVC----------------(FALTA METODO API)-------------------------------------
   public function readUsuarioModel(){
      $sql = 'SELECT * FROM usuario';
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;  
   }
   //-------------------------------------------------------------------------------------------------------
   //METODO LOGIN USUARIO PDO MVC--------------------------------------------------------------------------
   public function loginUsuarioModel($datosModel){
   $sql ="SELECT U.* , TD.ID_acronimo , 
   RU.estado , 
   R.ID_rol_n , R.nom_rol 
   FROM tipo_doc TD 
   JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
   JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
   JOIN rol R ON FK_rol = R.ID_rol_n  
   WHERE U.ID_us       =  :ID_us  
   AND U.pass          = :pass
   AND TD.ID_acronimo  = :ID_acronimo";
   //AND identificacion = :identificacion";
   $consulta = $this->db->prepare($sql);
   foreach($datosModel as $i =>  $d ){
      $consulta->bindValue( ':ID_us',       $d[0] );
      $consulta->bindValue( ':pass',        $d[1] );
      $consulta->bindValue( ':ID_acronimo', $d[2] );
      echo'<pre>'; print_r($datosModel); echo'</pre>';
   }
   $consulta->execute();
  // $array = $consulta->fetchAll();
      if( $consulta->rowCount() > 0 ){ 
         $USER = $consulta->fetch(PDO::FETCH_ASSOC);
         
         if( !isset( $_SESSION['usuario']) ){
            session_start(); 
            $_SESSION['usuario']  = $USER;
         }   
         echo '<pre>'; print_r( $_SESSION['usuario'] );  echo '</pre>';
      //   echo '<br> hola'.$_SESSION['usuario']['nom1'];
      $_SESSION['message'] = "Login extoso";
      $_SESSION['color'] = "success";
      $objConSes= new Session(); 
      $objConSes->verificarAcceso();

         return  $USER ;
      }else{
         return false;
      }
   }
   //-------------------------------------------------------------------------------------------------------
   //METODO DELETE USUARIO PDO MVC-------------------------(FALTA METODO API)-------------------------------
   public function eliminarUsuario($id_get){       
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0";
      $consulta2 =$this->db->prepare($sql1);
      $rest1 = $consulta2->execute();
      if ($rest1) {
         $sql2 = "DELETE FROM sicloud.usuario WHERE  ID_us = :id ";
         $consulta3=$this->db->prepare($sql2); 
         $consulta3->bindValue(":id", $id_get);
         $rest2=$consulta3->execute();
      }
      if ($rest2) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $consulta4 = $this->db->prepare($sql3);
         $rest3=$consulta4->execute();
      if ($rest3) {
         //header("location: ../vista/TablaUsuario.php");
         echo "<script>alert('Elimino el registro')</script>"; echo "<script>window.location.replace('../vista/TablaUsuario.php')</script>"; }
      else{ echo "<script>alert('Error al eliminar el registro categoria')</script>"; echo "<script>window.location.replace('../vista/TablaUsuario.php')</script>";   } 
        //  if ($rest3) {
        //      $_SESSION['message'] = "Elimino categoria";
        //      $_SESSION['color'] = "danger";
        //  } else {
        //      $_SESSION['message '] = "No se Elimino categoria";
        //      $_SESSION['color'] = "danger";
        //  }
        
      }
   } // fin de metodo eliminar categoria

   //-------------------------------------------------------------------------------------------------------
   //METODO UPDATE USUARIO PDO MVC-------------------------(FALTA METODO API)-------------------------------
   public function actualizarDatosUsuario($id, $a){ 
      ///echo '<pre>'; print_r($a); echo '</pre>';  echo '<pre>'; print_r($id); echo '</pre>';    die();
      $sql = "UPDATE sicloud.usuario SET ID_us = ?, nom1 = ?, nom2 = ?, ape1 = ?, ape2 = ?, fecha = ?, pass = ?, foto = ?, correo = ?, FK_tipo_doc = ?
      WHERE ID_us = ?";
      $insertar = $this->db->prepare($sql);
      $bool = $insertar->execute([$a[0], $a[1], $a[2], $a[3], $a[4], $a[5], $a[6], $a[7], $a[8], $a[9], $id]);       
      $bool =  $insertar->execute();
      if($bool){
         return true;
      }else{
      return false;
         }
      }
      public function verDatoPorId($id){
         $sql = "SELECT * FROM sicloud.usuario WHERE ID_us = $id ";
         $consulta= $this->db->prepare($sql);
         $result = $consulta->execute();
         $result = $consulta->fetchAll();
         return $result;
      }
      public function  selectUsuarioRol($r){
         $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,
            R.nom_rol,  
            R_U.estado
            FROM sicloud.usuario U 
            JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
            JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n
            WHERE R.ID_rol_n  = :id
            ORDER BY u.nom1 asc";
         $consulta= $this->db->prepare($sql);
         $consulta->bindValue(":id", $r);
         $result = $consulta->execute();
         $result = $consulta->fetchAll();
         return $result;
         // consulta para mensaje de rol 
         //if ($result) {   
         //   $sql2 = "SELECT nom_rol FROM rol 
         //      WHERE ID_rol_n = $r 
         //      LIMIT 1";
         //   $datos  = $this->db->query($sql2);
         //   $row = $datos->fetch_assoc();
         //   $rol = $row['nom_rol'];
         //   $_SESSION['message'] = "Filtro por rol:  " . $rol;
         //   $_SESSION['color'] = "info";
         //   return $resultConsulta;
      }

      public function conteoUsuariosActivos(){
         $sql = "SELECT count(*) AS usuariosActivos 
            FROM usuario  U JOIN rol_usuario RU ON RU.FK_us = U.ID_us
            WHERE RU.estado = 1";
         $c= $this->db->prepare($sql);
          $c->execute();
         $r = $c->fetchAll();
         foreach( $r as $d ){
            $con =   $d[0];
         }
         return $con;
      }
      public function conteoUsuariosInactivos(){
         $sql = "SELECT count(*) AS usuariosActivos 
            FROM usuario  U 
            JOIN rol_usuario RU ON RU.FK_us = U.ID_us
            WHERE RU.estado = 0";
         $c= $this->db->prepare($sql);
         $c->execute();
         $r = $c->fetchAll();
        foreach($r as  $d){
           $con= $d[0];
        }
         return $con;
      }

        //busqueda por ID
  public function selectIdUsuario($id){
   $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo, 
      R.nom_rol,  R.nom_rol,
      R_U.estado
      FROM sicloud.usuario U 
      JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
      JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
      WHERE ID_us = :id
       ";
   $c = $this->db->prepare($sql);
   $c->bindValue(":id", $id);
   $c->execute();
   $r = $c->fetchAll();

   return $r;
 } // fin de busqueda por ID

 public function selectUsuariosPendientes($est){
   $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,  
      R.nom_rol, 
      R_U.estado
      FROM sicloud.usuario U 
      JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
      JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
      WHERE R_U.estado =:id ";
   $c = $this->db->prepare($sql);
   $c->bindValue(":id",$est);
   $c->execute();
   $r = $c->fetchAll();
   return $r;
 } //Busqueda por estado pendiente
   //aprobar solicitud
   public function activarCuenta($id){
      $sql = "UPDATE sicloud.rol_usuario 
         SET rol_usuario.estado = 1 
         WHERE rol_usuario.FK_us = ?";
            $c = $this->db->prepare($sql);
            $bool = $c->execute( [$id]  );       
           
    //  $c->bindParam(":id",$id);
      if ($bool) {
         $_SESSION['message'] = "Desactivo cuenta de usuario";
         $_SESSION['color'] = "danger";
         return true;
      } else {
         $_SESSION['message'] = "Error al descativar cuenta";
         $_SESSION['color'] = "danger";
         return false;
      }
      //header("location: ../CU009-controlUsuarios.php ");
   } // fin de desactibar cuenta
 
      ///header("location: ../CU009-controlUsuarios.php ");
     // fin de aprbar solicitud

    public function desactivarCuenta($id){
      $sql = "UPDATE sicloud.rol_usuario 
         SET rol_usuario.estado = 0 
         WHERE rol_usuario.FK_us = ?";
            $c = $this->db->prepare($sql);
            $bool = $c->execute( [$id]  );       
           
    //  $c->bindParam(":id",$id);
      if ($bool) {
         $_SESSION['message'] = "Desactivo cuenta de usuario";
         $_SESSION['color'] = "danger";
         return true;
      } else {
         $_SESSION['message'] = "Error al descativar cuenta";
         $_SESSION['color'] = "danger";
         return false;
      }
      //header("location: ../CU009-controlUsuarios.php ");
   } // fin de desactibar cuenta

   public function verPuntosUs(){
      $sql = "SELECT P.id_puntos, P.puntos, P.fecha , 
         U.nom1 , U.nom2 , U.ape1
         FROM puntos P 
         JOIN usuario U ON  P.FK_us =  U.ID_us
         ORDER BY U.nom1 asc";
   $c = $this->db->prepare($sql);
   $c->execute();
   $r = $c->fetchAll();
   return $r;
   }
   

   // Actualzacion de datos por rol usuario---------------------------------------------------------
  public function insertUpdateUsuarioCliente($idg){
   
   $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
   $consulta1 = $this->db->prepare($sql1);
        $res =  $consulta1->execute();   
   if ($res) {
      $sql2 = "UPDATE sicloud.usuario SET  nom1 = :nom1 ,  nom2 = :nom2 ,ape1 = :ape1 , ape2 = :ape2 , fecha = :fecha   , correo = :correo  WHERE  ID_us = :ID_us ";
      $res1 = $this->db->prepare($sql2);
   }   
   if ($res1) {
      $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
      $res2 = $this->db->prepare($sql3);
   }
   if ($res2) {
      $_SESSION['message'] = $_SESSION['usuario']['nom1'] . ' Actualizo datos';
      $_SESSION['color'] = 'success';
   } else {
      $_SESSION['message'] = 'Error al actualizar datos';
      $_SESSION['color'] = 'danger';
   }
}

   

   






} //Fin Clase Usuario



//$objCont = new Usuario();
//  echo '<pre>';  print_r($objCont->selectUsuarioRol(1)); echo '</pre>';
        
          # Pasar en el mismo orden de los ?


     /* if ($result = true) {
          echo '<script>alert("inserto datos");</script>';
         // $_SESSION['message'] = "Actualizacion exitosa";
         // $_SESSION['color'] = "primary";
      } else {
          echo '<script>alert("no actualizo");</script>';
         // $_SESSION['message'] = "Fallo actualizacion";
         // $_SESSION['color'] = "danger";
      }
      header("location: ../forms/FormEmpresa.php"); */












  /* public function deleteUserModel($id_get){
      $sql = "DELETE FROM sicloud.usuario WHERE ID_us = :id";
      $consulta = $this->db->prepare($sql);
      if($consulta->execute()){
         echo 'Usuario eliminado correctamente';
      } else {
         echo 'El usuario no pudo ser eliminado';
      }
   } */



 /* public function ver($dato, $sale=0, $float= false, $email=''){
      echo '<div style="background-color:#fbb; border:1px solid maroon;  margin:auto 5px; text-align:left;'. ($float? ' float:left;':'').' padding:7px; border-radius:7px; margin-top:10px">';
      if(is_array($dato) || is_object($dato) ){
          echo '<pre><br><b>&raquo;&raquo;&raquo; DEBUG</b><br>'; print_r($dato); echo '</pre>'; 
      }else{
          if(isset($dato)){
              echo '<b>&raquo;&raquo;&raquo; DEBUG &laquo;&laquo;&laquo;</b><br><br>'.nl2br($dato); 	
          }else{
              echo 'LA VARIABLE NO EXISTE';
          }
      }
      echo '</div>';
      if($sale==1) die();
  }
  */

   /* public function VerifyLogin($nombre, $password){
      $this->nombre = $nombre;
      $this->pass = $password;
      $this->db = self::conexionPDO();
      $infousuario = $this->SearchUsuario();
      foreach($infousuario as $usuario){
          if(password_verify($password, $usuario->pass)){
          $_SESSION['nombre'] = $usuario->nombre;
          $_SESSION['pass'] = $usuario->pass;
          $_SESSION['rol'] = $usuario->rol;
          } else {
              echo 'Contraseña Incorrecta';
          }
      }      
   } 

   public function SearchUsuario(){
      $sql = "SELECT * FROM usuario WHERE nombre = '$this->nombre'";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $objconsulta = $consulta->fetchAll(PDO::FETCH_OBJ);
      return $objconsulta;
   }
} */

   
   
   /*
   public function verUsuarios(){
      $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo, 
         R.nom_rol,  R.nom_rol,
         R_U.estado
         FROM sicloud.usuario U 
         JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
         JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n";
      $consulta = $this->db->prepare($sql);
      $consulta->execute();
      $result = $consulta->fetchAll();
      return $result;  
    } // fin de busqueda por ID
/*
   public function insertUpdateUsuario($idg){
      $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
      $consulta1 = $this->db->prepare($sql1);  
      $res = $consulta1->execute();
      if($res){
         $sql2 = "UPDATE sicloud.usuario SET ID_us = '$this->ID_us',nom1 = '$this->nom1' ,  nom2 = '$this->nom2' ,ape1 = '$this->ape1' , ape2 = '$this->ape2' , fecha = '$this->fecha' , pass = '$this->pass' , foto = '$this->foto' , correo = '$this->correo' , FK_tipo_doc = '$this->FK_tipo_doc' WHERE  ID_us = $idg   ";

         $res1 = $this->db->query($sql2);
      }   
      if ($res1) {
         $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
         $res2 = $this->db->query($sql3);
      }
      if ($res2) {
         $_SESSION['message'] = 'Se actualizo cuenta de usuario';
         $_SESSION['color'] = 'primary';
      } else {
         $_SESSION['message'] = 'Error no se cuenta de usuario';
         $_SESSION['color'] = 'danger';
      }

      }



      //Crea la consulta y la almasena en la varible $sql

         

   
  /*
  //---------------------------------------------------------------

  //fecha actual
  public function fechaActual(){
       $sql = "SELECT CURDATE() as fecha";
       $dat =  $this->db->query($sql);
       while ($row = $dat->fetch_assoc()) {
          $fecha = $row['fecha'];
       }
   
       return $fecha;
  }


  // Actualzacion de datos por rol usuario---------------------------------------------------------
  public function insertUpdateUsuarioCliente($idg){
     include_once 'session/sessiones.php';
     $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
     $res =   $this->db->query($sql1);   
     if ($res) {
        $sql2 = "UPDATE sicloud.usuario SET  nom1 = '$this->nom1' ,  nom2 = '$this->nom2' ,ape1 = '$this->ape1' , ape2 = '$this->ape2' , fecha = '$this->fecha'   , correo = '$this->correo'  WHERE  ID_us = '$idg' ";
        $res1 = $this->db->query($sql2);
     }   
     if ($res1) {
        $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
        $res2 = $this->db->query($sql3);
     }
     if ($res2) {
        $_SESSION['message'] = $_SESSION['usuario']['nom1'] . ' Actualizo datos';
        $_SESSION['color'] = 'success';
     } else {
        $_SESSION['message'] = 'Error al actualizar datos';
        $_SESSION['color'] = 'danger';
     }
  } //-------------------------------------------------------------------------------------------------------



  // actualizar datos de usario por administrador------------------------------------------------------------
  public function insertUpdateUsuario($idg){
     $sql1 = "SET FOREIGN_KEY_CHECKS = 0 ";
     $res =   $this->db->query($sql1);   
     if ($res) {
        $sql2 = "UPDATE sicloud.usuario SET ID_us = '$this->ID_us',nom1 = '$this->nom1' ,  nom2 = '$this->nom2' ,ape1 = '$this->ape1' , ape2 = '$this->ape2' , fecha = '$this->fecha' , pass = '$this->pass' , foto = '$this->foto' , correo = '$this->correo' , FK_tipo_doc = '$this->FK_tipo_doc' WHERE  ID_us = $idg   ";
        $res1 = $this->db->query($sql2);
     }   
     if ($res1) {
        $sql3 = "SET FOREIGN_KEY_CHECKS = 1";
        $res2 = $this->db->query($sql3);
     }
     if ($res2) {
        $_SESSION['message'] = 'Se actualizo cuenta de usuario';
        $_SESSION['color'] = 'primary';
     } else {
        $_SESSION['message'] = 'Error no se cuenta de usuario';
        $_SESSION['color'] = 'danger';
     }
  } // fin de update usuario----------------------------------------------------------------------------------


  // insersion a usuario------------------------------------------------------------------------------
  public function insertUsuario(){
    //Crea la consulta y la almasena en la varible $sql
    $sql = "INSERT INTO sicloud.usuario (ID_us,nom1,nom2,ape1,ape2,fecha,pass,foto,correo,FK_tipo_doc)
        VALUES('$this->ID_us ','$this->nom1','$this->nom2','$this->ape1','$this->ape2',' $this->fecha ','$this->pass','$this->foto','$this->correo','$this->FK_tipo_doc')";
    $this->db->query($sql);
 

  } //fin de la funcion insert------------------------------------------------------------------------


  // Muestra los datos en la tabla usuario
  public function selectUsuario(){
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.fecha, U.pass, U.foto, U.correo, R_U.estado 
        FROM sicloud.usuario U 
        JOIN  rol_usuario R_U ON R_U.FK_us = ID_us 
        ORDER BY R_U.estado desc ";
    $result = $this->db->query($sql);
    return $result;
  } // fin de muestra los datos de la tabla usuario



  // Incio de select usuario
  static function selectUsuarios($id){
    include_once 'class.conexion.php';
    $c = new Conexion();
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2,  U.pass, U.foto, U.correo,  U.fecha, 
       R.nom_rol, R_U.estado, R.ID_rol_n
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE ID_us = $id ";
    $result = $c->query($sql);
    return $result;
  } // Fin de select usuario

  //ver usuario por un registro id
  static function verUsarioId($idg){
    include_once 'class.conexion.php';
    $db_usuario = new Conexion();
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, R.nom_rol, U.pass, U.foto, U.correo, 
       R_U.estado
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE ID_us = '$idg' ";
    $result = $db_usuario->query($sql);
    return $result;
  } // fin de busqueda por ID






  public function verUsuarios(){
    $sql = "SELECT distinct U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo, 
       R.nom_rol,  R.nom_rol,
       R_U.estado
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n";
    $result = $this->db->query($sql);
    return $result;
  } // fin de busqueda por ID


  //Busqueda por estado pendiente
  public function selectUsuariosPendientes($est){
    $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,  
       R.nom_rol, 
       R_U.estado
       FROM sicloud.usuario U 
       JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
       JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n 
       WHERE R_U.estado = '$est' ";
    $result = $this->db->query($sql);
    return $result;
  } //Busqueda por estado pendiente


  //aprobar solicitud
  public function activarCuenta($id){
    $sql = " UPDATE sicloud.rol_usuario 
       SET rol_usuario.estado = 1 
       WHERE rol_usuario.FK_us = $id ";
    $insert = $this->db->query($sql);
    // if($insert){ echo "<script>alert('Se desactivo cuenta');</script>";   echo "<script>window.location.replace('../CU009-controlUsuarios.php');</script>"; }else{ echo "<script>alert(no se ha activado');</script>"; echo "<script>window.location.remplace('../CU009-controlUsuarios.php');</script>"; } 
    if ($insert) {
      $_SESSION['message'] = "Activo cuenta de usuario";
      $_SESSION['color'] = "success";
    } else {
      $_SESSION['message'] = "Error al activar cuenta";
      $_SESSION['color'] = "success";
    }
    header("location: ../CU009-controlUsuarios.php ");
  } // fin de aprbar solicitud

  //desactivar cuenta
  public function desactivarCuenta($id){
     $sql = " UPDATE sicloud.rol_usuario 
        SET rol_usuario.estado = 0 
        WHERE rol_usuario.FK_us = $id ";
     $conexion = $this->db->query($sql);
     if ($conexion) {
        $_SESSION['message'] = "Desactivo cuenta de usuario";
        $_SESSION['color'] = "danger";
     } else {
        $_SESSION['message'] = "Error al descativar cuenta";
        $_SESSION['color'] = "danger";
     }
     header("location: ../CU009-controlUsuarios.php ");
  } // fin de desactibar cuenta


  //Compara contraseña tabla usuario--------------------------------------------------------------------------
  public function DocPass($ID_us, $pass, $doc){
     $sql = " SELECT U.* , TD.ID_acronimo , 
        RU.estado , 
        R.ID_rol_n , R.nom_rol 
        FROM tipo_doc TD 
        JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
        JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
        JOIN rol R ON FK_rol = R.ID_rol_n  
        WHERE U.ID_us =  '$ID_us' 
        AND U.pass = '$pass' 
        AND TD.ID_acronimo = '$doc' ";
     $result = $this->db->query($sql);
     return $result;
  } // fin de comprobar contraseña----------------------------------------------------------------------------------


  //---------------------------------------------------------------------------------------------------------------
  //Cambio de contraseña
  public function cambioPass($id,  $contraseñaNueva){
     $sql = "UPDATE usuario 
        SET pass = '$contraseñaNueva' 
        WHERE ID_us = '$id'";
     // echo $sql;
     $r = $this->db->query($sql);
     if ($r) {
        $_SESSION['message'] = "Cambio contraseña";
        $_SESSION['color'] = "success";
     } else {
        $_SESSION['message'] = "Error al cambiar contraseña";
        $_SESSION['color'] = "danger";
     }
    //-------------------------------------------------------------------------
  }


  public function validarPass($id, $pass){
    $sql = "SELECT * FROM usuario 
       WHERE ID_us = '$id' 
       AND pass = '$pass'";
    $i = $this->db->query($sql);
    return $i;
  }


  // insertar foto
  public function inserTfoto($destino, $id){
     $sql = "UPDATE  usuario 
        SET foto = ('$destino')
        WHERE ID_us = '$id'";
     $e = $this->db->query($sql);
     ($e) ??  header("location: ../CU002-registrodeUsuario.php ");

  }


  // filtro por rol
  public function  selectUsuarioRol($r){
     $sql = "SELECT U.FK_tipo_doc, U.ID_us, U.nom1, U.nom2, U.ape1, U.ape2, U.pass, U.foto, U.correo,
        R.nom_rol,  
        R_U.estado
        FROM sicloud.usuario U 
        JOIN  rol_usuario R_U ON R_U.FK_us = U.ID_us
        JOIN sicloud.rol  R ON R_U.FK_rol = R.ID_rol_n
        WHERE R.ID_rol_n  = '$r'
        ORDER BY u.nom1 asc";
     $resultConsulta = $this->db->query($sql);
     // consulta para mensaje de rol 
     if ($resultConsulta) {   
        $sql2 = "SELECT nom_rol FROM rol 
           WHERE ID_rol_n = $r 
           LIMIT 1";
        $datos  = $this->db->query($sql2);
        $row = $datos->fetch_assoc();
        $rol = $row['nom_rol'];
        $_SESSION['message'] = "Filtro por rol:  " . $rol;
        $_SESSION['color'] = "info";
        return $resultConsulta;
     }
  } // fin de metodo select usaurio



  // ver puntos usuario
  static function verPuntosUs(){
     include_once 'class.conexion.php';
     $c = new Conexion;
     $sql = "SELECT P.id_puntos, P.puntos, P.fecha , 
        U.nom1 , U.nom2 , U.ape1
        FROM puntos P 
        JOIN usuario U ON  P.FK_us =  U.ID_us
        ORDER BY U.nom1 asc";
     $con = $c->query($sql);   
     return $con;
  }

  static function verPuntosYusuario($id){
     include_once 'class.conexion.php';
     $c = new Conexion;
     $sql = " SELECT U.ID_us  , U.nom1 , U.nom2 , U.ape1 , U.ape2 , U.fecha , U.pass , U.foto , U.correo , 
     TD.nom_doc , 
     RU.estado , 
     R.ID_rol_n , R.nom_rol , 
     P.puntos
        FROM tipo_doc TD 
        JOIN usuario U ON TD.ID_acronimo = U.FK_tipo_doc 
        JOIN rol_usuario RU ON U.ID_us = RU.FK_us 
        JOIN rol R ON FK_rol = R.ID_rol_n 
        JOIN puntos P ON U.ID_us = P.FK_us
        WHERE U.ID_us = '$id'";   
     $con = $c->query($sql);
     return $con;
  }



  public function conteoUsuariosActivos(){
     $sql = "SELECT count(*) AS usuariosActivos 
        FROM usuario  U JOIN rol_usuario RU ON RU.FK_us = U.ID_us
        WHERE RU.estado = 1";
     $datos = $this->db->query($sql);
     while ($row = $datos->fetch_assoc()) {
        $con = $row['usuariosActivos'];
     }
     return $con;
  }


  public function conteoUsuariosInactivos(){
     $sql = "SELECT count(*) AS usuariosActivos 
        FROM usuario  U 
        JOIN rol_usuario RU ON RU.FK_us = U.ID_us
        WHERE RU.estado = 0";
     $datos = $this->db->query($sql);
     while ($row = $datos->fetch_assoc()) {
       $con = $row['usuariosActivos'];
     }
     return $con;
  }


  public function conteoUsuariosTotal(){
     $c = new Conexion;
     $sql = "SELECT count(*) AS usuariosActivos 
        FROM usuario  U 
        JOIN rol_usuario RU ON RU.FK_us = U.ID_us
     ";
     $datos = $this->db->query($sql);
     while ($row = $datos->fetch_assoc()) {
       $con = $row['usuariosActivos'];
       }
     return $con;
  }
}// fin de clase usaurio



*/



//$objMod->insertUsuario( 1030 ,' nom1' ,'nom2','ape1','ape2','10-04-2020','pass','foto','correo','CC'  );

?> 