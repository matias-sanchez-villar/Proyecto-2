<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto-2</title>
    <!-- script -->
    <script src="https://kit.fontawesome.com/2608d06942.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <h3 class="text-center py-3">Proyecto-2</h3>
    </div>

    <div class="container-fluid  bg-light">
        <div class="container">
            <ul class="nav nav-justified py-2 nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="Listado.php">Listado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/index.html">Ingreso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Busqueda.php">Busqueda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Eliminar.php">Eliminar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Modificar.php">Modificar</a>
                </li>
            </ul>
        </div>
    </div>


    <?php

    ///con un objeto
    
    $Objeto= new mysqli ("localhost", "root", "", "tp9");
    ///verificmamos todo
    if ($Objeto->connect_errno) {
        die('Connect Error: ' . $Objeto->connect_errno);
    }
    ///ponemos caracteres en español
    $Objeto->set_charset("utf-8");

    $Consulta="SELECT * FROM `productos`";

    $Resultado= $Objeto->query($Consulta);

    if($Objeto->errno){
        die($Objeto->error);
    }


    echo("
    <table class='table'>
        <thead>
            <tr>
                <th scope='col'>Codigo</th>
                <th scope='col'>Seccion</th>
                <th scope='col'>Nombre</th>
                <th scope='col'>Precio</th>
                <th scope='col'>Fecha</th>
                <th scope='col'>Impotado</th>
                <th scope='col'>Pais de Origen</th>
                <th scope='col'>Foto</th>
            </tr>
        </thead>");

    
    while($fila=$Resultado->fetch_array()){
        if($fila[5]){
            $fila[5]="Si";
        }else{
            $fila[5]="No";
        }
        echo("
            <tbody>
                <tr>
                    <th scope='row'>$fila[0]</th>
                    <td>$fila[1]</td>
                    <td>$fila[2]</td>
                    <td>$fila[3]</td>
                    <td>$fila[4]</td>
                    <td>$fila[5]</td>
                    <td>$fila[6]</td>
                    <td>$fila[7]</td>
                </tr>
            </tbody>
        ");
    }
    echo "</table>";

?>

</body>

</html>