<html ng-app="inscApp">
    <head>
        <script src="../angular/angular.min.js"></script>
        <script src="../angular/angular-route.min.js"></script>
        <script src="../angular/angular-resource.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/services.js"></script>
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="css/styles.css"/>
    </head>
    <body ng-controller="adminCtrl">
        <table border="1">
            <thead>
            <td>Apellido</td>
            <td>Nombre</td>
            <td>Tipo Documento</td>
            <td>Numero Documento</td>
            <td>Pais Nacimiento</td>
            <td>Profesion</td>
            <td>Especialidad</td>
            <td>Pais Residencia</td>
            <td>Provincia</td>
            <td>Domicilio</td>
            <td>Codigo Postal</td>
            <td>Email</td>
            <td colspan="2">Opciones</td>
        </thead>
        <tr class="search">
            <td><input ng-model="search.Apellido"></td>
            <td><input ng-model="search.Nombre"></td>
            <td><input ng-model="search.TipoDoc"></td>
            <td><input ng-model="search.NumeroDoc"></td>
            <td><input ng-model="search.PaisNac"></td>
            <td><input ng-model="search.Profesion"></td>
            <td><input ng-model="search.Especialidad"></td>
            <td><input ng-model="search.PaisRes"></td>
            <td><input ng-model="search.Provincia"></td>
            <td><input ng-model="search.Domicilio"></td>
            <td><input ng-model="search.CodigoPostal"></td>
            <td><input ng-model="search.Email"></td>
            <td><input ng-model="search.Laboratorio"></td>

            <td colspan="2">&nbsp;</td>
        </tr>
        <tr ng-repeat="inscripto in inscriptos|filter:search:strict">
            <td><span>{{inscripto.Apellido}}</span></td>
            <td><span>{{inscripto.Nombre}}</span></td>
            <td><span>{{inscripto.TipoDoc}}</span></td>
            <td><span>{{inscripto.NumeroDoc}}</span></td>
            <td><span>{{inscripto.PaisNac}}</span></td>
            <td><span>{{inscripto.Profesion}}</span></td>
            <td><span>{{inscripto.Especialidad}}</span></td>
            <td><span>{{inscripto.PaisRes}}</span></td>
            <td><span>{{inscripto.Provincia}}</span></td>
            <td><span>{{inscripto.Domicilio}}</span></td>
            <td><span>{{inscripto.CodigoPostal}}</span></td>
            <td><span>{{inscripto.Email}}</span></td>
            <td><span>{{inscripto.Laboratorio}}</span></td>
            <td colspan="2">
                <div class="buttons" >
                    <a href="editar.php?id={{inscripto.ID}}">Editar</a>
                    <input type="button" value="Borrar" ng-click="borrarInsc(inscripto)"/>
                </div>
            </td>
        </tr>
    </table>
    <p><a href="exportar.php">Exportar a excel</a></p>
</body>
</html>