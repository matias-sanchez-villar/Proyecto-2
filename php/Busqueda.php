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
                    <a class="nav-link" href="Listado.php">Listado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/index.html">Ingreso</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Busqueda.php">Busqueda</a>
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

    <div class="container-fluid">
        <div class="container py-5">
            <form name="inicio" action="Busqueda.php" method="post">
                <div class="form-group">
                    <label>Nombre del producto:</label>
                    <input type="text" name="Nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label>Pais de Origen:</label>
                    <input type="text" name="PaisOrigen" class="form-control">
                </div>
                <button type="submit" name="Enviar" value="Enviar" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>

    <?php

    if(isset($_POST['Enviar'])){
        $Nombre=$_POST["Nombre"];
        $PaisOrigen=$_POST["PaisOrigen"];

        ///conexion con excepciones try, catch y finally
        try{
            $Objeto= new PDO ('mysql:host=localhost; dbname=tp9', 'root', ''); 
            $Objeto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $Objeto->exec("SET CHARACTER SET utf8");
            
            $sql="SELECT `Codigo`, `Seccion`, `Nombre`, `Precio`, `Fecha`, `Importado`, `PaisOrigen`, `Foto` FROM productos WHERE Nombre=:Nombre AND PaisOrigen=:PaisOrigen";

            $PDO=$Objeto->prepare($sql);
            
            $PDO->execute(array(":Nombre"=>$Nombre, ":PaisOrigen"=>$PaisOrigen));

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
            
            while($fila=$PDO->fetch(PDO::FETCH_ASSOC)){
                if($fila['Importado']){
                    $fila['Importado']="Si";
                }else{
                    $fila['Importado']="No";
                }
                echo("
                    <tbody>
                        <tr>
                            <th scope='row'>".$fila['Codigo']."</th>
                            <td>".$fila['Seccion']."</td>
                            <td>".$fila['Nombre']."</td>
                            <td>".$fila['Precio']."</td>
                            <td>".$fila['Fecha']."</td>
                            <td>".$fila['Importado']."</td>
                            <td>".$fila['PaisOrigen']."</td>
                            <td>".$fila['Foto']."</td>
                        </tr>
                    </tbody>
                ");
                echo "</table>";
            }

            $PDO->closeCursor();
            
        }catch(Exception $Excepion){
            
            die("Error: " . $Excepion->getMessage());
            
        }finally{

            $Nombre=NULL;
            $Objeto=NULL;
            $sql= NULL;
            $PDO=NULL;
            
        }
    }
  

?>

</body>

</html>