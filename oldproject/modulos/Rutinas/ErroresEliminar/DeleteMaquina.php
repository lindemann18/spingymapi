<thead>
    <tr>	
        <th>EJERCICIO</th>	
        <th>MAQUINA</th>	
        <th>NO. MAQUINA</th>  
        <th>MUSCULO</th>
    </tr>
 </thead>
<tbody>
    <tr ng-repeat="empleado in Usuarios ">
        <td>{{empleado.nb_ejercicio |uppercase}}</td>        
        <td>{{empleado.nb_maquina |uppercase}}</td>
        <td>{{empleado.num_maquina }}</td>    
        <td>{{empleado.nb_musculo |uppercase}}</td>
    </tr>
 </tbody>