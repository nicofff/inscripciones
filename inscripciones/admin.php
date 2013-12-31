<html ng-app="inscApp">
    <head>
        <script src="angular/angular.min.js"></script>
        <script src="angular/angular-route.min.js"></script>
        <script src="angular/angular-resource.js"></script>
        <script src="js/controller.js"></script>
        <script src="js/services.js"></script>
        <script src="js/app.js"></script>
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
            <tr ng-repeat="inscripto in inscriptos">
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
                <td><a href="editar?ID={{inscripto.ID}}">Editar</a></td>
                <td>Borrar</td>
            </tr>
        </table>
    </body>
</html>