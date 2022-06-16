<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas Bases de datos</title>
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.css">
</head>
<body>
    
    <h1>Listado de bases de datos disponibles</h1>
    <?php
        use ITEC\PRESENCIAL\DAW\BDLIST\bd;
        include_once "../vendor/autoload.php";

        $bd = new bd ();
        if(isset($_GET["action"]))
            if ($_GET["action"]=="drop"){
                $bd->Remove("DROP database ". $_GET["db"].";");
                header('Location:');
            }
        $resultado = $bd->Select("SHOW DATABASES;");
        for($i=0;$i<count($resultado);$i++){
            $db=$resultado[$i]["Database"];
            echo '<div><a href=database.php?action=show&db='.$resultado[$i]["Database"].'>'.
                $resultado[$i]["Database"].'</a> <a href=index.php?action=drop&db='.$db.'>Borrar</a></div>';
        }
    ?>


</body>
</html>



