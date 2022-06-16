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
    <?php
            use ITEC\PRESENCIAL\DAW\BDLIST\bd;
            include_once "../vendor/autoload.php";
    
            $bd = new bd ();

        $db = isset($_GET["db"])?$_GET["db"]: $_POST["database"];
        $tabla = isset($_GET["tabla"])?$_GET["tabla"]: $_POST["tabla"];
        if (isset($_POST["id"])){
            $sqlquery= 'UPDATE ' . $db . "." . $tabla. " SET ";
            foreach($_POST as $campo => $valor){
                if ($campo!="tabla" && $campo!="database"){
                    $sqlquery .= $db.".".$tabla.".".$campo . " = ";
                    $sqlquery .= (is_numeric($valor)?$valor:'"'.$valor.'"') . ", ";
                }
            }
            $sqlquery = substr($sqlquery,0,-2);
            $sqlquery .= " ";
            $sqlquery .= "WHERE id=" . $_POST["id"] . ";";
            $bd->Update($sqlquery);
        }

    ?>
    <h1>Datos tabla de <?php echo $_GET["tabla"]; ?> </h1>
    <?php

        $resultado = $bd->Select("Select * from ". $db . ".". $tabla .";");
        $cabeceras = array_keys($resultado[0]);
        $code = '<table><tr>';
        for ($i=0;$i<count($cabeceras);$i++){
            $code.="<th>$cabeceras[$i]</th>";
        }
        $code .= "</tr>";
        for($i=0;$i<count($resultado);$i++){
            $code .= '<tr><form action="table.php" method="POST">';
            $j=0;
            foreach($resultado[$i] as $campo =>$valor){
                $code.='<td>';
                $code.='<input type="hidden" name="id" value="'.$resultado[$i]["id"].'">';
                $code.='<input type="hidden" name="database" value="'.$db.'">';
                $code.='<input type="hidden" name="tabla" value="'.$tabla.'">';
                $code.='<input type="text" name="'.$cabeceras[$j++] .'"'.' value="' .$valor . '" />';
                $code.='</td>';
            }
            $code .= '<td><button type="submit" value="save_'.$resultado[$i]["id"].'">Guardar</button></td></form></tr>';
        }
        $code.="</table>";
        echo $code;
    ?>


</body>
</html>



