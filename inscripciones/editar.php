<!DOCTYPE html>
<?php
include "model/Inscripto.php";

$inscripto = Inscripto::get($_GET["id"]);
?>
<html ng-app="inscApp">
    <head>
        <title>Editar inscripcion</title>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/jquery.form-validator.min.js"></script>
        <script src="angular/angular.min.js"></script>
        <script src="js/xeditable.min.js"></script>

        <script src="angular/angular-route.min.js"></script>
        <script src="angular/angular-resource.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/services.js"></script>
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="styles.css"/>
        <script>
            $(document).ready(function() {
                $("#becado-select").change(function() {
                    if ($(this).val() == 0) {
                        $(".becado").hide();
                        $(".nobecado").show();
                    } else if ($(this).val() == 1) {
                        $(".nobecado").hide();
                        $(".becado").show();
                    } else {
                        $(".becado").hide();
                        $(".nobecado").hide();
                    }
                });
                $("#form-inscrip").submit(function() {
                    if (($("#becado-select").val() == 0) && ($("#aceptoNoBecado").attr("checked") == 0)) {
                        alert("Acepte el monto");
                    }
                });
                setTimeout(function()
                {
                    $("#tipoDoc").val(<?php echo $inscripto->TipoDoc; ?>);
                    $("#paisNac").val(<?php echo $inscripto->PaisNac; ?>);
                    $("#paisRes").val(<?php echo $inscripto->PaisRes; ?>);
                    $("#profesion").val(<?php echo $inscripto->Profesion; ?>);
                    $("#laboratorio").val(<?php echo $inscripto->Laboratorio; ?>);

                },
                        500);
            });
        </script>
    </head>
    <body ng-controller="editCtrl">

        <div class="inscripcion" >
            <form id="form-inscrip" name="nueva-inscripcion" action="rest/inscriptos.php" method="post">
                <input type="hidden" name="ID" value="<?php echo $inscripto->ID; ?>"
                <span>Apellido: </span><input type="text" name="apellido" data-validation="required" value="<?php echo $inscripto->Apellido; ?>"><br/>
                <span>Nombre: </span><input type="text" name="nombre" data-validation="required" value="<?php echo $inscripto->Nombre; ?>"><br/>
                <span>Email: </span><input type="text" name="email" data-validation="required,email" value="<?php echo $inscripto->Email; ?>"><br/>
                <span>Tipo de Documento: </span>
                <select id="tipoDoc" name="tipoDoc" data-validation="required">
                    <option ng-repeat="tipoDoc in tiposDoc" value="{{tipoDoc.value}}">{{tipoDoc.label}}</option>
                </select>
                <span>Numero Documento: </span><input type="text" name="numeroDoc" data-validation="required,number" value="<?php echo $inscripto->NumeroDoc; ?>"><br/>
                <span>Pais de Nacimiento:</span>
                <select name="paisNac" id="paisNac">
                    <option ng-repeat="pais in paisesNac" value="{{pais.value}}">{{pais.label}}</option>
                </select>

                <span>Profesion: </span>
                <select id="profesion" name="profesion">
                    <option ng-repeat="prefesion in profesiones" value="{{prefesion.value}}">{{prefesion.label}}</option>
                </select>
                <span>Especialidad: </span><input type="text" name="especialidad" data-validation="required" value="<?php echo $inscripto->Especialidad; ?>"><br/>
                <span>Pais de Residencia:</span>
                <select id="paisRes" name="paisRes">
                    <option ng-repeat="pais in paisesRes" value="{{pais.value}}">{{pais.label}}</option>
                </select>
                <span>Provincia: </span><input type="text" name="provincia" data-validation="required" value="<?php echo $inscripto->Provincia; ?>"><br/>
                <span>Domicilio: </span><input type="text" name="domicilio" data-validation="required" value="<?php echo $inscripto->Domicilio; ?>"><br/>
                <span>Codigo Postal: </span><input type="text" name="codigoPostal" data-validation="required" value="<?php echo $inscripto->CodigoPostal; ?>"><br/>

                <span>Laboratorio que concede la beca</span>
                <select id="laboratorio" name="laboratorio">
                    <option value="0">Ninguno</option>
                    <option ng-repeat="labo in laboratorios" value="{{labo.value}}">{{labo.label}}</option>
                </select>
                <input type="submit" value="Guardar"/>
            </form>

        </div>
    </body>
</html>