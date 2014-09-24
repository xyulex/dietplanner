<?php

require_once('../templates/mainbar.php'); 
require_once('../classes/Diet.class.php');
$diet = new Diet();

$dishesarray = $diet->getDishes(1);
$dishesarray2 = $diet->getDishes(2);

$dishesarray = array_merge($dishesarray,$dishesarray2);

$orden = array();
foreach ($dishesarray as $key => $row)
{
    $orden[$key] = strtoupper($row['name']);
}
array_multisort($orden, SORT_ASC, $dishesarray);


$data = '<div id="dishlist-tbl">';
$data .= '<legend>Lista de platos</legend>';
$data .= '<table class="table table-striped table-hover"><th>Nombre</th><th>Kcal</th><th>Acciones</th>';
foreach($dishesarray as $disharray) {
	$data .= '<tr><td><a href="http://localhost/dietplanner/requests/getDish.php?id=' .$disharray['id'].'">'.$disharray['name'].'</a></td>';
	$data .= '<td>'.$disharray['kcal'].'</td>';
	$data .= '<td><span class="glyphicon glyphicon-pencil" alt="Editar"></span></button></td></tr>';	
}
$data .= '</table>';

echo $data;

?>