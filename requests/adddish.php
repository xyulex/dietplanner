<?php
require_once('../classes/Dieta.class.php');
$diet = new Dieta();
$name = $_POST['name'];
$kcal = $_POST['kcal'];
$dish = $_POST['type'];

$diet->setDish($name, $kcal, $dish);
?>