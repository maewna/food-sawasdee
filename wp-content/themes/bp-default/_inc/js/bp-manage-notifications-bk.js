jQuery(document).ready(function(){
    var jq=jQuery;
	
	/* Selecting all */
    jq('#select-all').click(function(event) {  //on click
        if(this.checked) { // check select status
            jq('.notification-check').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            jq('.notification-check').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
	
	
	/* Bulk actions */
	jq( '#doaction' ).click( function() {		
		checked_boxes = new Array();
		checkboxes = jq("tbody input[type='checkbox']");

		jq('#message').remove();

		jq(checkboxes).each( function(i) {
			if( jq(this).is(':checked') )
				checked_boxes.push(jq(this).attr('value'));
		});

		if ( checked_boxes.length === 0 ) {
			return false;
		}
		
		selected_action = jq( "#notification-select-top").val();
		nonce = jq("input#notification_nonce").val();
		jq.post( ajaxurl, {
			action: 'notification_actions',
			'do_action': selected_action,
			'notification_ids': checked_boxes,
			nonce: nonce
			
		}, function(response) {
			if ( response[0] + response[1] == "-1" ) {
				jq('#subnav').prepend( response.substr( 2, response.length ) );
			} else {
				jq('#subnav').before( '<div id="message" class="updated">' + response + '</div>' );
				jq('#select-all').prop('checked', false); 
				jq(checkboxes).each( function(i) {
					if( jq(this).is(':checked') ) {
						jq(this).attr( 'checked', false );
						jq(this).parent().parent().fadeOut(150);
					}
				});
			}
		});

		return false;
	});
});
