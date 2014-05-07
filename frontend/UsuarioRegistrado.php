<?php
include "../model/dbConn.php"; # me da el obj $MYSQLI

$existente = isset($_GET["existente"]) && $_GET["existente"] == 1;


$query = "SELECT I.Nombre, I.Apellido, I.CodigoInscripcion, C.Nombre as Categoria, I.Email,I.Laboratorio as laboID, L.Nombre as Laboratorio from Inscriptos I, Laboratorios L, Categorias C where I.Email = '" . $_GET["email"] . "' and I.Laboratorio = L.ID and I.Categoria = C.ID";
if ($result = $MYSQLI->query($query)) {
    if ($result->num_rows != 0) {
        $resObj = $result->fetch_object();
    } else {
        $resObj = null;
    }
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
        <?php if ($resObj !== null): ?>

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

                    <?php
                    if ($resObj->Categoria == "Becado") {
                        $categoria = "Becado por " . $resObj->Laboratorio;
                    } else {
                        $categoria = $resObj->Categoria;
                    }
                    ?>

                    <span>  <span class="denominador">Categoría de Inscripción:</span> <?php echo $categoria; ?></span>


                </p>

                <div class="imprimir">
                    <input type="button" onclick="window.print()" value="Imprimir"/>
                </div>    
            </div>
        <?php else: ?>
            <div class="no-registrado">
                <h1>Ese usuario no esta registrado</h1>
            </div>
        <?php endif; ?>
            
    </body>
</html>