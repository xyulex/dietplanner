<?php 
require_once('../settings.php'); 
header('Content-Type: text/html; charset=utf-8');
?>
<link href="<?php echo $CFG->dircss ?>"type='text/css' rel='stylesheet'>
<script src="<?php echo $CFG->jquery ?>" type="text/javascript"></script>
<script src="<?php echo $CFG->dietjs ?>" type="text/javascript"></script>
<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo $CFG->templatedir ?>/jumbotron.php">DietPlanner</a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <li><a href="<?php echo $CFG->adddish_form ?>" id="adddish"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Nuevo plato</a></li>
      <li><a href="<?php echo $CFG->dishlist ?>" ><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;&nbsp;Lista de platos</a></li>            
      <li><a href='#'><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;&nbsp;Lista de la compra</a></li>
      <li><a href='<?php echo $CFG->diet ?>'><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;&nbsp;Generar dieta</a></li>
      
      </li>
    </ul>
    <form class="navbar-form navbar-right">
      <input class="form-control col-lg-8" placeholder="Buscar..." type="text">
    </form>    
  </div>
</div>