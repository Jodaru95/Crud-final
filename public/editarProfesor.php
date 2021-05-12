<?php
session_start();
if(!isset($_GET['id'])){
    header("Location:profesores.php");
    die();
}
require '../vendor/autoload.php';
use Clases\{Profesores,Departamentos};
$id=$_GET['id'];
$esteDepartamento=new Departamentos();
$esteProfesor=new Profesores();
$esteProfesor->setId($id);
$profesor=$esteProfesor->read();

$esteDepartamento->setId($profesor->dep);
$departamento=$esteDepartamento->devolverDepartamento();
$seleccionado=$departamento->fetch(PDO::FETCH_OBJ);
$todos=$esteDepartamento->devolverTodos();

function errores($texto){
    global $id;
    $_SESSION['mensaje']=$texto;
    header("Location:{$_SERVER['PHP_SELF']}?id=$id");
    die();
}

//Tratamos los datos
if(isset($_POST['editar'])){
    $nombre=ucwords(trim($_POST['nombre']));
    $sueldo=trim($_POST['sueldo']);
    $departamento=trim($_POST['departamento']);
    if(strlen($nombre)==0 || strlen($sueldo)==0){
        errores("Rellene los campos, porfavor.");
    }

    $profeEdited=new Profesores();
    $profeEdited->setId($id);
    $profeEdited->setNom_prof($nombre);
    $profeEdited->setSueldo($sueldo);
    $profeEdited->setDep($departamento);
    $profeEdited->update();

    $esteDepartamento=null;
    $esteProfesor=null;
    $_SESSION['mensaje']="Profesor Actualizado Correctamente";
    header("Location:profesores.php");

}else{
    //Cargamos el formulario
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Editar Profesor</title>
</head>
<body style="background-color:#24558F">
<h2 class="text-white text-center mt-2">Editar Profesor</h2>
    <div class="container mt-3 mb-4">
    <?php
        require 'resources/mensajes.php';
    ?>
        <form class="w-25 mx-auto" name="nt" action="<?php echo $_SERVER['PHP_SELF']; ?>?id={$profesor->id}" method="POST">
            <div class="mt-2 ">
                <input type="text" name="nombre" value="<?php echo $profesor->nom_prof ?>" required class="form-control" />
            </div>
            <div class="mt-2 ">
                <input type="text" name="sueldo" value="<?php echo $profesor->sueldo ?>" required class="form-control"/>
            </div>
            <div class="mt-2 ">
                <select class="form-select" name="departamento" aria-label="Default select example">
                    <option selected value="{$seleccionado->id}"><?php echo $seleccionado->nom_dep; ?></option>
                    <?php
                        while($item=$todos->fetch(PDO::FETCH_OBJ)){
                            echo "<option value='{$item->id}'>{$item->nom_dep}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mt-2">
                <input type="submit" name="editar" value="Editar" class="btn btn-success mr-2"/>
                <a href="profesores.php" class="btn btn-primary">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
}//FinElse
?>