<?php
require_once('../templates/mainbar.php'); 
require_once('../classes/Diet.class.php');
?>
<link href="<?php echo $CFG->dircss ?>"type='text/css' rel='stylesheet'>
<?php

$diet = new Diet();

$combineds = $diet->combineDishes();

if (!is_array($combineds)) {	
	echo '<div class="alert alert-dismissable alert-danger">' . $combineds . '</div>';
	return false;
}



$weekdays = array('LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO', 'DOMINGO');


$th = '<th></th><th></th>';
for($i=0; $i<DAYS; $i++){
	$th.='<th>' . $weekdays[$i] . '</th><th class="success">Kcal</th>';
}

$data = '<div id="dishlist-tbl">';
$data .= '<legend>Cuadro semanal</legend>';
$data .= '<table class="table table-striped table-hover">';
$data .= $th.'</tr><tr>';
$cont = 0;
$totalkcal = array();

$a = 0;
$i = 0;

while($i < count($combineds)){
	$totalkcal[] = $combineds[$i]['totalkcal'];	
	$cena = '';
	foreach($combineds as $combined) {
		if ($a == 0){
			$data .= '<td colspan=2>COMIDA</td>';
		}
		
		if (!empty($combined[$i]['name'])) { 
			$data .= '<td width="20%">'.$combined[$i]['name'].'</td><td>'.$combined[$i]['kcal'].'</td>';		

		}

		$a++;


		if ($i == 1){ $cena = "CENA"; }

		if (($a % DAYS == 0) && ($i != 3)){			
			$data.='<tr><tr><td colspan=2>' . $cena . '</td>';
		}	
			
		
	}

	
$i++;
}

$data.='</tr><tr><td colspan=2></td>';
foreach($totalkcal as $total) {
	$data .= '<td></td><td>' . $total . '</td>';
}

$data .= '</tr></table>';
echo $data;
?>