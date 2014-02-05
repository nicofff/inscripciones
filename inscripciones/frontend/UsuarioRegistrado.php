<?php
include "../model/dbConn.php"; # me da el obj $MYSQLI

$existente = isset($_GET["existente"]) && $_GET["existente"] == 1;


$query = "SELECT I.Nombre, I.Apellido, I.CodigoInscripcion, I.Email,I.Laboratorio as laboID, L.Nombre as Laboratorio from Inscriptos I, Laboratorios L where I.Email = '" . $_GET["email"] . "' and I.Laboratorio = L.ID";
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
        <meta charset="UTF-8"> 
    </head>
    <body>
        <img class="solo-impresion" src="img/header-registrado.jpg" />
        <div class="registrado">
            <h1>
                Datos Registro
            </h1>

            <?php
            if ($existente) {
                echo "<h2>Usuario previamente registrado</h2>";
            }
            ?>

            <p>

                <span><span class="denominador">C&oacute;digo registro:</span> <?php echo $resObj->CodigoInscripcion; ?></span>

                <span>  <span class="denominador">Nombre:</span> <?php echo $resObj->Nombre; ?></span>
                <span>  <span class="denominador">Apellido:</span> <?php echo $resObj->Apellido; ?></span>
                <span>  <span class="denominador">Situaci&oacute;n Becaria:</span> <?php echo ($resObj->laboID) ? "Becado por ". $resObj->Laboratorio : "No Becado"; ?></span>
            </p>

            <div class="imprimir">
                <input type="button" onclick="window.print()" value="Imprimir"/>
            </div>
        </div>
    </body>
</html>