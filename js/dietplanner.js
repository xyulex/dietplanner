jQuery(document).ready(function(){  

	$("#adddish-btn").click(function() {
		name = $('#dishname').val();
		type = $('input[name=optionsRadios]:checked', '#adddish-form').val();
		kcal = $('#dishkcal').val() 
		ingredientes= $('#ingoculto').val();
		if (name!="" && type!="" && ingredientes!="") {
			var data= "name=" + name + "&kcal=" + kcal + "&type=" + type + "&ingredientes=" + ingredientes;
			$("#error").slideUp().hide();
		} else {
			$("#error").slideDown();
			return false;
		}

        $.ajax({
			type: "POST",
			url:  '../requests/adddish.php',
			data:  data,
			success:  function(html){				
					location.href='../requests/dishlist.php';
				  }

		});	
	});


	// Ingredients > Autocomplete.
	$("#gramos-group, #ingredients-selected, #error").hide();
	$("#ingredients-selected-ta").val('');

	$( "#ingredient-field" ).autocomplete({
            source: "../requests/searchingredient.php",
            minLength: 1,
            select: function( event, ui ) {
	            		$("#gramos,#gramos-group").show();
	            		$("#gramos-btn").hide();
	            		$("#gramos").keyup(function(){
	            			cantidad = $(this).val();
		            		if (cantidad > 0){
		            			idingrediente = ui.item.id;
		            			ingrediente = ui.item.value;
		            			$("#gramos-btn").show();
		            		} else{
		            			$("#gramos-btn").hide();
		            		}
	            		});
					}
    });

    

    $("#gramos-btn").click(function(){
    	$("#ingredients-selected").show();
    	$("#ingredients-selected-ta").val($("#ingredients-selected-ta").val() + cantidad + ' gr de ' + ingrediente + ',');
    	$("#ingoculto").val($("#ingoculto").val() + cantidad + '_' + idingrediente + ',');
    	$("#ingredient-field, #gramos").val('');
    	$("#gramos, #gramos-group").hide(); 
    });


    $("#error .close").click(function(){
    	$("#error").slideUp();
    });

});
