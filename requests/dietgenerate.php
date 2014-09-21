<?php

require_once('../templates/mainbar.php'); 
require_once('../classes/Dieta.class.php');
$diet = new Dieta();

print_r( $diet->combineDishes());
?>