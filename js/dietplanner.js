jQuery(document).ready(function(){  

	$("#adddish-btn").click(function() {
		var data = 'name=' + $('#dishname').val() + '&type=2&kcal=' + $('#dishkcal').val() + '&ingredientes=' + $('#ingoculto').val();
		
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
	$("#gramos-group, #ingredients-selected").hide();
	$("#ingredients-selected-ta").val('');

	$( "#ingredient-field" ).autocomplete({
            source: "../requests/searchingredient.php",
            minLength: 1,
            select: function( event, ui ) {
	            		$("#gramos,#gramos-group").show();
	            		$("#gramos-btn").hide();
	            		$("#gramos").keyup(function(){
		            		if ($("#gramos").val() > 0){
		            			cantidad = $(this).val();
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

});