<?php
include_once '../modelo/class.producto.php'; 
include_once '../modelo/class.medida.php';
include_once '../modelo/class.producto.php'; 
include_once '../modelo/class.categoria.php';
include_once '../modelo/class.rol.php';
include_once '../modelo/class.usuario.php';
include_once '../modelo/class.rol_usuario.php';
include_once '../modelo/class.login.php';
include_once '../modelo/class.notificacion.php';
include_once '../modelo/class.modificacion.php';
include_once '../modelo/class.empresa.php';

//$us=Usuario::ningunDato();
$objC=Categoria::ningunDatoC();


if (isset($_POST['submit'])) {

    if(isset($_POST['accion']) && $_POST['accion'] == 'insert'){
        $instanciacontrolador = Usuario::ningunDato();
       // $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $instanciacontrolador->InsertUsuario(
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
    }

    if ($_POST['accion'] == 'insertUpdateUsuario') {
        // include_once '../session/sessiones.php';
         echo 'estoy en insert Usuario ';
         $id = $_GET['ID_us'];
         $id_user = $_POST['ID_us'];
         //echo print_r($_POST);
         $usuario = Usuario::ningunDato();

    }

    //update desde rol usuaurio "mismdatos"

    if ($_POST['accion'] == 'insetUpdateUsuarioUsuario') {
        echo "estoy dentro de insersion usuario";
        $id = $_SESSION['usuario']['ID_us'];
        $pass = "";
        $i = "";
        $foto = "";
        $FK_tipo_doc  = "1";
        $nom1 =  $_POST['nom1'];
        $nom2 = $_POST['nom2'];
        $ape1 = $_POST['ape1'];
        $ape2 = $_POST['ape2'];
        $fecha = $_POST['fecha'];
        $correo = $_POST['correo'];
        $us = new Usuario($i, $nom1, $nom2, $ape1, $ape2, $fecha, $pass, $foto,   $correo, $FK_tipo_doc);
        $us->insertUpdateUsuarioCliente($id);
        echo print_r($us);
        header("location: ../vista/misDatos.php");
    }

     //CATEGORIA
    //Update
    if ($_POST['accion'] == 'insertUdateCategoria') {
        // include_once '../session/sessiones.php';
         $categoria = $_POST['categoria'];
         $id = $_GET['id'];
         $categoria = $objC->actualizarDatosCategoria($id);
         print_r($_POST);
     } // fin de insert update categoria
     ///------------------------------------------------------

    

}


       /*  $usuario->actualizarDatosUsuario($id);
     } // fin de actualizar empresa

    /* if(isset($_POST['action']) && $_POST['action'] == 'login'){
        $instanciacontrolador = Usuario::ningunDato();
        $instanciacontrolador->VerifyLogin($_POST['name'], $_POST['pass']);
    
    } */
    
    



    /*


    //------------------------------------------------------------
    // USUARIO
    //Update desde admin
    if ($_POST['accion'] == 'insetUpdateUsuario') {



        $f =  $us->fechaActual();
        $idg = $_GET['id'];
        $ID_us = $_POST['ID_us'];
        $nom1 = $_POST['nom1'];
        $nom2 = $_POST['nom2'];
        $ape1 = $_POST['ape1'];
        $ape2 = $_POST['ape2'];
        $fecha = $_POST['fecha'];
        $pass = $_POST['pass'];
        $foto = $_POST['foto'];
        $correo = $_POST['correo'];
        $FK_tipo_doc = $_POST['FK_tipo_doc'];
        $ID_us_session = $_SESSION['usuario']['ID_us'];

        // captura de rol_usuario
        $FK_rol = $_POST['FK_rol'];
        // $FK_us
        // $FK_tipo_doc




        $fecha_as = $f;
        $estado = "0";

        ///METODO INSERSION DE USUARIO UPDATE
        $usuario = new Usuario($ID_us,  $nom1, $nom2, $ape1, $ape2, $fecha, $pass, $foto, $correo, $FK_tipo_doc);
        $r = $usuario->insertUpdateUsuario($idg);
        if ($r = true) {
            //METODO DE INSERSION ROL_USUARIO UPDATE
            $FK = new Rol_us($FK_rol, $ID_us, $FK_tipo_doc, $fecha_as, $estado);
            $insert = $FK->insertUpdateRol($idg);
        } // fin de if $r1

        $descrip = "Usario cambiado ID " . $ID_us;
        $FK_modific = "4";
        if ($inser = true) {
            $hora = Modificacion::horaActual();
            $m = new Modificacion($descrip, $f, $hora, $ID_us_session, $FK_tipo_doc, $FK_modific);
            $insert2 = $m->insertModificacion();
        } // fin de insertar modificacion





        if ($insert2 = true) {
            $_SESSION['message'] = "Actualizo Datos de usuario y rol";
            $_SESSION['color'] = "primary";
        } // fin de true if $insert 
        else {
            $_SESSION['message'] = "Error al actualizar Datos de usuario y rol";
            $_SESSION['color'] = "danger";
        } // fin de if fall de $insert 
        header("location: ../CU009-controlUsuarios.php ");
    } // fin del insert update usuario




    //---------------------------------------------------------------------------------------
    //update desde rol usuaurio "mismdatos"

    if ($_POST['accion'] == 'insetUpdateUsuarioUsuario') {
        include_once '../session/sessiones.php';
        echo "estoy dentro de insersion usuario";
        $id = $_SESSION['usuario']['ID_us'];
        $pass = "";
        $i = "";
        $foto = "";
        $FK_tipo_doc  = "1";
        $nom1 =  $_POST['nom1'];
        $nom2 = $_POST['nom2'];
        $ape1 = $_POST['ape1'];
        $ape2 = $_POST['ape2'];
        $fecha = $_POST['fecha'];
        $correo = $_POST['correo'];
        $us = new Usuario($i, $nom1, $nom2, $ape1, $ape2, $fecha, $pass, $foto,   $correo, $FK_tipo_doc);
        $us->insertUpdateUsuarioCliente($id);
        echo print_r($us);
        header("location: ../forms/misDatos.php");
    } // fin de update usuario ----------------------------------------------------------------------------------

    //------------------------------------------------------------------------------------------------------------
    // Cambio de cotraseña
    if ($_POST['accion'] == 'cambioContrasena') {
       // $us= Usuario::ningunDato();
        include_once '../session/sessiones.php';
        $passA = $_POST['passA'];
        $contraseñaAnterio = $us->validarPass($_SESSION['usuario']['ID_us'], $passA);
        // validacion de contraseña en base de datos
        if ($contraseñaAnterio->num_rows == 1) {
            $passN = $_POST['passN'];
            $passN2 = $_POST['passN2'];
            // validacion de digitacion correcta de nueva contrasñea
            if ($passN == $passN2 && $contraseñaAnterio->num_rows == 1) {
                $us->cambioPass($_SESSION['usuario']['ID_us'], $passN2);
            } else {
                $_SESSION['message'] = "Campos de contraseña nueva no son iguales";
                $_SESSION['color'] = "danger";
            } // fin de if validacion de digitacion correcta
        } else {
            $_SESSION['message'] = "Contraseña incorrecta";
            $_SESSION['color'] = "danger";
        } // fin de if validacion de contraseña en base de datos

        header("location: ../forms/cambioContraseña.php");
    } // fin de evento validar contraseña------------------------------------------------









    //------------------------------------------------------------------------------------
    // USUARIO
    // insert
    if ($_POST['accion'] == 'insetUsuario') {
        $f =  $us->fechaActual();
        include_once '../session/sessiones.php';
        include_once '../clases/class.puntos.php';
        $ID_us = $_POST['ID_us'];
        $nom1 = $_POST['nom1'];
        $nom2 = $_POST['nom2'];
        $ape1 = $_POST['ape1'];
        $ape2 = $_POST['ape2'];
        $fecha = $_POST['fecha'];
        $pass = $_POST['pass'];
        // $foto = $_POST['foto'];
        $correo = $_POST['correo'];
        $FK_tipo_doc = $_POST['FK_tipo_doc'];

        // Insercion de foto
        $foto = $_FILES['foto']['name'];
        $ruta = $_FILES['foto']['tmp_name'];
        $destino = '../fonts/us/'.$foto;
        copy($ruta, $destino);
        $us = Usuario::ningunDato();
       $i = $us->inserTfoto($destino, $ID_us);

    
     


        // captura de rol_usuario
        $FK_rol = $_POST['FK_rol'];
        // $FK_us
        // $FK_tipo_doc
        $fecha_as = $f;
        $estado = "0";


   // }
        // Insersion a usuario
        $usuario = new Usuario($ID_us,  $nom1, $nom2, $ape1, $ape2, $fecha, $pass, $foto, $correo, $FK_tipo_doc);
        $r1 = $usuario->insertUsuario();
     //   $us = Usuario::ningunDato();



        if($r1 = true){
            $puntos = 2;
            $fecha = $us->fechaActual(); 
            echo "estoy en if de puntos";
                $punto = new Puntos($puntos , $fecha);
                $r   = $punto->insertPuntos($ID_us, $FK_tipo_doc);
            }
     





        if ($r = true) {

            // despues de insertar usuario realiza insersion a rol
            echo "estoy despues de condisiona R";

            $FK = new Rol_us($FK_rol, $ID_us, $FK_tipo_doc, $fecha_as, $estado);
            $i = $FK->insertrRolUs();

            $est = 0;
            $descrip = $ID_us;
            $FK_rol = 1;
            $FK_not = 1;

            if ($i = true) {
                echo "estoy en condicional i";
                // Crear notificacion a rol administrador

                $not = new Notificacion($est, $descrip, $FK_rol, $FK_not);
                $int = $not->notInsertUsuarioAdmin();
            } // fin de if $r

            if ($int = true) {
                $_SESSION['message'] = "Se creo usuario y rol";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['message'] = "Error al crear usuario";
                $_SESSION['color'] = "danger";
                echo print_r($not);
                header("location: ../CU002-registrodeUsuario.php ");
            } // fin de mesage 
header("location:../index.php ");
        }
    }// metodo insert


    //-------------------------------------------------------------------------------------------------------------
    //USUARIO
    // insert direccion
    if ($_POST['accion'] == 'insertDireccion') {
        include_once '../clases/class.direccion.php';
        include_once '../session/sessiones.php';
        $us =  ($_SESSION['usuario']['ID_us']);
        $doc = ($_SESSION['usuario']['ID_acronimo']);
        $cbx_ciudad = $_POST['cbx_ciudad'];
        $cbx_localidad = $_POST['cbx_localidad'];
        $cbx_barrio = $_POST['cbx_barrio'];
        $direccion = $_POST['direccion'];
        $rut = "";
        $d = new Direccion($direccion,  $us,  $doc,  $cbx_barrio, $cbx_localidad, $cbx_ciudad, $rut);
        $i = $d->InsertDireccionUsuario();



        header("location: ../forms/formDatosPersonalesAjax.php");



    } 
    
    
    
    
        
    if ($_POST['accion'] == 'insertEmpresa') {
        // include_once '../session/sessiones.php';
         echo "estoy en insercion de empresa";
         $ID_rut = $_POST['ID_rut'];
         $nom_empresa = $_POST['nom_empresa'];
         $empresa = new Empresa($ID_rut, $nom_empresa);
         $empresa->insertEmpresa();
 
         //$_SESSION['empresa'] = $empresa;
     } // fin de insersion empresa
 
 
    
    
    
    
    
       //--------------------------------------------------   
    //EMPRESA
    //Update
    if ($_POST['accion'] == 'insertUdateEmpresa') {
        // include_once '../session/sessiones.php';
         echo 'estoy en insert empresa ';
         $id = $_GET['id'];
         $nom_empresa = $_POST['nom_empresa'];
         //echo print_r($_POST);
         $empresa = new Empresa($id, $nom_empresa);


         $empresa->actualizarDatosEmpresa($id);
     } // fin de actualizar empresa
 
     //--------------------------------------------------
    


         //-------------------------------------------------
    //CATEGORIA
    //Insert
    if ($_POST['accion'] == 'insertCategoria') {
        // include_once '../session/sessiones.php';
         echo 'estoy en insertar empresa';
         $ID_categoria = $_POST['ID_categoria'];
         $nom_categoria = $_POST['nom_categoria'];
 
         $categoria = new Categoria($nom_categoria, $ID_categoria);
         $_SESSION['categoria'] = $categoria;
         // echo print_r($_POST);
         $categoria->insertCategoria();
     } // Fin de categoria
 
     //-------------------------------------------------
    
    
    
    
    
    // fin de insetar direccion
    //-------------------------------------------------------------------------------------------------------------
    //USUARIO
    //insertar telefono

/*

    if ($_POST['accion'] == "insertTelefono") {
       // include_once '../clases/class.telefono.php';
       Y// include_once '../session/sessiones.php';

        $us =  ($_SESSION['usuario']['ID_us']);
        $doc = ($_SESSION['usuario']['ID_acronimo']);
        $tel = $_POST['telefono'];
        $rut = "";
        $tel = new Telefono($tel, $us, $doc, $rut);
        echo print_r($_POST);
        $tel->insertTelefonoUsuario();
        header("location: ../forms/formDatosPersonalesAjax.php");
    }



    //----------------------------------------------------------------
    //LOGIN

    if ($_POST['accion'] == 'login') {
      //  include_once '../session/sessiones.php';
        $tDoc =   $_POST['tDoc'];
        $nDoc = $_POST['nDoc'];
        $pass = $_POST['pass'];
        $login = new Login($tDoc, $nDoc, $pass);
        //print_r($login);
        $_SESSION['login'] = $login;
        print_r($_SESSION['login']);
        echo "<script>window.location.replace('../CU002-registrodeUsuario.php');</script>";
    } // fin de login




    //PRODUCTO------------------------------------------------------------------------------------
    // Update
    if ($_POST['accion'] == 'insertProductoUpdate') {
        $id = $_GET['id'];
      //  include_once '../session/sessiones.php';
        $ID_prod = $_POST['ID_prod'];
        $nom_prod = $_POST['nom_prod'];
        $val_prod = $_POST['val_prod'];
        $stok_prod = $_POST['stok_prod'];
        $estado_prod = $_POST['estado_prod'];
        $CF_categoria = $_POST['CF_categoria'];
        $CF_tipo_medida = $_POST['CF_tipo_medida'];




        //--------------------------------------------------------------------------------------------
        //Insertar foto












        //---------------------------------------------------------------------------------------------




        $producto = new Producto($ID_prod, $nom_prod, $val_prod, $stok_prod, $estado_prod, $CF_categoria, $CF_tipo_medida);
        $_SESSION['producto'] = $producto;
        $producto->editarProducto($id);
    } // fin de insert Producto Update

    //PRODUCTO------------------------------------------------------------
    // Insert      
    if ($_POST['accion'] == 'insertProducto') {
     //   include_once '../session/sessiones.php';
        //DATOS CAPTURADOS PARA INSERSION EN LA TABLA PRODUCTO
        $ID_prod = $_POST['ID_prod'];
        $nom_prod = $_POST['nom_prod'];
        $val_prod = $_POST['val_prod'];
        $stok_prod = $_POST['stok_prod'];
        $estado_prod = $_POST['estado_prod'];
        $CF_categoria = $_POST['CF_categoria'];
        $CF_tipo_medida = $_POST['CF_tipo_medida'];




        // paso de valores al constructor
        $producto = new Producto($ID_prod, $nom_prod,  $val_prod, $stok_prod, $estado_prod, $CF_categoria, $CF_tipo_medida);
        $_SESSION['producto'] = $producto;
        $producto->insertarProducto();


        // Insercion de foto
        $foto = $_FILES['foto']['name'];
        $ruta = $_FILES['foto']['tmp_name'];
        $destino = '../fonts/img/'.$foto;
        copy($ruta, $destino);
        Producto::inserTfoto($foto, $ID_prod);
    } // fin de insersion producto

    //PRODUCTO-------------------------------------------------------------
    //Sunmar producto

    if ($_POST['accion'] == 'inserCantidadProducto') {
       // include_once '../clases/class.conexion.php';
      //  include_once '../session/sessiones.php';
        $fecha = Usuario::fechaActual();
        $id = $_GET['id'];
        $stock = $_POST['stok'];
        $cantidad = $_POST['cantidad'];
        //print_r($_GET);

        $c = Producto::inserCatidadProducto($cantidad, $stock,  $id);
    } // fin de sumar producto



    //--------------------------------------------------------------------
    //ROL
    // insert
    if ($_POST['accion'] == 'insertRol') {
       // include_once '../session/sessiones.php';
        $_rol = $_POST['nom_rol'];
        $rol = new Rol($_rol);
        $_SESSION['rol'] = $rol;
        $rol->insertRol();
    } // fin de insersion rol

    //-------------------------------------------------------------------
    //ROL
    // Update
    if ($_POST['accion'] == 'insertUdateRol') {
      //  include_once '../session/sessiones.php';
        $id = $_GET['id'];
        $_rol  = $_POST['nom_rol'];
        $rol = new Rol($_rol);
        echo print_r($_POST);
        $rol->insertUpdateRol($id);
    } // fin de insersion update rol



    //---------------------------------------------------------------
    //MEDIDA
    // Insert
    if ($_POST['accion'] == 'insertMedida') {
       // include_once '../session/sessiones.php';
        //capturo los datos
        $nom_medida = $_POST['nom_medida'];
        $nom_prod = $_POST['acron_medida'];

        //estancio objeto de clase medida
        $medida = new Medida($nom_medida, $nom_prod);
        $_SESSION['medida'] = $medida;
        $medida->insertMedia();
    } //fin de insertar medida

    //-----------------------------------------------------
    //MEDIDA
    // Update
    if ((isset($_POST['accion']))  && ($_POST['accion'] == 'insertUdateMedia')) {
       // include_once '../session/sessiones.php';
        // echo "estoy en insertUpdate";
        $id        =  $_GET['id'];
        $nom_medida = $_POST['nom'];
        $acron_medida = $_POST['acron'];
        $medida = new Medida($nom_medida, $acron_medida);
        $medida->actualizarDatosMedida($id);
    } //fin de insertarUdate



 
    //EMPRESA
    //Insert






    //CATEGORIA
    //Update
    if ($_POST['accion'] == 'insertUdateCategoria') {
       // include_once '../session/sessiones.php';
        $categoria = $_POST['categoria'];
        $id = $_GET['id'];
        $categoria = new Categoria($categoria);
        $categoria->actualizarDatosCategoria($id);
        print_r($_POST);
    } // fin de insert update categoria
    ///------------------------------------------------------






    //------------------------------------------------------
    //FILTRO DE FORM ALERTAS


    //Ver producto


    if ($_POST['accion'] == 'alertaVerProducto') {
        //  echo "estoy en ver producto de alertas";
        $id = $_POST['producto'];

        print_r($_POST);
        $prod = Producto::verProductosId($id);
        header("location: ../CU0014-alertas.php");
    }



} else {

    echo "<script>alert('Estas ingresando por url, ingresa de manera incorrecta att Javier');</script>"; 


}// fin de else fi no existe submit por post




*/
