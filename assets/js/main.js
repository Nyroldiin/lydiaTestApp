
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$(document).on({click: function() {
	

	if($('#inputName').val() != '' && $('#inputLastName').val() != '' && $('#inputEmail').val() != '' && isEmail($('#inputEmail').val()))
	{	
		event.preventDefault();
		$('.flip-div').addClass("active")
		$('.errorreponse').html('')

	    $.post( "req-sendPayment.html", $( "#formSend" ).serialize()).done(function( data ) {


	    	var obj = JSON.parse(JSON.stringify(data))
	    	if(obj.error == 0)
	    	{ 
	    		$('.validreponse').html(obj.message)
	    		$('.circle-loader').addClass('load-complete')
	  			$('.checkmark').toggle()
	    	}
	    	else
	    	{
	    		$('.errorreponse').html(obj.message)

	    		$('#inputName').val('')
				$('#inputLastName').val('')
				$('#inputEmail').val('')

				$('.flip-div').removeClass("active")
	    	}
	    	
		});
	}

}}, "#btnSend")


$(document).on({click: function() {
	
	event.preventDefault();

	$('#inputName').val('')
	$('#inputLastName').val('')
	$('#inputEmail').val('')

	$('.validreponse').html('')
	$('.errorreponse').html('')

	$('.flip-div').removeClass("active")

    $('.circle-loader').removeClass('load-complete');
  	$('.checkmark').toggle()

}}, ".newTrans")


$( ".uuidInfo" ).each(function() {

	$.post( "req-infoTransaction.html", { uuid: $(this).data("uuid") }).done(function( data ) {
							  	
		var obj = JSON.parse(JSON.stringify(data))

		$('#id'+obj.uuid).html(obj.message)

	})

})
