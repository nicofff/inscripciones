<html ng-app="inscApp">
    <head>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="angular/angular.min.js"></script>
        <script src="angular/angular-route.min.js"></script>
        <script src="angular/angular-resource.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/services.js"></script>
        <script src="js/app.js"></script>
        <link rel="stylesheet" href="styles.css"/>

    </head>
    <body ng-controller="inscriptosCtrl">
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
                <td colspan="2">&nbsp;</td>
            </tr>
        <tr ng-repeat="inscripto in inscriptos |filter:search:strict">
            <td>{{inscripto.Apellido}}</td>
            <td>{{inscripto.Nombre}}</td>
            <td>{{inscripto.TipoDoc}}</td>
            <td>{{inscripto.NumeroDoc}}</td>
            <td>{{inscripto.PaisNac}}</td>
            <td>{{inscripto.Profesion}}</td>
            <td>{{inscripto.Especialidad}}</td>
            <td>{{inscripto.PaisRes}}</td>
            <td>{{inscripto.Provincia}}</td>
            <td>{{inscripto.Domicilio}}</td>
            <td>{{inscripto.CodigoPostal}}</td>
            <td>{{inscripto.Email}}</td>   
            <td><input type="button" value="Borrar" ng-click="borrarInsc(inscripto.ID)"/></td>
            <td><input type="button" value="Editar" ng-click="editar(inscripto.ID)"/></td>
        </tr>
    </table>
</body>
</html>