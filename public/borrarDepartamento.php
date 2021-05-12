<?php
session_start();
if(!isset($_POST['codigo'])){
    header("Location:departamentos.php");
    die();
}
require '../vendor/autoload.php';
use Clases\Departamentos;
$esteDep=new Departamentos();
$esteDep->setId($_POST['codigo']);
$esteDep->delete();
$esteDep=null;
$_SESSION['mensaje']="Departamento Borrado Correctamente";
header("Location:departamentos.php");