<thead>
    <tr>	
        <th>CODIGO</th>	
        <th>MUSCULO</th>	
        <th>TIPO RUTINA</th>  
    </tr>
 </thead>
<tbody>
    <tr ng-repeat="empleado in Usuarios ">
        <td>{{empleado.id }}</td>
        <td>{{empleado.nb_musculo |uppercase}}</td>
        <td>{{empleado.nb_TipoRutina |uppercase}}</td>
    </tr>
 </tbody>