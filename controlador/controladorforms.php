
<?php
//session_destroy();
include_once '../modelo/class.usuario.php';
include_once '../modelo/class.documento.php';
include_once '../modelo/class.rol.php';
include_once '../modelo/class.categoria.php';
include_once '../modelo/class.medida.php';
include_once '../modelo/class.proveedor.php';
include_once '../modelo/class.producto.php';
include_once '../modelo/class.telefono.php';
class ControllerDocForm{
    public $obModDoc;
    public $objModUs;
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
    public function __construct() {
        $this->obModDoc   =  Documento::ningunDatoD();
        $this->objModUs   =  Usuario::ningunDato();
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
        $this->objModTel  =  Telefono::ningunDato();
    }

   public function createTelefonoController($tel,$CF_us,$CF_tipo_doc,$CF_rut){
    $datosController[] = [
        0         =>  $tel,
        1         =>  $CF_us,
        2         =>  $CF_tipo_doc,
        3         =>  $CF_rut 
    ];
    return $this->objModTel-> insertTelefonoUsuario($datosController, 'telefono');
    
   }
   //metodos de telefeono
   public function verTelefonosUsuario(){
       return $this->objModTel->verTelefonosUsuario();
   }
   public function verTelefonosUsuarioPorID($id){
       return $this->objModTel->verTelefonosUsuarioPorID($id);
   }
   public function verTelefonosEmpresa(){
       return $this->objModTel->verTelefonosEmpresa();
   }
   public function verTelefonosUsuarioRol($rol){
       return $this->objModTel->verTelefonosUsuarioRol($rol);
   }
}