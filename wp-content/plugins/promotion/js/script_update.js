$(document).ready(function (e) {
	$("#promotion_update").on('submit',(function(e) {
		e.preventDefault();
		$("#message").empty(); 
		$('#loading').show();
		$.ajax({
        	url: "update.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    	    cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
		    {
			$('#loading').hide();
			$("#message").html(data);			
		    }	        
	   });
	}));


});
