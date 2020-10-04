
<?php
//session_destroy();
include_once '../modelo/class.usuario.php';


/*
include_once '../modelo/class.documento.php';

include_once '../modelo/class.rol.php';
include_once '../modelo/class.categoria.php';
include_once '../modelo/class.medida.php';
include_once '../modelo/class.proveedor.php';
include_once '../modelo/class.producto.php';
include_once '../modelo/class.factura.php';
include_once '../modelo/class.modificacion.php';
include_once '../modelo/class.ciudad.php';
include_once '../modelo/class.empresa.php';
include_once '../modelo/class.error.php';
include_once '../modelo/class.telefono.php';
*/
class ControllerDoc
{

    public $objModUs;
    public $obModDoc;

    public $objModRol;
    public $objModCat;
    public $objModMed;
    public $objModPro;
    public $objModProd;
    public $objModFact;
    public $objModModi;
    public $objModCiu;
    public $objModEmp;
    public $objModError;
    public $objModTel;


    public function __construct()
    {

        $this->objModUs   =  Usuario::ningunDato();

        /*
        $this->obModDoc   =  Documento::ningunDatoD();

        $this->objModRol  =  Rol::ningunDato();
        $this->objModCat  =  Categoria::ningunDatoC();
        $this->objModMed  =  Medida::ningunDatoM();
        $this->objModPro  =  Proveedor::ningunDatoP();
        $this->objModProd =  Producto::ningunDatoP();
        $this->objModFact =  Factura::ningunDato();
        $this->objModModi =  Modificacion::ningunDato();
        $this->objModCiu  =  Ciudad::ningunDato();
        $this->objModEmp  =  Empresa::ningunDatoP();
        $this->objModError=  ErrorLog::ningunDato();
        $this->objModTel =  Telefono::ningunDato();
        */
    }
    public function selectDocumento()
    {
        return $this->objModDoc->verDocumeto();
    }

    public function loginUsuarioController($ID_us,  $pass, $doc)
    {
        $datosController[] = [$ID_us, $pass, $doc];
        //  if( isset($_SESSION['usuario']  ) ){
        //  session_start(); }

        return $this->objModUs->loginUsuarioModel($datosController);
    }
    public function createUsuariosController(
        $ID_us,
        $nom1,
        $nom2,
        $ape1,
        $ape2,
        $fecha,
        $pass,
        $foto,
        $correo,
        $FK_tipo_doc
    ) {
        $datosController[] = [
            0         =>  $ID_us,
            1         =>  $nom1,
            2         =>  $nom2,
            3         =>  $ape1,
            4         =>  $ape2,
            5         =>  $fecha,
            6         =>  $pass,
            7         =>  $foto,
            8         =>  $correo,
            9         =>  $FK_tipo_doc
        ];
        return $this->objModUs->InsertUsuario($datosController, 'usuario');
        /*
           // Insercion de foto
           $foto = $_FILES['foto']['name'];
           $ruta = $_FILES['foto']['tmp_name'];
           $destino = '../global/fonts/us/'.$foto;
           copy($ruta, $destino);
           $us = Usuario::ningunDato();
          $i = $us->inserTfoto($destino, $ID_us);

          */
    }
    public function readUsuariosController()
    {
        return $this->objModUs->readUsuarioModel('vendedor');
    }
    public function eliminarUsuario($id_get)
    {
        return  $this->objModUs->eliminarUsuario($id_get);
    }
    public function actualizarDatosUsuario($id, $array)
    {
        return $this->objModUs->actualizarDatosUsuario($id, $array);
    }

    //Metodos de entidad usuario form CU009-controlusuarios.php
    public function selectUsuarioRol($id_rol)
    {
        return $this->objModUs->selectUsuarioRol($id_rol);
    }
    public function conteoUsuariosActivos()
    {
        return $this->objModUs->conteoUsuariosActivos();
    }
    public function conteoUsuariosInactivos()
    {
        return $this->objModUs->conteoUsuariosInactivos();
    }
    public function selectIdUsuario($id)
    {
        return $this->objModUs->selectIdUsuario($id);
    }
    public function selectUsuariosPendientes($est)
    {
        return $this->objModUs->selectUsuariosPendientes($est);
    }
    public function activarCuenta($id)
    {
        return $this->objModUs->activarCuenta($id);
    }

    public function desactivarCuenta($id)
    {
        return $this->objModUs->desactivarCuenta($id);
    }

    // Metodos de categoria 
    //"CU004-crearProductos.php"
    public function verCategorias()
    {
       // return $this->objModCat->verCategorias();
    }
    //formCategoria.php
    public function verCategoria()
    {
     //   return $this->objModCat->verCategoria();
    }
    public function verCategoriaId($id)
    {
     //   return $this->objModCat->verCategoriaId($id);
    }
    public function verPromociones()
    {
      //  return $this->objModProd->verPromociones();
    }


    //Medida     
    public function verMedida()
    {
      //  return $this->objModMed->verMedida();
    }
    public function verDatoPorIdMedida($id)
    {
      //  return $this->objModMed->verDatoPorId($id);
    }


    public function verProveedor()
    {
       // return $this->objModPro->verProveedor();
    }



    public function verProductos()
    { // CU003-ingresoproducto.php
      //  return $this->objModProd->verProductos();
    }
    public function verProductosIdCarrito($ID)
    {
      //  return $this->objModProd->verProductosIdCarrito($ID);
    }
    public function tablaProducto($id)
    {
     //   return $this->objModProd->verJoin($id);
    }
    public function verProductosId($id_p)
    {
       // return $this->objModProd->verProductosId($id_p);
    }
    // U004-crearproductos.php
    public function insertarProducto($a)
    {
      //  return $this->objModProd->insertarProducto($a);
    }
    public function verProductosGrafica()
    {
      //  return $this->objModProd->verProductosGrafica();
    }
    public function ConteoProductosT(){
      //  return $this->objModProd->ConteoProductosT();
    }
    public function EliminarProducto($id){
     //   return $this->objModProd->EliminarProducto($id);
    }



    // Catalogo
    public function buscarPorNombreProducto($id)
    {
      //  return $this->objModProd->buscarPorNombreProducto($id);
    }
    public function verPorCategoria($id)
    {
      //  return $this->objModProd->verPorCategoria($id);
    }




    //CU006-acomulaciondepuntos.php
    public function verPuntosUs()
    {
        return $this->objModUs->verPuntosUs();
    }



    //metodos de factura
    public function usuariosComprasRealizadas()
    {
      //  return $this->objModFact->usuariosComprasRealizadas();
    }
    public function verUsuarioFactura($id)
    {
      //  return $this->objModFact->verUsuarioFactura($id);
    }
    public function verjoinFactura()
    {
      //  return $this->objModFact->verjoinFactura();
    }
    public function verIntervaloFecha($f1, $f2)
    {
       // return $this->objModFact->verIntervaloFecha($f1, $f2);
    }




    //modificaion db
    public function verJoinModificacionesDB()
    {
     //   return $this->objModModi->verJoinModificacionesDB();
    }



    //Metodos de Rol
    public function verRolId($id)
    {
      //  return $this->objModRol->verRolId($id);
    }
    public function verRol()
    {
      //  return $this->objModRol->verRol();
    }






    //metodos de ciudad
    public function verCiudad()
    {
      //  return $this->objModCiu->verCiudad();
    }

    //metodos de empresa
    public function verDatoPorId($id)
    {
      //  return $this->objModEmp->verDatoPorId($id);
    }
    public function verEmpresa()
    {
      //  return $this->objModEmp->verEmpresa();
    }

    public function verTelefonosUsuario(){
      //  return $this->objModTel->verTelefonosUsuario();
    }
    public function verTelefonosUsuarioPorID($id){
      //  return $this->objModTel->verTelefonosUsuarioPorID($id);
    }
    public function verTelefonosEmpresa(){
      //  return $this->objModTel->verTelefonosEmpresa();
    }
    public function verTelefonosUsuarioRol($rol){
     //   return $this->objModTel->verTelefonosUsuarioRol($rol);
    }

    public function eliminarTelefono($id){
      //  return $this->objModTel->eliminarTelefono($id);
    }

 

    //metodos de error
    public function verError()
    {
       // return $this->objModError->verError();
    }
   
    public function ver($dato, $sale=0, $float= false, $email=''){
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


    //metodos telefonos
    
}







/*
if(isset($_GET['action']) && $_GET['action'] == 'login'){
    $instanciacontrolador = Usuario::ningunDato();
    $instanciacontrolador->LoginVista();
}
if(isset($_GET['accion']) && $_GET['accion'] == 'insert'){
    $instanciacontrolador = Usuario::ningunDato();
    $instanciacontrolador->InsertVista();
}
//include_once '../clases/class.empresa.php';
//include_once '../clases/class.conexion.php';
//include_once '../clases/class.categoria.php';
//include_once '../clases/class.producto.php';
//include_once '../clases/class.usuario.php';
//include_once '../clases/class.rol.php';
//include_once '../clases/class.medida.php';
//include_once '../clases/class.error.php';
//$us = Usuario::ningunDato();
//---------------------------------------------------------------
if ((isset($_GET['id'])) && (isset($_GET['accion']))) {
    //-------------------------------------------------------------------- 
    //USUARIO
    if ($_GET['accion'] == 'eliminarUsuario') {
        echo 'estoy en accion eliminar usuario';
        $id =  $_GET['id'];
        $objCon = Usuario::ningunDato();
        $objCon->eliminarUsuario($id);
    }
}
    //--------------------------------------------------------------------
/*
    //-------------------------------------------------------------------- 
    //MEDIDA   
    if ($_GET['accion'] == 'eliminarMedida') {
        include_once '../session/sessiones.php';
        // echo "estoy en eliminar medida";
        $id = $_GET['id'];
        Medida::eliminarDatosMedia($id);
    }
    //--------------------------------------------------------------------
    //EMPRESA
    //Eliminar
    if ($_GET['accion'] == 'eliminarEmpresa') {
        include_once '../session/sessiones.php';
        echo "estoy en accion eliminar empresa";
        $id = $_GET['id'];
        $objCon = Empresa::ningunDatoP();
        $objCon->eliminarEmpresa($id);
    }
    //--------------------------------------------------------------------
    //CATEGORIA
    //Eliminar
    if ($_GET['accion'] == 'eliminarCategoria') {
        include_once '../session/sessiones.php';
        echo 'estoy en accion eliminar categoria';
        $id =  $_GET['id'];
        $objCon = Categoria::ningunDatoC();
        $objCon->eliminarCategoria($id);
    }
    //----------------------------------------------------------------
    //PRODUCTO
    //Eliminar
    if ($_GET['accion'] == 'EliminarProducto') {
        include_once '../session/sessiones.php';
        $id = $_GET['id'];
        $producto =  Producto::eliminarProducto($id);
        Producto::eliminarProducto($id);
    }
    //-------------------------------------------------------------
    // USUARIO 
    //Aprobar Cuenta
    if ($_GET['accion'] == 'aprobarUsuario') {
        include_once '../session/sessiones.php';
        $id = $_GET['id'];
        $us->activarCuenta($id);
    }
    //-------------------------------------------------------------
    // USUARIO 
    //descatvar Cuenta
    if ($_GET['accion'] == 'desactivarUsuario') {
        include_once '../session/sessiones.php';
        $id = $_GET['id'];

     //   $us= Usuario::ningunDato();
        $us->desactivarCuenta($id);
    }
    //-----------------------------------------------------------
    //ROL
    if ($_GET['accion'] == 'eliminarRol') {
        include_once '../session/sessiones.php';
        $id = $_GET['id'];
        Rol::eliminarRol($id);
    }
    //-------------------------------------------------------------------------
    //ERROR
    //Eliminar
    if ($_GET['accion'] == 'eliminarError') {
        $id = $_GET['id'];
        ErrorLog::eliminarErrorLog($id);
    }
//-------------------------------------------------------------
// Ver factura = vista = ComprasUsuarios.php
//../metodos/get.php?accion=verFactura

if( $_REQUEST['accion'] == 'verFactura'){
    echo "Estoy en ver factura";
     $id =  $_REQUEST['id'];
    // header("Location: ../ajax/includes/factura.php?u=$id");
    header("Location: ../ajax/showFactura.php?u=$id");
}
//-------------------------------------------------------------

} // fin de isset accion y id

//----------------------------------------------
//SESSION
//cerrar sesion
//-----------------------------------------------------------------
if (isset($_GET['cerrarSesion'])) {

    //include_once 'cerrar.php';
    //include_once 'sessiones.php';

    if (isset($_SESSION['usuario'])) {
        session_unset();
        session_destroy();
    }
    session_start();
    $_SESSION['message'] = "Cerro sesion";
    $_SESSION['color'] = "primary";
    header("location: ../index.php");
    $_SESSION['message'] = "Cerro sesion";
    echo "cerro sesion";
}
// Lista de productos en pantalla
//-----------------------------------------------------------
//include_once '../session/sessiones.php';
//include_once './metodosDAO.php';
 //echo print_r ($_SESSION['usuario']);
 if(isset($_GET['ops'])){
$op = $_REQUEST['ops'];
switch ($op){
    case 1:
        unset($_SESSION['lista']);
        $lista=    $objMetodo =Producto::listaProductosImg();
       
        $_SESSION['lista']=$lista;
        header("Location: ../Catalogo.php");
        break;
    case 2;
        break; 

    }
}
//$objMod = Rol::ningunDato();
//-------------------------------------------------------------
// $objCon = new ControllerDoc();
// // $d = $objCon->verRol();
// echo '<pre>';  print_r($d); echo '</pre>'; die();   

*/

?>