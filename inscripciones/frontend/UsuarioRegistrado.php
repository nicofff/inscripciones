<?php
include "../model/dbConn.php"; # me da el obj $MYSQLI

$existente = isset($_GET["existente"]) && $_GET["existente"]==1;


$query = "SELECT * from Inscriptos where Email = '" . $_GET["email"]."'";
if ($result = $MYSQLI->query($query)) {
    $resObj = $result->fetch_object();
    $MYSQLI->close();
} else {
    print_r(mysqli_error($MYSQLI));
    die();
}
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
        if($existente){
            echo "<h2>Usuario previamente registrado</h2>";
        }
        ?>
        <span>Codigo registro: <?php echo $resObj->CodigoInscripcion ;?></span>
        <p>
            <span> Nombre: <?php echo $resObj->Nombre;?></span><br/>
            <span> Apellido: <?php echo $resObj->Apellido;?></span><br/>
            <span> Email: <?php echo $resObj->Email;?></span><br/>
            <span> Situacion Becaria: <?php echo ($resObj->Laboratorio)?"Becado":"No Becado";?></span><br/>
        </p>
        
        <div class="imprimir">
            <input type="button" onclick="window.print()" value="Imprimir"/>
        </div>
    </body>
</html>