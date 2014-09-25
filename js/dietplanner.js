 $(function(){  
 	// Init vars
 	gramos 			= $("#gramos");
	gramosbtn 		= $("#gramos-btn");
	gramosgrp 		= $("#gramos-group");	
	ingaddfield		= $("#ingaddfield");
	ingselected 	= $("#ingredients-selected");
	ingselectedta 	= $("#ingredients-selected-ta");
	ingfield    	= $("#ingredient-field");
	ingoculto		= $("#ingoculto");
	error			= $("#error");


	// Initializers
	gramosgrp.hide();	
	ingaddfield.hide();
	ingselected.hide();
	error.hide();	
	ingselectedta.val('');


	// Add dish data send.
	$("#adddish-btn").click(function() {
		name = $('#dishname').val();
		type = $('input[name=optionsRadios]:checked', '#adddish-form').val();
		kcal = $('#dishkcal').val() 
		ingredientes= $('#ingoculto').val();
		if (name!="" && type!="" && ingredientes!="") {
			var data= "name=" + name + "&kcal=" + kcal + "&type=" + type + "&ingredientes=" + ingredientes;
			error.slideUp().hide();
		} else {
			error.slideDown();
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



	
	// Add ingredients > Autocomplete.	
	minLength = 1;
	ingfield.autocomplete({
            source: "../requests/searchingredient.php",
            minLength: minLength,
            response: function( event, ui ) {
            			$(".ui-helper-hidden-accessible").hide();
            			kk=ingfield.val();
						if (ui.content.length === 0 && ingfield.val().length > minLength) {	
							ingaddfield.show().html("<a href='#' id='ingaddbutton' onclick='addIngredient(kk)'>Añhadir " + ingfield.val() + "</a>");
							
						} else {
							$('#ingaddfield').html('').hide();
						}
					},
            select: function( event, ui ) {
		            	gramos.show();
		            	gramosgrp.show();
			            gramosbtn.hide();
	            		gramos.keyup(function(){
	            			cantidad = this.value;
		            		if (cantidad > 0){
		            			idingrediente = ui.item.id;
		            			ingrediente = ui.item.value;
		            			gramosbtn.show();
		            		} else{
		            			gramosbtn.hide();
		            		}
	            		});
					}
    });

    gramosbtn.click(function(){
    	ingselected.show();
    	ingselectedta.val(ingselectedta.val() + cantidad + ' gr de ' + ingrediente + ',');
    	ingoculto.val(ingoculto.val() + cantidad + '_' + idingrediente + ',');
    	ingfield.val('');
    	gramos.val('').hide();
    	gramosgrp.hide();
    });

    error.click(function(){
    	error.slideUp();
    }); 


});
