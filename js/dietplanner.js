jQuery(document).ready(function(){
	console.log('CARGADO DIETPLANNER')    

	$("#adddish-btn").click(function() {
		var data = 'name=' + $('#dishname').val() + '&type=2&kcal=' + $('#dishkcal').val();
		
        $.ajax({
			type: "POST",
			url:  '../requests/adddish.php',
			data:  data,
			success:  function(html){				
				location.href='../requests/dishlist.php';
			}

		});	
	});


	// Autocomplete.
	$( "#ingredient-field" ).autocomplete({
            source: "../requests/searchingredient.php",
            minLength: 1,
            select: function( event, ui ) {
            		console.log(ui.item.value);
					}
    });
});
