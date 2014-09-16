<?php
require_once('dieta.php');

$dieta = new Dieta();


print("<pre>".print_r($dieta->combineDishes(),true)."</pre>");

