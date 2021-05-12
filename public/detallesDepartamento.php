<?php
    session_start();
    if(!isset($_GET['id'])){
        header("Location:departamentos.php");
        die();
    }
    require '../vendor/autoload.php';
    use Clases\Departamentos;
    $cod=$_GET['id'];
    $esteDepartamento=new Departamentos();
    $esteDepartamento->setId($cod);
    $datos=$esteDepartamento->read();
    $esteDepartamento=null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Detalles del departamento</title>
</head>
<body style="background-color:#24558F">
    <div class="container mt-5 mb-4">
        <div class="card mx-auto" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title"><?php echo $datos->nom_dep?></h5>
                <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $datos->id?></h6>
                <a href="departamentos.php" class="btn btn-dark"><i class="fas fa-backward"></i> Volver</a>
            </div>
        </div>
    </div>
</body>
</html>