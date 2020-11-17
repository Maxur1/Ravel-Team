<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title> Estudiantes </title>
    <style>
        #emp{
                border-collapse: collapse;
                width: 100%;
        }
        #emp td,#emp th{
                border: 1px solid #ddd;
                padding: 8px;
        }
        #emp tr:nth-child(even){
            background-color: #D5DBDB;
        }
        #emp th{
            padding-top:12px;
            padding-bottom:12px;
            text-align: left;
            background-color: #4CAF50;
            color: #fff;
        }
    </style>
</head>
<body>
    <table id="emp">
        <thead>
            <tr>
                <th>Rut</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre</th>
                <th>Codigo Carrera</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $est)
                <tr>
                    <td>{{$est->rut}}</td>
                    <td>{{$est->paterno}}</td>
                    <td>{{$est->materno}}</td>
                    <td>{{$est->nombre}}</td>
                    <td>{{$est->carrera}}</td>
                    <td>{{$est->correo}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>