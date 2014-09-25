<?php require_once('mainbar.php'); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script>
 function addIngredient(name){ 
      var data = "name=" + name;
        $.ajax({
      type: "POST",
      url:  '../requests/addingredient.php',
      data: data,
      success:  function(html){       
          console.log('Added ' +  name + ' succesfully!');
      }

      }); 
    }
</script>


<div class="alert alert-dismissable alert-danger" id="error">
  <button type="button" class="close" data-dismiss="alert">×</button>
  Revisa los campos marcados
</div>


<form class="form-horizontal" id="adddish-form" accept-charset="utf-8">
  <fieldset>
    <legend>Añadir plato</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Nombre</label>
      <div class="col-lg-10">
        <input class="form-control" id="dishname" placeholder="Nombre del plato (patatas al horno, coliflor con patata..." type="text">
        <span class="help-block">Añadir ingredientes</span>
      </div>       
    </div>
    </div>
    
    <div class="form-group">
      <label class="col-lg-2 control-label">Kcal</label>
      <div class="col-lg-10">
      <input class="form-control" id="dishkcal" placeholder="Kcal que tiene el plato" type="text">
      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label">Tipo de plato</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input name="optionsRadios" id="optionsRadios1" value="1" checked="" type="radio">
            Primer plato
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="optionsRadios" id="optionsRadios2" value="2" type="radio">
            Segundo plato
          </label>
        </div>
      </div>
      <div class="form-group">
      <label class="col-lg-2 control-label">Ingredientes</label>
      <div class="col-lg-2">   
        <div class="ui-widget">    
          <input id="ingredient-field" class="ingredient-field form-control"/>
        </div>        
      </div>      

      <div class="form-group" id="gramos-group">
      <div class="col-lg-2">
        <label class="sr-only" for="gramos">Password</label>
        <input type="text" class="form-control" id="gramos" placeholder="Gramos">
      </div>
      <div class="col-lg-2">
      <a href="#"><span class="glyphicon glyphicon-plus" style="top:10px" id="gramos-btn"></span></a>
      </div>
      </div> 

      <div class="form-group">
      
        <div class="col">
        <div id="ingaddfield"></div>    
        </div>
      </div>

      

    </div>
    <div class="form-group" id="ingredients-selected">
      <label for="ingredients-selected" class="col-lg-2 control-label">Ingredientes escogidos</label>
      <div class="col-lg-6">
      <textarea class="form-control" rows="3" id="ingredients-selected-ta"></textarea>
      
      </div>
      </div>  

      <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Comentarios</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">Escribe aquí cosas que quieras recordar del plato.</span>
      </div>
    </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button class="btn btn-default">Cancelar</button>
        <button class="btn btn-primary" type="button" id="adddish-btn">Hecho!</button>
      </div>
    </div>
  </fieldset>
</form>
<div id="ingoculto" style="display:none"></div>