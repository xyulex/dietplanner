<?php
require_once('../classes/Diet.class.php');
$diet = new Diet();
$name = $_POST['name'];
$kcal = $_POST['kcal'];
$dish = $_POST['type'];
$iddish = $diet->setDish($name, $kcal, $dish);
$ingredientsarray = $_POST['ingredientes'];
$diet->setIngredients($iddish, $ingredientsarray);
?>