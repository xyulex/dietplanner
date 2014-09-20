<?php 
require_once('../settings.php'); ?>
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
    <a class="navbar-brand" href="#" id="home">DietPlanner</a>
  </div>
  <div class="navbar-collapse collapse navbar-inverse-collapse">
    <ul class="nav navbar-nav">
      <li><a href="<?php echo $CFG->adddish_form ?>" id="adddish">Nuevo plato</a></li>
      <li><a href="<?php echo $CFG->dishlist ?>" >Lista de platos</a></li>            
      </li>
    </ul>
    <form class="navbar-form navbar-right">
      <input class="form-control col-lg-8" placeholder="Buscar..." type="text">
    </form>    
  </div>
</div>