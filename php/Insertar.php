<?php

    $Seccion=$_POST["Seccion"];
    $Nombre=$_POST["Nombre"];
    $Precio=$_POST["Precio"];
    $Fecha=$_POST["Fecha"];
    $PaisOrigen= $_POST["PaisOrigen"];
    $Estado=true;
    if(!strcasecmp($_POST["PaisOrigen"], "Argentina")){
        $Estado=false;
    }

    ///conexion con excepciones try, catch y finally
    try{
        $Objeto= new PDO ('mysql:host=localhost; dbname=tp9', 'root', ''); 
        $Objeto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $Objeto->exec("SET CHARACTER SET utf8");
        
        $sql="INSERT INTO `productos`(`Seccion`, `Nombre`, `Precio`, `Fecha`, `Importado`, `PaisOrigen`) VALUES (:Seccion,:Nombre,:Precio,:Fecha,:Importado,:PaisOrigen)";

        $PDO=$Objeto->prepare($sql);
        
        $PDO->execute(array(":Seccion"=>$Seccion,":Nombre"=>$Nombre, ":Precio"=>$Precio, ":Fecha"=>$Fecha, ":Importado"=>$Estado, ":PaisOrigen"=>$PaisOrigen));

        $PDO->closeCursor();

        echo "Enviado";
        echo "  <a href='../html/index.html'>Ingreso</a>";
        
    }catch(Exception $Excepion){
        
        die("Error: " . $Excepion->getMessage());
        
    }finally{

        $Seccion=NULL;
        $Nombre=NULL;
        $Precio=NULL;
        $Fecha=NULL;
        $PaisOrigen=NULL;
        $Estado=NULL;
        
        $Objeto=NULL;
        $sql= NULL;
        $PDO=NULL;
        
    }
    
    ///consulta
    

?>