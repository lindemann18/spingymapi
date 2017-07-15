<thead>
    <tr>	
        <th>CODIGO	</th>	
        <th>NOMBRE</th>	
        <th>RUTINA</th>	
        <th>CATEGORIA</th>  
        <?php if($TipoError=="EjerciciosClientes"){echo "<th>NOMBRE</th>";}?> 
		<?php if($TipoError=="EjerciciosClientes"){echo "<th>APELLIDOS</th>";}?>
    </tr>
 </thead>
<tbody>
    <tr ng-repeat="empleado in Usuarios ">
        <td>{{empleado.id_Ejercicio }}</td>
        <td>{{empleado.nb_ejercicio |uppercase}}</td>
        <td>{{empleado.nb_rutina |uppercase}}</td>
        <td>{{empleado.categoria }}</td>
         <?php if($TipoError=="EjerciciosClientes"){?> <td>{{empleado.nb_nombre }}</td><?php } ?>
         <?php if($TipoError=="EjerciciosClientes"){?> <td>{{empleado.nb_apellidos}}</td><?php }?>
    </tr>
 </tbody>