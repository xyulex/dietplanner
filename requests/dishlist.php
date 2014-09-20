<?php

require_once('../templates/mainbar.php'); 
require_once('../classes/Dieta.class.php');
$diet = new Dieta();

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
$data .= '<table class="table table-striped table-hover">';
foreach($dishesarray as $disharray) {
	$data .= '<tr><td><a href="http://localhost/dietplanner/requests/getDish.php?id=' .$disharray['id'].'">'.utf8_encode($disharray['name']).'</a></td>';
	$data .= '<td>'.$disharray['kcal'].'</td><tr>';
}
$data .= '</table>';

echo $data;

?>