jQuery(document).ready(function(){
	console.log('CARGADO DIETPLANNER')
	// DietPlanner button
    $('#home').click(function(){
        $('#content').load('templates/initial/jumbotron.php');
    });

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


	// Dishes available
   /* $('#dishlist').click(function(){       
        $.ajax({
			type: "POST",
			url:  'requests/dishlist.php',
			success:  function(html){
				$('#content').html(html);
			}
		});				
	});*/

});
