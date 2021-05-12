<?php
session_start();
require '../vendor/autoload.php';
use Clases\{Profesores,Departamentos};
//Recibo los departamentos existentes
$departamentos=new Departamentos();
$todos=$departamentos->devolverTodos();
$departamentos=null;
//Creo la funcion que lance los errores en forma de mensaje:
function errores($texto){
    $_SESSION['mensaje']=$texto;
    header("Location:{$_SERVER['PHP_SELF']}");
    die();
}

//Trato el formulario
if(isset($_POST['crear'])){
    $nombre=ucwords(trim($_POST['nombre']));
    $sueldo=trim($_POST['sueldo']);
    $departamento=$_POST['departamento'];

    if(strlen($nombre)==0 || $sueldo==0 || $departamento==0){
        errores("Rellene los campos y añada el departamento");
    }
    
    $nuevoProfe=new Profesores();
    $nuevoProfe->setNom_prof($nombre);
    $nuevoProfe->setSueldo($sueldo);
    $nuevoProfe->setDep($departamento);
    $nuevoProfe->create();

    $nuevoProfe=null;
    $_SESSION['mensaje']="Profesor creado";
    header("Location:profesores.php");

}else{//Cargamos el formulario
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Crear Profesor</title>
</head>
<body style="background-color:#24558F">
    
    <h2 class="text-white text-center mt-2">Crear Profesor</h2>
    <div class="container mt-3 mb-4">
    <?php
        require 'resources/mensajes.php';
    ?>
        <form class="w-25 mx-auto" name="nt" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mt-2 ">
                <input type="text" name="nombre" placeholder="Nombre" required class="form-control" />
            </div>
            <div class="mt-2 ">
                <input type="text" name="sueldo" placeholder="Sueldo" required class="form-control"/>
            </div>
            <div class="mt-2 ">
                <select class="form-select" name="departamento" aria-label="Default select example">
                    <option selected>Selecciona el departamento</option>
                    <?php
                        while($item=$todos->fetch(PDO::FETCH_OBJ)){
                            echo "<option value='{$item->id}'>{$item->nom_dep}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mt-2">
                <input type="submit" name="crear" value="Crear" class="btn btn-success mr-2"/>
                <input type="reset" value="Limpiar" class="btn btn-warning mr-2"/>
                <a href="profesores.php" class="btn btn-primary">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
<?php
}//Cerramos el else
?>