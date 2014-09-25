<?php
require_once('../classes/Diet.class.php');
$diet = new Diet();
$name = $_POST['name'];
$iddish = $diet->addIngredient($name);
?>