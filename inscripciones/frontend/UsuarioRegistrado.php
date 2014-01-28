<?php
include "../model/dbConn.php"; # me da el obj $MYSQLI
$query = "SELECT * from Inscriptos where TipoDoc = " . $_GET["tipoDoc"] . " AND NumeroDoc = " . $_GET["NumeroDoc"];
if ($result = $MYSQLI->query($query)) {
    $resObj = $result->fetch_object();
    $MYSQLI->close();
} else {
    print_r(mysqli_error($MYSQLI));
    die();
}
//TODO: Validar datos invalidos
?>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css"/>
    </head>
    <body>
        <h1>
            Datos Registro
        </h1>
        
        <?php
        if(isset($_GET["existente"]) && $_GET["existente"]=1){
            echo "<h2>Usuario previamente registrado</h2>";
        }
        ?>
        <span>Codigo registro: <?php echo sha1($resObj->ID);?></span>
        <p>
            <span> Nombre: <?php echo $resObj->Nombre;?></span><br/>
            <span> Apellido: <?php echo $resObj->Apellido;?></span><br/>
            <span> Situacion Becaria: <?php echo ($resObj->Laboratorio)?"Becado":"No Becado";?></span><br/>
        </p>
        
        <div class="imprimir">
            <input type="button" onclick="window.print()" value="Imprimir"/>
        </div>
    </body>
</html>