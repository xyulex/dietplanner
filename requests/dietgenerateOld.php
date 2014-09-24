<?php
require_once('../templates/mainbar.php'); 
require_once('../classes/Diet.class.php');
?>
<link href="<?php echo $CFG->dircss ?>"type='text/css' rel='stylesheet'>
<?php

$diet = new Diet();

$combineds = $diet->combineDishesOld();

if (!is_array($combineds)) {	
	echo '<div class="alert alert-dismissable alert-danger">' . $combineds . '</div>';
	return false;
}

$weekdays = array('LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO');


$th = '<th></th><th></th>';
for($i=0; $i<DAYS; $i++){
	$th.='<th>' . $weekdays[$i] . '</th><th class="success">Kcal</th>';
}

$data = '<div id="dishlist-tbl">';
$data .= '<legend>Cuadro semanal</legend>';
$data .= '<table class="table table-striped table-hover">';
$data .= $th.'<tr>';
$cont = 0;

foreach($combineds as $combined) {
	if ($cont == 0) {
		$data.= '<td class="success">COMIDA</td><td>1r plato</td>';
	}

	$data .= '<td>' . $combined['lunch']['first']['name']. '</td>';	
	$data .= '<td class="success">' . $combined['lunch']['first']['kcal']. '</td>';

	++$cont;
	if ($cont == DAYS) {

		$data .= '</tr><tr><td></td><td>2o plato</td>';
	}
	
}

foreach($combineds as $combined) {
	$data .= '<td>' . $combined['lunch']['second']['name']. '</td>';
	$data .= '<td class="success">' . $combined['lunch']['second']['kcal']. '</td>';
}	

$data .= '</tr>';
$cont = 0;

foreach($combineds as $combined) {
	if ($cont == 0) {
		$data.= '<td class="success">CENA</td><td>1r plato</td>';

	}
	$data .= '<td>' . $combined['dinner']['first']['name']. '</td>';	
	$data .= '<td class="success">' . $combined['dinner']['first']['kcal']. '</td>';

	++$cont;
	if ($cont == DAYS) {
		$data .= '</tr><tr><td></td><td>2o plato</td>';
	}
}

foreach($combineds as $combined) {
	$data .= '<td>' . $combined['dinner']['second']['name']. '</td>';
	$data .= '<td class="success">' . $combined['dinner']['second']['kcal']. '</td>';
}

$data .= '</tr><tr><td colspan =3></td>';

foreach($combineds as $combined) {
	$data.= '<td><strong>' . $combined['totalkcal'] . '</strong></td><td></td>';
	++$i;
}
$data.='</tr></table>';

echo $data;

?>