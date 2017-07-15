<?php	
	require_once("../../libs/libs.php");
	session_start();
	$Params= (isset($_GET['Params']))? $_GET['Params'] :$_POST['Params'];

	$Parametros=json_decode($Params,true);
	
	$consultar=new Consultar();
	//Trayendo la lista de ejercicios del día
	$id_rutina = $Parametros['id_Rutina'];
	$Dia_Semana    = $Parametros['Dia_Semana'];
	$ResultInstructores = $consultar->_ConsultarInformacionPorRutinaYDiaRutinas($id_rutina,$Dia_Semana);
	$num_ejercicios = $ResultInstructores->num_rows;
?>									

<!-- Casos de día de la semana-->

<?php if ($Dia_Semana ==1){?>
    <thead>
        <h3 class="text-center">Lunes</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==1)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>
<!-- Martes-->
<?php if ($Dia_Semana ==2){?>
    <thead>
        <h3 class="text-center">Martes</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==2)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>

<!-- MIercoles-->
<?php if ($Dia_Semana ==3){?>
    <thead>
        <h3 class="text-center">Miercoles</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==3)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>


<!-- Jueves-->
<?php if ($Dia_Semana ==4){?>
    <thead>
        <h3 class="text-center">Jueves</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==4)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>

<!-- Viernes-->
<?php if ($Dia_Semana ==5){?>
    <thead>
        <h3 class="text-center">Viernes</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==5)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>


<!-- Sabado-->
<?php if ($Dia_Semana ==6){?>
    <thead>
        <h3 class="text-center">Viernes</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==6)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>


<!-- Domingo-->
<?php if ($Dia_Semana ==6){?>
    <thead>
        <h3 class="text-center">Viernes</h3>
        <tr>
            <th class="sorting_asc">CODIGO</th>
            <th>EJERCICIO</th>
            <th>MUSCULO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    //Tomando los valores acorde al día para poder hacer el cambio
    for($i=0; $i<$num_ejercicios; $i++) {
		$fila = $ResultInstructores->fetch_assoc();
    if($fila['id_dia']==6)
    {
?>
        
        <tr id="<?php echo $fila['id_PosicionEjercicio']?>">
        <td class="text-center"><?php echo $fila['id_PosicionEjercicio']?></td>
        <td><?php echo $fila['nb_ejercicio']?></td>
        <td><?php echo $fila['nb_musculo']?></td>
        <?php }} ?>
         </tr>
    </tbody>
    
<?php }?>
