<?php require_once('mainbar.php'); ?>
<form class="form-horizontal" id="adddish-form">
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
            <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
            Primer plato
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio">
            Segundo plato
          </label>
        </div>
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