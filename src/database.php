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
    <div class="container m-3">
    <?php
        $db = $_GET["db"];
    ?>
    <h1>Listado tablas de <?php echo $db; ?> </h1> 
    <?php
        use ITEC\PRESENCIAL\DAW\BDLIST\bd;
        include_once "../vendor/autoload.php";

        $bd = new bd ();
        $resultado = $bd->Select("SHOW tables from ". $db .";");
        for($i=0;$i<count($resultado);$i++){
            $ctable = $resultado[$i]["Tables_in_".$_GET["db"]];
            echo '<div><a href=table.php?db='.$db.'&tabla='.$ctable.'>'.$db.".".$ctable.'</a></div>';
        }
    ?>

    </div>
</body>
</html>



