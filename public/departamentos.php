<?php
    session_start();
    require '../vendor/autoload.php';
    use Clases\Departamentos;

    $departs=new Departamentos();
    $datos=$departs->devolverTodos();
    $departs=null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <title>Departamentos</title>
</head>
<body style="background-color:#24558F">
<h3 class="mt-2 text-center text-white">Departamentos</h3>
<div class="container mt-3 mb-4">
    <?php
        require 'resources/mensajes.php';
    ?>
    <a href="crearDepartamento.php" class="btn btn-success"><i class="fas fa-plus-square"></i> Nuevo Departamento</a>
        <table class="table table-dark table-striped mt-2">
            <thead>
                <tr style="text-align:center;">
                <th scope="col">Detalles</th>
                <th scope="col">Nombre</th>
                <th scope="col">Id</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                    while($fila=$datos->fetch(PDO::FETCH_OBJ)){
                        
                        echo    "<tr style='text-align:center;'>";
                        echo    "       <td>";
                        echo    "            <a href='detallesDepartamento.php?id={$fila->id}' class='btn btn-info'><i class='fas fa-info'></i> Detalles</a>";
                        echo    "       </td>";
                        echo    "       <td>{$fila->nom_dep}</td>";
                        echo    "       <td>{$fila->id}</td>";
                        echo    "       <td>";
                        echo    "           <form name='as' method='POST' class='form-inline' action='borrarDepartamento.php'>\n";
                        echo    "               <a href='editarDepartamento.php?id={$fila->id}' class='btn btn-warning'>Editar</a>";
                        echo    "               <input type='hidden' name='codigo' value='{$fila->id}'>\n";
                        echo    "               <button type='submit' class='ml-2 btn btn-danger'>Borrar</button>\n";
                        echo    "           </form>\n";
                        echo    "       </td>";
                        echo    "   </tr>";
                        
                    }
                ?>
            </tbody>
        </table>
       <a href="index.php" class="btn btn-dark">Volver</a>
    </div>
</body>
</html>