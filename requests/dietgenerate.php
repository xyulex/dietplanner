<?php

require_once('../templates/mainbar.php'); 
require_once('../classes/Diet.class.php');
$diet = new Diet();

print_r( $diet->getDishes(1));
?>