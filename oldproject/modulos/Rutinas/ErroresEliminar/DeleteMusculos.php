<thead>
    <tr>	
        <th>CODIGO</th>	
        <th>MUSCULO</th>	
        <th>EJERCICIO</th>	
        <th>CATEGORIA</th>  
    </tr>
 </thead>
<tbody>
    <tr ng-repeat="empleado in Usuarios ">
        <td>{{empleado.id }}</td>
        <td>{{empleado.nb_musculo |uppercase}}</td>
        <td>{{empleado.nb_ejercicio |uppercase}}</td>
        <td>{{empleado.nb_TipoRutina }}</td>
    </tr>
 </tbody>