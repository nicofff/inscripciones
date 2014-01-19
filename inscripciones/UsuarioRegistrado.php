<?php
include "model/dbConn.php"; # me da el obj $MYSQLI
$query = "SELECT * from Inscriptos where TipoDoc = " . $_GET["tipoDoc"] . " AND NumeroDoc = " . $_GET["NumeroDoc"];
if ($result = $MYSQLI->query($query)) {
    $resObj = $result->fetch_object();
    $MYSQLI->close();
} else {
    print_r(mysqli_error($MYSQLI));
    die();
}
?>
<html>
    <body>
        <h1>
            Datos Registro
        </h1>
        <span>Codigo registro: <?php echo sha1($resObj->ID);?></span>
        <p>
            <span> Nombre: <?php echo $resObj->Nombre;?></span><br/>
            <span> Apellido: <?php echo $resObj->Apellido;?></span>
        </p>
    </body>
</html>